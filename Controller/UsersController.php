<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $components = array('Filter.Filter');

    public $paginate = array(
        'limit' => 100,
        'order' => array('User.username' => 'asc')
    );

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow(); // Allow all to public.
        $this->Auth->allow('request_login_details', 'details_found','details_not_found', 'password_reset', 'password_reset_failed');
    }

    public function isAuthorized($user) {

        //return true;

        //Logged in users can do the following.
        if (in_array($this->action, array('index', 'view', 'password_update', 'members_area', 'nosubscription', 'email_preferences',
            'email_update', 'profile_faq'))) {
            return true;
        }

        //Role Enquiry/Manager/Admin can do the following.
        if ($this->UserUtilities->hasRole(array('UserEnquiry', 'UserManager', 'UserAdmin'))) {
            if (in_array($this->action, array('admin_dashboard', 'admin_index', 'admin_view' ))) {
                return true;
            }
        }

        //User Admin role can also do the following.
        if ($this->UserUtilities->hasRole(array('UserAdmin'))) {
            if (in_array($this->action, array('admin_add', 'admin_edit', 'admin_delete', 'admin_sync_duplicates', 'admin_send_email_update_to_admin',
                'admin_mark_deceased', 'admin_report_mismatched_names_uu', 'admin_mark_same_person' ))) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }


    /*
     * Filter Plugin stuff.
     */
    var $filters = array (
        'admin_index' => array (
            'User' => array (
                'User.id' => array('label' => 'User Id', 'condition' => '=', 'type' => 'text'),
                'User.bca_no' => array('label' => 'BCA No', 'condition' => '=', 'type' => 'text'),
                'User.surname',
                'User.organisation',
            )
        )
    );

    public function login() {

        //Override the model's validation so no irritating * on login page.
        $this->User->validate['username']['allowEmpty'] = true;

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {

                //Update Last Login date and count.
                $this->User->id = $this->Auth->user('id');
                if (!$this->User->exists()) {
                    throw new NotFoundException(__('Invalid user'));
                } else {
                    $this->User->contain('LastLogin');
                    $this->set('user', $this->User->read(null, $this->Auth->user('id')));

                    $this->User->LastLogin->set(array(
                        'user_id' => $this->User->id,
                        'last_login' => date('Y-m-d H:i:s'),
                        'login_count' => $this->User->data['LastLogin']['login_count'] + 1
                    ));

                    $this->User->LastLogin->save();
                }

                // BUG? !!!!DEV When going to members.idta.co.uk/users/login from main site a login redirects to '/'. We want /user/members_area.
                // Because the referer location of '/' is remembered.
                // When going to members.idta.co.uk/users/login from within members.idta.co.uk a login redirects correctly
                // as configured in Auth->loginRedirect.
                $myvar = $this->Auth->redirectUrl();

                if ($myvar == '/') {
                    //pr($myvar);die();
                    return $this->redirect(array('action' => 'members_area'));
                } else {
                    //pr('x '.$myvar);die();
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Session->setFlash(__('The username or password was invalid, please try again'));
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
    * index method
    *
    * @return void
    */
    public function index() {

        return $this->redirect(array('action' => 'members_area'));
    }

    public function members_area() {

        //Pass some useful info to the view.
        $this->set('bca_no', $this->Auth->user('bca_no'));
        $this->set('full_name', $this->Auth->user('full_name'));

        //"Diary Admin" button shown if user is this list.
        $event_admins = array(15404, 486, 1072, 5658); //List of authorised BCA members (Admin, Damian Weare, David Cooke, David Gibson).
        $this->set('show_diary_admin', in_array($this->Auth->user('bca_no'), $event_admins));

        //"Admin" button shown if user is this list.
        $admins = array(15404, 1072, 5658); //List of authorised BCA members (Admin, David Cooke, David Gibson).
        $this->set('show_admin', in_array($this->Auth->user('bca_no'), $admins));

        }

    public function nosubscription() {}

    public function profile_faq() {

        //Pass some useful info to the view.
        $this->set('bca_no', $this->Auth->user('bca_no'));
        $this->set('membership_admin_email', Configure::read('EmailAddresses.membership_admin'));

    }

    /**
    * view method
    *
    * @param string $id
    * @return void
    */
    public function view() {

        // Find current user records.
        if (!$users = $this->User->find('all',
            array('conditions' => array('User.bca_no' => $this->Auth->user('bca_no')),
            'order' => array('User.date_of_expiry DESC'), 'contain' => false))
        ) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Set useful info for the view.
        $this->set('user_count', count($users)); //Sometimes there is more than one User record for a given BCA No.
        $this->set('users', $users);
        $this->set('full_name', $this->Auth->user('full_name'));
        $this->set('bca_no', $this->Auth->user('bca_no'));

        if ($this->Auth->user('class') == 'GRP') {
            $this->view = 'group_view';
        }
    }

    public function request_login_details() {

        if ($this->request->is('post')) {

            if ($this->request->data['User']['email']) {

                //Find all users with the given email address.
                if(!$users = $this->User->find('all', array(
                    'fields' => array('id', 'bca_no', 'username', 'full_name'),
                    'conditions' => array('User.email' => $this->request->data['User']['email']),
                    'contain' => false))
                ) {
                    $this->Session->setFlash(__('I can\'t find \''. $this->request->data['User']['email'] .'\', please try again.'));
                    return $this->redirect(array('action' => 'details_not_found'));
                };

                //Initialise.
                $base_url = Router::url('/', true);
                $previous_bca_no[] = array();

                //Loop through users generating one token per bca_no and gathering info for the email.
                //There can be several users with the same email address with the same or different bca_no.
                //We only need to send one password reset token per bca_no because that user can see and update
                //the "other" users with the same bca_no.
                //for ($i = 0; $i < $user_count; $i++) {
                foreach ($users as $user) {

                    //Don't generate password reset tokens for bca_no that we have already done so.
                    if (array_search($user['User']['bca_no'], $previous_bca_no) === FALSE) {

                        $previous_bca_no[] = $user['User']['bca_no'];

                        $token_code = $this->User->Token->store($user['User']['id'], 'password_reset');

                        //E.g. http://members.british-caving.org.uk/users/password_reset/372d46769cbef5adcd196c820776987ae0c1fd74
                        $token_url = "{$base_url}users/password_reset/{$token_code}";

                        $myViewVars[] = array(
                            'full_name' => $user['User']['full_name'],
                            'username' => $user['User']['username'],
                            'token_url' => $token_url,
                            'bca_online_admin_email' => Configure::read('EmailAddresses.bca_online_admin'),
                        );
                    }
                }

                //Use different email templates for single or multiple password reset tokens.
                if (count($myViewVars) == 1) {
                    $viewVars = $myViewVars[0];
                    $template = 'users-request_login_details';
                } else {
                    $viewVars = array('users' => $myViewVars);
                    $template = 'users-request_login_details-multiple';
                }

                $email = array(
                    'user_id' => $users[0]['User']['id'],
                    'subject' => 'Your BCA Online details as requested. (Ref: '. $users[0]['User']['bca_no'] . ')',
                    'template' => $template,
                    'viewVars' => $viewVars,
                    'forceSend' => true,
                );

                $this->User->SentEmail->send($email);

                $this->Session->setFlash(__('Your details have been found. An email has been sent to you.'),
                    'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'details_found'));

            } else {
                $this->Session->setFlash(__('Please enter an email address.'));
            }
        }
    }

    /**
    * Display Details Found Screen
    */
    public function details_found() {
    }

    /**
    * Display Details Not Found Screen
    */
    public function details_not_found() {
    }

    /**
    * Update email preferences
    */
    public function email_preferences () {

        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->User->save($this->request->data)) {

                //Update the Auth Session user data.
                $this->_refreshAuth();

                //Get email config.
                if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
                    throw new NotFoundException(__('Invalid email configuration'));
                }

                //Synchronise records with the same bca_no.
                $syncd_users = $this->User->syncDuplicates($this->Auth->user('id'));

                //Send out and save a copy of the confirmation emails.
                if (!empty($syncd_users)) {

                    foreach ($syncd_users as $syncd_user) {

                        $viewVars = array(
                            'full_name' => $syncd_user['full_name'],
                            'email' => $syncd_user['email'],
                            'primary_email' => $this->Auth->user('email'),
                            'password_changed' => false,
                            'bca_online_admin_email' => $configEmailAddresses['bca_online_admin']
                        );

                        $email = array(
                            'user_id' => $syncd_user['id'],
                            //'bca_no' => $syncd_user['bca_no'],
                            //'to' => $syncd_user['email'],
                            'subject' => 'Your BCA Online profile has been updated (Ref: '. $syncd_user['bca_no'] . ')',
                            'template' => 'users--duplicates_syncd',
                            'viewVars' => $viewVars,
                        );

                        $this->User->SentEmail->send($email);
                    }
                }

                $this->Session->setFlash(__('Your new email preferences have been saved'), 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'members_area'));
            } else {
                $this->Session->setFlash(__('Your new email preferences could not be saved. Please try again.'));
            }
        } else {
            //Populate view.
            $this->request->data = $this->User->find('first', array(
                'conditions' => array('User.id' => $this->Auth->user('id')),
                'fields' => array('admin_email_ok', 'bca_email_ok'),
                'contain' => false));
        }
    }

    /**
    * email_update method
    *
    * @return void
    */
    public function email_update() {

        //Check the logged in user exists.
        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Populate view.
        if (!$this->request->is('post')) {

            $this->request->data = $this->User->find('first', array(
                'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('email'), 'contain' => false));

            $this->request->data['User']['email_old'] = $this->request->data['User']['email']; //Keep old email address for the email.

            unset($this->request->data['User']['email']); //Don't show existing email.
        }
        //Process submitted view data.
        else {

            //Sanity checks.
            if ($this->request->data['User']['email'] != $this->request->data['User']['email_confirm']) {

                $this->Session->setFlash(__('The email addresses do not match. Please try again.'));
                return;
            }

            if ($this->request->data['User']['email'] == $this->request->data['User']['email_old']) {

                $this->Session->setFlash(__('No change. This email addresses is the same as your old one.'));
                return;
            }

            //Save new email address.
            if ($this->User->save($this->request->data, array('fieldlist' => array('email')))) {

                //Update the Auth Session user data.
                $this->_refreshAuth();

                //Send and save a copy of the confirmation email.
                if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
                    throw new NotFoundException(__('Invalid email configuration'));
                }

                $viewVars = array(
                    'full_name' => $this->Auth->user('full_name'),
                    'new_email' => $this->Auth->user('email'),
                    'bca_online_admin_email' => $configEmailAddresses['bca_online_admin'],
                );

                $email = array(
                    'user_id' => $this->Auth->user('id'),
                    //'bca_no' => $this->Auth->user('bca_no'),
                    'to' => $this->request->data['User']['email_old'],
                    'subject' => 'Your BCA Online email address has changed. (Ref: '. $this->Auth->user('bca_no') . ')',
                    'template' => 'users-email_update',
                    'forceSend' => true,
                    'viewVars' => $viewVars,
                );

                //To previous email address.
                $this->User->SentEmail->send($email);

                //!!!DEV Add this back in when using token to validate the new email address.
                //And new email address.
                //$email['to'] = $this->request->data['User']['email'];
                //$this->User->SentEmail->send($email);

                //Let Membership Administrator know.
                $viewVars = array(
                    'bca_no' => $this->Auth->user('bca_no'),
                    'full_name' => $this->Auth->user('full_name'),
                    'organisation' => $this->Auth->user('organisation'),
                    'class' => $this->Auth->user('class'),
                    'new_email' => $this->Auth->user('email'),
                );

                $email = array(
                    'user_id' => $this->Auth->user('id'),
                    //'bca_no' => $this->Auth->user('bca_no'),
                    'to' => $configEmailAddresses['membership_admin2'],
                    'subject' => 'BCA Online email update. (Ref: '. $this->Auth->user('bca_no') . ')',
                    'template' => 'users-email_update-to_admin',
                    'forceSend' => true,
                    'viewVars' => $viewVars,
                );
                $this->User->SentEmail->send($email);

                //Synchronise records with the same bca_no.
                $syncd_users = $this->User->syncDuplicates($this->Auth->user('id'));

                //Send out and save a copy of the confirmation emails.
                if (!empty($syncd_users)) {

                    foreach ($syncd_users as $syncd_user) {

                        $viewVars = array(
                            'full_name' => $syncd_user['full_name'],
                            'email' => $syncd_user['email'],
                            'primary_email' => $this->Auth->user('email'),
                            'password_changed' => false,
                            'bca_online_admin_email' => $configEmailAddresses['bca_online_admin']
                        );

                        $email = array(
                            'user_id' => $syncd_user['id'],
                            //'bca_no' => $syncd_user['bca_no'],
                            'to' => $syncd_user['email'],
                            'subject' => 'Your BCA Online profile has been updated. (Ref: '. $syncd_user['bca_no'] . ')',
                            'template' => 'users--duplicates_syncd',
                            'viewVars' => $viewVars,
                        );

                        $this->User->SentEmail->send($email);
                    }
                }

                $this->Session->setFlash(__('Your new email address has been saved.'),'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'view'));
            } else {
                //debug($this->User->validationErrors); die;
                $this->Session->setFlash(__('Your new email address could not be saved. Please try again.'));
            }
        }
    }

    /**
    * password_reset method
    *
    * @param string $token_code Token Code previously sent to the user in an email.
    * @return void
    */

    public function password_reset($token_code) {

        //Check there is a token code.
        if (!isset($token_code)) {
            return $this->redirect(array('action' => 'password_reset_failed'));
        }

        //$this->loadModel('Token');

        //Check the token code is valid.
        if(!$token = $this->User->Token->retrieve($token_code, 'password_reset')){
            return $this->redirect(array('action' => 'password_reset_failed'));
        }

        //Get user record.
        if(!$user = $this->User->find('first', array('conditions' => array('User.id' => $token['Token']['user_id']), 'contain' => false))) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->set('full_name', $user['User']['full_name']); //For view.

        if ($this->request->is('post')) {

            //Get email config.
            if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
                throw new NotFoundException(__('Invalid email configuration'));
            }

            $this->User->id = $user['User']['id']; // Make sure we update rather than insert.
            $this->request->data['User']['active'] = true; //Set the account active.

            if ($this->User->save($this->request->data, true, array('password', 'passwd_new', 'passwd_confirm', 'active'))) {

                //Delete used Token.
                $this->User->Token->delete($token['Token']['id'], false);

                //Send and save a copy of the confirmation email.
                $viewVars = array(
                    'full_name' => $user['User']['full_name'],
                    'bca_online_admin_email' => $configEmailAddresses['bca_online_admin']
                );

                $email = array(
                    'user_id' => $user['User']['id'],
                    //'bca_no' => $user['User']['bca_no'],
                    //'to' => $user['User']['email'],
                    'subject' => 'Your BCA Online password has been set/reset. (Ref: '. $user['User']['bca_no'] . ')',
                    'template' => 'users-password_reset',
                    'forceSend' => true,
                    'viewVars' => $viewVars,
                );

                $this->User->SentEmail->send($email);

                //Synchronise records with the same bca_no.
                $syncd_users = $this->User->syncDuplicates($user['User']['id'], $this->request->data['User']['passwd_new']);

                //Send out and save a copy of the confirmation emails.
                if (!empty($syncd_users)) {

                    foreach ($syncd_users as $syncd_user) {

                        $viewVars = array(
                            'full_name' => $syncd_user['full_name'],
                            'email' => $syncd_user['email'],
                            'primary_email' => $user['User']['email'],
                            'password_changed' => true,
                            'bca_online_admin_email' => $configEmailAddresses['bca_online_admin']
                        );

                        $email = array(
                            'user_id' => $syncd_user['id'],
                            //'bca_no' => $syncd_user['bca_no'],
                            'to' => $syncd_user['email'],
                            'subject' => 'Your BCA Online profile has been updated. (Ref: '. $syncd_user['bca_no'] . ')',
                            'template' => 'users--duplicates_syncd',
                            'viewVars' => $viewVars,
                        );

                        $this->User->SentEmail->send($email);
                    }
                }

                $this->Session->setFlash(__('Your new password has been saved'),'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'view'));
            } else {
                //debug($this->User->validationErrors); die();
                $this->Session->setFlash(__('Your new password could not be saved. Please try again.'));
            }
        }
    }

    /**
    * password_reset_failed method
    *
    * @return void
    */
    public function password_reset_failed() {}


    /**
    * password_update method
    *
    * @return void
    */
    public function password_update() {

        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post')) {

            if ($this->User->save($this->request->data)) {

                //Send and save a copy of the confirmation email.
                if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
                    throw new NotFoundException(__('Invalid email configuration'));
                }

                $viewVars = array(
                    'full_name' => $this->Auth->user('full_name'),
                    'bca_online_admin_email' => $configEmailAddresses['bca_online_admin']
                );

                $email = array(
                    'user_id' => $this->Auth->user('id'),
                    //'bca_no' => $this->Auth->user('bca_no'),
                    //'to' => $this->Auth->user('email'),
                    'subject' => 'Your BCA Online password has been updated. (Ref: '. $this->Auth->user('bca_no') . ')',
                    'template' => 'users-password_updated',
                    'forceSend' => true,
                    'viewVars' => $viewVars,
                );

                $this->User->SentEmail->send($email);

                //Synchronise records with the same bca_no.
                $syncd_users = $this->User->syncDuplicates($this->Auth->user('id'), $this->request->data['User']['passwd_new']);

                //Send out and save a copy of the confirmation emails.
                if (!empty($syncd_users)) {

                    foreach ($syncd_users as $syncd_user) {

                        $viewVars = array(
                            'full_name' => $syncd_user['full_name'],
                            'email' => $syncd_user['email'],
                            'primary_email' => $this->Auth->user('email'),
                            'password_changed' => true,
                            'bca_online_admin_email' => $configEmailAddresses['bca_online_admin']
                        );

                        $email = array(
                            'user_id' => $syncd_user['id'],
                            //'bca_no' => $syncd_user['bca_no'],
                            'to' => $syncd_user['email'],
                            'subject' => 'Your BCA Online profile has been updated. (Ref: '. $syncd_user['bca_no'] . ')',
                            'template' => 'users--duplicates_syncd',
                            'viewVars' => $viewVars,
                        );

                        $this->User->SentEmail->send($email);
                    }
                }

                $this->Session->setFlash(__('Your new password has been saved'),'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'view'));
            } else {
                $this->Session->setFlash(__('Your new password could not be saved. Please try again.'));
            }
        }

        $this->set('full_name', $this->Auth->user('full_name')); //For view heading.
    }


    /**
    * update contact details method
    *
    * @return void
    * /
    public function contact_details() {
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {

                //Send confirmation email
                //DEV !!!! Send second email if email has changed to old address.
                $email = new CakeEmail();

                $message =
                    "User: " . $this->User->id . "\n"
                    . "Name: " . $this->request->data['User']['full_name'] . "\n"
                    . "Orig Email: " . $orig_email . "\n"
                    . "New Email: " . $this->request->data['User']['email'] . "\n"
                    . " has been updated";

                $email->from(array('webmaster@british-caving.org.uk' => "BCA's Members Area"))
                    ->to('dave@alchemy.co.uk')
                    ->subject('About')
                    ->send($message);

                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'view'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $this->Auth->user('id'));
            unset($this->request->data['User']['password']);
            $orig_email = $this->request->data['User']['email'];
        }
    }
*/

    //This function will be called if in admin area and session times out due to inactivity.
    //Therefore function needed in order for redirect to login screen to work (assuming logoutRedirect = Users.login).
    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function admin_dashboard() {}

    /**
    * admin_index method
    *
    * @return void
    */
    public function admin_index() {

        //Empty is allowed for the search filter.
        //Can't set in the filter configuration, so override the model's validation here.
        $this->User->validate['bca_no']['allowEmpty'] = true;
        $this->User->validate['organisation']['allowEmpty'] = true;

        $this->User->contain('LastLogin');
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());

        //"Add", "Edit" & "Delete" buttons shown if user is this list.
        $admins = array(1072, 5658); //List of authorised BCA members.
        $this->set('task_admin', in_array($this->Auth->user('bca_no'), $admins));
    }

    /**
    * admin_view method
    *
    * @param string $id
    * @return void
    */
    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->User->contain('LastLogin');
        $this->set('user', $this->User->read(null, $id));

        //"Add", "Edit" & "Delete" buttons shown if user is this list.
        $admins = array(1072, 5658); //List of authorised BCA members.
        $this->set('task_admin', in_array($this->Auth->user('bca_no'), $admins));
    }

    /**
    * admin_add method
    *
    * @return void
    */
    public function admin_add() {
      if ($this->request->is('post')) {
          $this->User->create();
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'success'));
              return $this->redirect(array('action' => 'index'));
          } else {
              $this->Session->setFlash(__('The user could not be saved. Please try again.'));
          }
      }
    }

    /**
    * admin_edit method
    *
    * @param string $id
    * @return void
    */
    public function admin_edit($id = null) {
      $this->User->id = $id;
      if (!$this->User->exists()) {
          throw new NotFoundException(__('Invalid user'));
      }
      if ($this->request->is('post') || $this->request->is('put')) {
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'success'));
              return $this->redirect(array('action' => 'index'));
          } else {
              $this->Session->setFlash(__('The user could not be saved. Please try again.'));
          }
      } else {
          $this->User->contain();
          $this->request->data = $this->User->read(null, $id);
      }
    }

    /**
    * admin_delete method
    *
    * @param string $id
    * @return void
    */
    public function admin_delete($id = null) {
      if (!$this->request->is('post')) {
          throw new MethodNotAllowedException();
      }
      $this->User->id = $id;
      if (!$this->User->exists()) {
          throw new NotFoundException(__('Invalid user'));
      }
      if ($this->User->delete()) {
          $this->Session->setFlash(__('User deleted'), 'default', array('class' => 'success'));
          return $this->redirect(array('action' => 'index'));
      }
      $this->Session->setFlash(__('User was not deleted'));
      return $this->redirect(array('action' => 'index'));
    }

    /**
    * admin_sync_duplicates method
    *
    * @param string $id
    * @return void
    */
    public function admin_sync_duplicates($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Synchronise records with the same bca_no.
        $this->User->syncDuplicates($id);

        $this->Session->setFlash(__('The duplicate users have been synchronised.'), 'default', array('class' => 'success'));

        //"Add", "Edit", "Delete" & "Sync" buttons shown if user is this list.
        //$admins = array(1072); //List of authorised BCA members.
        //$this->set('task_admin', in_array($this->Auth->user('bca_no'), $admins));

        return $this->redirect(array('action' => 'index'));
    }

    public function admin_validation_errors () {}


    /**
    * admin_send_email_update_to_admin method
    * Send an email address update instruction to the Administrator.
    *
    * @param string $id
    * @return void
    */
    public function admin_send_email_update_to_admin ($id = null) {

        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->User->contain();
        $user = $this->User->read(null, $id);

        //If there is an email address to send.
        if (!empty($user['User']['email'])) {

            //Send and save a copy of the email.
            if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
                throw new NotFoundException(__('Invalid email configuration'));
            }

            //Let Membership Administrator know.
            $viewVars = array(
                'bca_no' => $user['User']['bca_no'],
                'full_name' => $user['User']['full_name'],
                'organisation' => $user['User']['organisation'],
                'class' => $user['User']['class'],
                'new_email' => $user['User']['email'],
            );

            $email = array(
                'user_id' => $this->Auth->user('id'),
                //'bca_no' => $this->Auth->user('bca_no'),
                'to' => $configEmailAddresses['membership_admin2'],
                'subject' => 'BCA Online email update. (Ref: '. $user['User']['bca_no'] . ')',
                'template' => 'users-email_update-to_admin',
                'forceSend' => true,
                'viewVars' => $viewVars,
            );
            $this->User->SentEmail->send($email);

            $this->Session->setFlash(__('The email has been sent.'),'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('There is no email address to send.'));
        }

        return $this->redirect(array('action' => 'index'));
    }


    /**
    * admin_mark_deceased method
    * Mark the User deceased.
    *
    * @param string $id
    * @return void
    */
    public function admin_mark_deceased ($id = null) {

        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Overwrite these values.
        $data = array('User' =>
            array(
                'id' => $id,
                'password' => null,
                'active' => 0,
                'email' => null,
                'bca_status' => 'Deceased',
                'address1' => 'DECEASED',
                'address2' => '****',
                'address3' => '****',
            )
        );

        if ($this->User->save($data)) {
            $this->Session->setFlash(__('The User has been mark as deceased'), 'default', array('class' => 'success'));
            return $this->redirect(array('action' => 'view', $id));
        } else {
            $this->Session->setFlash(__('The User was not mark as deceased'));
            return $this->redirect(array('action' => 'view', $id));
        }
    }

    /**
    * admin_report_mismatched_names_uu
    *
    * Compares User records against the other User records with the same BCA No. and lists those where the name doesn't match.
    */
    function admin_report_mismatched_names_uu() {

        // For each BCA#, find the user records where there are other user records with a different name.
        // If any of those records are not marked as the same person then show all the records otherwise
        // show none of them.

        $mySQL =
            'SELECT User.bca_no, User.forename, User.surname,
                    User.organisation, User.class, User.email, User.address1, User.address2
            FROM users AS User
            WHERE
                EXISTS (SELECT u2.bca_no
                FROM users AS u2
                WHERE User.bca_no = u2.bca_no AND
                    (User.forename <> u2.forename OR User.surname <> u2.surname)) AND
                EXISTS (SELECT u3.bca_no
                FROM users AS u3
                WHERE User.bca_no = u3.bca_no AND (u3.same_person = 0))
            ORDER BY User.bca_no';
            //LIMIT 10';

        $db = $this->User->getDataSource();

        $mismatchedLines = $db->fetchALL($mySQL);

        $this->set('mismatchedLines', $mismatchedLines);
    }


    /**
    * admin_mark_same_person
    *
    * Marks all the records with the same BCA as the same person so they won't appear on the mismatch names report.
    */
    function admin_mark_same_person($bca_no = null) {

        $this->request->onlyAllow('post');

        // Make sure it is numeric.
        if (!is_numeric($bca_no)) throw new NotFoundException(__('Not a valid BCA No.'));


        if ($this->User->MarkSamePerson($bca_no)) {
            $this->Session->setFlash(__('Updated'), 'default', array('class' => 'success'));
            return $this->redirect(array('action' => 'report_mismatched_names_uu'));
        } else {
            $this->Session->setFlash(__('Not updated'));
            return $this->redirect(array('action' => 'report_mismatched_names_uu'));
        }
    }

    /**
    * Refreshes the Auth session
    * After https://learntech.imsu.ox.ac.uk/blog/?p=946
    * @param string $field
    * @param string $value
    * @return void
    */
    protected function _refreshAuth($field = '', $value = '') {

        if (!empty($field) && !empty($value)) { //Update just a single field in the Auth session data

            $this->Session->write(AuthComponent::$sessionKey .'.'. $field, $value);
        } else {

            if (!isset($this->User)) {
                $this->loadModel('User'); //Load the User model, if it is not already loaded
            }

            $this->User->contain();
            $user = $this->User->read(false, $this->Auth->user('id')); //Get the user's data
            unset($user['User']['password']); //Don't save password in the session unhashed.
            $this->Auth->login($user['User']); //Must have user data at top level of array that is passed to login method
        }
    }

    /*
    * /
    public function admin_test ($user_id = null) {

        //$result = DATABASE_CONFIG::$default;
        //$result = $this->User->getDataSource();
        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('default');
        $username = $dataSource->config['password'];

        debug($username); die();
    }
    /* */


}




