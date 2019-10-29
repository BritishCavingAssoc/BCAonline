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

        $this->Auth->allow('request_login_details', 'details_found','details_not_found', 'password_reset', 'password_reset_failed');
    }

    public function isAuthorized($user) {

        //return true;

        //Logged in users can do the following.
        if (in_array($this->action, array('index', 'view', 'password_update', 'members_area', 'nosubscription', 'email_preferences',
            'email_update', 'profile_faq', 'become_admin'))) {

            return true;
        }

        //Role 'User Enquiry' can do the following.
        if ($this->UserUtilities->hasRole(array('UserEnquiry'))) {
            if (in_array($this->action, array('admin_dashboard', 'admin_index', 'admin_view'))) {

                return true;
            }
        }

        //Role 'User Manager' can do the following.
        if ($this->UserUtilities->hasRole(array('UserManager'))) {
            if (in_array($this->action, array('admin_dashboard', 'admin_index', 'admin_view'))) {

                return true;
            }
        }

        //Role 'MailingLists' can do the following.
        if ($this->UserUtilities->hasRole(array('UserMailingLists'))) {
            if (in_array($this->action, array('admin_dashboard', 'admin_mailing_list_index', 'admin_mailing_list_individuals', 'admin_mailing_list_groups',
                'admin_set_email_status',))) {

                return true;
            }
        }

        //Role Ballot can do the following.
        if ($this->UserUtilities->hasRole(array('UserBallot'))) {
            if (in_array($this->action, array('admin_dashboard', 'admin_mailing_list_index', 'admin_mailing_list_ballot', 'admin_set_email_status',))) {

                return true;
            }
        }

        //Role 'User Admin' can do the following.
        if ($this->UserUtilities->hasRole(array('UserAdmin'))) {
            if (in_array($this->action, array('admin_dashboard', 'admin_index', 'admin_view', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sync_duplicates',
                'admin_send_email_update_to_admin', 'admin_send_address_update_to_admin',
                'admin_mark_deceased',
                'admin_report_ind_mismatched_names_uu', 'admin_mark_same_person', 'admin_email_ind_mismatched_names_uu',
                'admin_report_multiclass_users_uu', 'admin_email_multiclass_users_uu',
                'admin_lapse_users',
                'admin_mailing_list_index', 'admin_mailing_list_individuals', 'admin_mailing_list_groups', 'admin_mailing_list_ballot', 'admin_set_email_status',
                )))
            {
                return true;
            }
        }

        //Role 'Admin' can do the following:
        //'admin_become_user', 'become_admin',


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
        $this->set('id_name', $this->Auth->user('id_name'));

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
        $this->set('id_name', $this->Auth->user('id_name'));
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
                    'fields' => array('id', 'bca_no', 'username', 'id_name', 'class', 'organisation'),
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
                            'id_name' => $user['User']['id_name'],
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
                            'id_name' => $syncd_user['id_name'],
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

        $this->set('id_name', $this->Auth->user('id_name')); //For view heading.

        //Populate view.
        if (!$this->request->is('post')) {

            $this->request->data = $this->User->find('first', array(
                'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('email'), 'contain' => false));

            $this->request->data['User']['email_old'] = $this->request->data['User']['email']; //Keep old email address for the email.

            unset($this->request->data['User']['email']); //Don't show existing email.

        } else { //Process submitted view data.

            //Sanity checks.
            if ($this->request->data['User']['email'] != $this->request->data['User']['email_confirm']) {

                $this->Session->setFlash(__('The email addresses do not match. Please try again.'));
                return;
            }

            if ($this->request->data['User']['email'] == $this->request->data['User']['email_old']) {

                $this->Session->setFlash(__('No change. This email addresses is the same as your old one.'));
                return;
            }

            $this->request->data['User']['email_status'] = 'OK'; //Assume the new email address is OK.

            //Save new email address.
            if ($this->User->save($this->request->data, array('fieldlist' => array('email', 'email_status')))) {

                //Update the Auth Session user data.
                $this->_refreshAuth();

                //Send and save a copy of the confirmation email.
                if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
                    throw new NotFoundException(__('Invalid email configuration'));
                }

                $viewVars = array(
                    'id_name' => $this->Auth->user('id_name'),
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
                    'id_name' => $this->Auth->user('id_name'),
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
                            'id_name' => $syncd_user['id_name'],
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

        $this->set('id_name', $user['User']['id_name']); //For view.

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
                    'id_name' => $user['User']['id_name'],
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
                            'id_name' => $syncd_user['id_name'],
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
                    'id_name' => $this->Auth->user('id_name'),
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
                            'id_name' => $syncd_user['id_name'],
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

        $this->set('id_name', $this->Auth->user('id_name')); //For view heading.
    }


    //This function will be called if in admin area and session times out due to inactivity.
    //Therefore function needed in order for redirect to login screen to work (assuming logoutRedirect = Users.login).
    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
    * admin_dashboard
    *
    */
    public function admin_dashboard() {

        // Display a summary of totals.
        // Initialise all table cells. Current Individual Members.
        $line = array('C' => 0, 'NC' => 0, 'STU' => 0, 'U18' => 0, 'BCA' => 0, 'BCRA' => 0);

        $table1 = array(
            'Title' => array('C' => 'C', 'NC' => 'NC', 'STU' => 'STU', 'U18' => 'U18', 'BCA' => 'Total BCA', 'BCRA' => 'Of Which BCRA'),
            'Totals' => $line,
            'CIM' => $line,
            'DIM' => $line
        );

        // Gather data. Individuals
        $fields = array('User.class', 'User.insurance_status', 'COUNT(User.id) as my_count');
        $group = array('User.class', 'User.insurance_status');
        $conditions = array('User.class' => array('CIM', 'DIM'), 'User.bca_status' => array('Current', 'Overdue'), 'NOT' => array('User.insurance_status' => array('AN')));

        $result = $this->User->find('all', array('fields' => $fields, 'group' => $group, 'conditions' => $conditions, 'recursive' => -1));

        // Update the table with the values.
        for ($i=0; $i < count($result); $i++) {

            // Add a new line if necessary.
            if (empty($table1[$result[$i]['User']['class']])) { $table1[$result[$i]['User']['class']] = $line;}

            $table1[$result[$i]['User']['class']][$result[$i]['User']['insurance_status']] += $result[$i][0]['my_count'];
            $table1[$result[$i]['User']['class']]['BCA'] += $result[$i][0]['my_count'];

            $table1['Totals'][$result[$i]['User']['insurance_status']] += $result[$i][0]['my_count'];
            $table1['Totals']['BCA'] += $result[$i][0]['my_count'];
        }


        // Initialise all table cells. Current Group Members.
        $line = array('Y' => 0, 'N' => 0, 'BCA' => 0, 'BCRA' => 0);

        $table2 = array(
            'Title' => array('Y' => 'PL', 'N' => 'No PL', 'BCA' => 'Total BCA', 'BCRA' => 'Of Which BCRA'),
            'Totals' => $line
        );

        // Gather data. Group
        $fields = array('User.class_code', 'User.insurance_status', 'COUNT(User.id) as my_count');
        $group = array('User.class_code', 'User.insurance_status');
        $conditions = array('User.class' => array('GRP'), 'User.bca_status' => array('Current', 'Overdue'));

        $result = $this->User->find('all', array('fields' => $fields, 'group' => $group, 'conditions' => $conditions, 'recursive' => -1));

        // Update the table with the values.
        for ($i=0; $i < count($result); $i++) {

            // Add a new line if necessary.
            if (empty($table2[$result[$i]['User']['class_code']])) { $table2[$result[$i]['User']['class_code']] = $line;}

            $table2[$result[$i]['User']['class_code']][$result[$i]['User']['insurance_status']] += $result[$i][0]['my_count'];
            $table2[$result[$i]['User']['class_code']]['BCA'] += $result[$i][0]['my_count'];

            $table2['Totals'][$result[$i]['User']['insurance_status']] += $result[$i][0]['my_count'];
            $table2['Totals']['BCA'] += $result[$i][0]['my_count'];
        }

        // Initialise table cells. All members by status.
        $line = array('Current' => 0, 'Overdue' => 0, 'Lapsed' => 0, 'Resigned' => 0, 'Deceased' => 0, 'Total' => 0, 'AN' => 0);

        $table3 = array(
            'Title' => array('Current' => 'Current', 'Overdue' => 'Overdue', 'Lapsed' => 'Lapsed', 'Resigned' => 'Resigned', 'Deceased' => 'Deceased', 'Total' => 'Total', 'AN' => 'AN'),
            'Totals' => $line
        );

        // Gather data.
        $fields = array('year(User.date_of_expiry) as my_year', 'User.bca_status', 'User.insurance_status', 'COUNT(User.id) as my_count');
        $group = array('year(User.date_of_expiry)', 'User.bca_status', 'User.insurance_status');
        $order = array('year(User.date_of_expiry) desc');

        $result = $this->User->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'recursive' => -1));

        // Update the table with the values.
        for ($i=0; $i < count($result); $i++) {

            // Add a new line if necessary.
            if (empty($table3[$result[$i][0]['my_year']])) { $table3[$result[$i][0]['my_year']] = $line;}

            // If not insurance status AN (ANother Route).
            if ($result[$i]['User']['insurance_status'] <> 'AN') {
                $table3[$result[$i][0]['my_year']][$result[$i]['User']['bca_status']] += $result[$i][0]['my_count'];
                $table3[$result[$i][0]['my_year']]['Total'] += $result[$i][0]['my_count'];

                $table3['Totals'][$result[$i]['User']['bca_status']] += $result[$i][0]['my_count'];
                $table3['Totals']['Total'] += $result[$i][0]['my_count'];
            } else {
                $table3[$result[$i][0]['my_year']]['AN'] += $result[$i][0]['my_count'];
                $table3['Totals']['AN'] += $result[$i][0]['my_count'];
            }
        }

        $this->set('table1', $table1);
        $this->set('table2', $table2);
        $this->set('table3', $table3);

    }

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

        return $this->redirect(array('action' => 'index'));
    }

    public function admin_validation_errors () {}


    /**
    * admin_send_email_update_to_admin method
    * Send an email address update request to the BCA Membership Admin.
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

            //Let BCA Membership Administrator know.
            $viewVars = array(
                'bca_no' => $user['User']['bca_no'],
                'id_name' => $user['User']['id_name'],
                'organisation' => $user['User']['organisation'],
                'class' => $user['User']['class'],
                'new_email' => $user['User']['email'],
            );

            $email = array(
                'user_id' => $this->Auth->user('id'),
                'to' => $configEmailAddresses['membership_admin2'],
                'subject' => 'BCA Online email update request. (Ref: '. $user['User']['bca_no'] . ')',
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
    * send_address_update_to_admin method
    * Send an address update request to the BCA Membership Admin.
    *
    * @param string $id
    * @return void
    */
    public function admin_send_address_update_to_admin ($id = null) {

        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->User->contain();
        $user = $this->User->read(null, $id);

        //Send and save a copy of the email.
        if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
            throw new NotFoundException(__('Invalid email configuration'));
        }

        //Let BCA Membership Administrator know.
        $viewVars = array(
            'bca_no' => $user['User']['bca_no'],
            'id_name' => $user['User']['id_name'],
            'organisation' => $user['User']['organisation'],
            'class' => $user['User']['class'],
            'new_address' => array('address1' => $user['User']['address1'], 'address2' => $user['User']['address2'], 'address3' => $user['User']['address3'],
                'town' => $user['User']['town'], 'county' => $user['User']['county'], 'postcode' => $user['User']['postcode'], 'country' => $user['User']['country'], ),
        );

        $email = array(
            'user_id' => $this->Auth->user('id'),
            'to' => $configEmailAddresses['membership_admin2'],
            'subject' => 'BCA Online address update request. (Ref: '. $user['User']['bca_no'] . ')',
            'template' => 'users-address_update-to_admin',
            'forceSend' => true,
            'viewVars' => $viewVars,
        );
        $this->User->SentEmail->send($email);

        $this->Session->setFlash(__('The email has been sent.'),'default', array('class' => 'success'));


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
    * admin_report_ind_mismatched_names_uu
    *
    * For individuals, compares User records against the other User records with the same BCA No. and lists those where the name doesn't match.
    */
    function admin_report_ind_mismatched_names_uu() {

        // For each BCA#, find the user records where there are other user records with a different name.
        // If any of those records are not marked as the same person then show all the records otherwise
        // show none of them.

        $mySQL =
            'SELECT User.bca_no, User.forename, User.surname,
                    User.organisation, User.class, User.email, User.address1, User.address2
            FROM users AS User
            WHERE
                (User.class = \'CIM\' OR User.class = \'DIM\') AND
                EXISTS (SELECT u2.bca_no
                    FROM users AS u2
                    WHERE User.bca_no = u2.bca_no AND
                        (u2.class = \'CIM\' OR u2.class = \'DIM\') AND
                        (User.forename <> u2.forename OR User.surname <> u2.surname)) AND
                EXISTS (SELECT u3.bca_no
                    FROM users AS u3
                    WHERE User.bca_no = u3.bca_no AND
                        (u3.class = \'CIM\' OR u3.class = \'DIM\') AND
                        (u3.same_person = 0))
            ORDER BY User.bca_no';
            //LIMIT 10';

        $db = $this->User->getDataSource();

        $mismatchedLines = $db->fetchALL($mySQL);

        $this->set('mismatchedLines', $mismatchedLines);
    }


    /**
    * admin_mark_same_person
    *
    * Marks all the individual user records with the same BCA as the same person so they won't appear on the mismatch names report.
    */
    function admin_mark_same_person($bca_no = null) {

        $this->request->onlyAllow('post');

        // Make sure it is numeric.
        if (!is_numeric($bca_no)) throw new NotFoundException(__('Not a valid BCA No.'));


        if ($this->User->MarkSamePerson($bca_no)) {
            $this->Session->setFlash(__('Updated'), 'default', array('class' => 'success'));
            return $this->redirect(array('action' => 'report_ind_mismatched_names_uu'));
        } else {
            $this->Session->setFlash(__('Not updated'));
            return $this->redirect(array('action' => 'report_ind_mismatched_names_uu'));
        }
    }


    /**
    * admin_email_ind_mismatched_names_uu
    *
    * For individuals, email the Mismatching Names report to the current operator.
    *
    */
    function admin_email_ind_mismatched_names_uu() {

        //Get data.
        $mySQL =
            'SELECT User.bca_no, User.forename, User.surname,
                    User.organisation, User.class, User.email, User.address1, User.address2
            FROM users AS User
            WHERE
                (User.class = \'CIM\' OR User.class = \'DIM\') AND
                EXISTS (SELECT u2.bca_no
                    FROM users AS u2
                    WHERE User.bca_no = u2.bca_no AND
                        (u2.class = \'CIM\' OR u2.class = \'DIM\') AND
                        (User.forename <> u2.forename OR User.surname <> u2.surname)) AND
                EXISTS (SELECT u3.bca_no
                    FROM users AS u3
                    WHERE User.bca_no = u3.bca_no AND
                        (u3.class = \'CIM\' OR u3.class = \'DIM\') AND
                        (u3.same_person = 0))
            ORDER BY User.bca_no';
            //LIMIT 10';

        $db = $this->User->getDataSource();

        $mismatchedLines = $db->fetchALL($mySQL);

        //Send email.
        $this->loadmodel('SentEmail');

        $viewVars = array(
            'full_name' => $this->Auth->user('full_name'),
            'mismatchedLines' => $mismatchedLines,
        );

        $email = array(
            'user_id' => $this->Auth->user('id'),
            'subject' => 'BCA Online Mismatch User Name (UU) Report for Individual Members.',
            'template' => 'users-admin_email_ind_mismatched_names_uu',
            'forceSend' => true,
            'save' => false,
            'viewVars' => $viewVars,
        );

        if(!$this->SentEmail->send($email)) {
            $this->Session->setFlash(__('The email was not sent.'));
        } else {
            $this->Session->setFlash(__('The email was sent.'), 'default', array('class' => 'success'));
        }

        return $this->redirect(array('action' => 'admin_report_ind_mismatched_names_uu'));
    }

    /**
    * admin_report_multiclass_users_uu
    *
    * List those users that are both individual and group members.
    * Compares the master database users against master database.
    *
    */
    function admin_report_multiclass_users_uu() {

        // For each BCA#, find those who are in both Group and Individual classes. It is wrong to be in both.

        $mySQL =
            'SELECT User.id, User.bca_no, User.forename, User.surname, User.organisation, User.class,
                User2.forename, User2.surname, User2.organisation, User2.class
            FROM users AS User, users AS User2
            WHERE
                User.bca_no = User2.bca_no AND
                ((User.class = \'CIM\' AND User2.class = \'GRP\') OR
                (User.class = \'DIM\' AND User2.class = \'GRP\') OR
                (User.class = \'GRP\' AND User2.class = \'CIM\') OR
                (User.class = \'GRP\' AND User2.class = \'DIM\'))
            ORDER BY User.bca_no';
            //LIMIT 10';

        $db = $this->User->getDataSource();

        $multiclassLines = $db->fetchALL($mySQL);

        $this->set('multiclassLines', $multiclassLines);
    }


    /**
    * admin_email_multiclass_users_uu
    *
    * Email the multiclass users report to the current operator.
    *
    */
    function admin_email_multiclass_users_uu() {

        //Get data.
        $mySQL =
            'SELECT User.id, User.bca_no, User.forename, User.surname, User.organisation, User.class,
                User2.bca_no, User2.forename, User2.surname, User2.organisation, User2.class
            FROM users AS User, users AS User2
            WHERE
                User.bca_no = User2.bca_no AND
                ((User.class = \'CIM\' AND User2.class = \'GRP\') OR
                (User.class = \'DIM\' AND User2.class = \'GRP\') OR
                (User.class = \'GRP\' AND User2.class = \'CIM\') OR
                (User.class = \'GRP\' AND User2.class = \'DIM\'))
            ORDER BY User.bca_no';
            //LIMIT 10';

        $db = $this->User->getDataSource();

        $multiclassLines = $db->fetchALL($mySQL);

        //Send email.
        $this->loadmodel('SentEmail');

        $viewVars = array(
            'full_name' => $this->Auth->user('full_name'),
            'multiclassLines' => $multiclassLines,
        );

        $email = array(
            'user_id' => $this->Auth->user('id'),
            'subject' => 'BCA Online Multiclass Users (UU) Report.',
            'template' => 'users-admin_email_multiclass_users_uu',
            'forceSend' => true,
            'save' => false,
            'viewVars' => $viewVars,
        );

        if(!$this->SentEmail->send($email)) {
            $this->Session->setFlash(__('The email was not sent.'));
        } else {
            $this->Session->setFlash(__('The email was sent.'), 'default', array('class' => 'success'));
        }

        return $this->redirect(array('action' => 'report_multiclass_users_uu'));
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


    /**
    * admin_lapse_users
    *
    * Lapses CIMs and DIMs that haven't renewed.
    *
    * @return void
    */
    public function admin_lapse_users() {

        //Mark 'Lapsed' old DIMs who haven't been caught by DG's routines. DIM are normally his responsibility.
        //Current or Overdue DIMs who date of expiry is more than 11 months ago.
        $fields = array('User.bca_status' => "'Lapsed'");
        $conditions = array('User.class' => 'DIM', 'User.bca_status' => array('Current', 'Overdue'), 'User.date_of_expiry <' => date('Y-m-d', strtotime('-11 months')));
        $this->User->updateAll($fields, $conditions);
        $rows = $this->User->getAffectedRows();
        $message = "DIMs lapsed: ".$rows." ";


        //Mark 'Lapsed' CIMs more than 3 months expired.
        //Current or Overdue CIMs who date of expiry is more than 3 months ago.
        $fields = array('User.bca_status' => "'Lapsed'");
        $conditions = array('User.class' => 'CIM', 'User.bca_status' => array('Current', 'Overdue'), 'User.date_of_expiry <' => date('Y-m-d', strtotime('-3 months')));
        $this->User->updateAll($fields, $conditions);
        $rows = $this->User->getAffectedRows();
        $message = $message."CIMs lapsed: ".$rows." ";

        /* Don't implement Overdue yet
        //Mark 'Overdue' remaining expired CIMs.
        //Current CIMs whose date of expiry before today.
        $fields = array('User.bca_status' => "'Overdue'");
        $conditions = array('User.class' => 'CIM', 'User.bca_status' => 'Current', 'User.date_of_expiry <' => date('Y-m-d'));
        $this->User->updateAll($fields, $conditions);
        $rows = $this->User->getAffectedRows();
        $message = $message."CIMs overdue: ".$rows;
        */

        $this->Session->setFlash($message);
        return $this->redirect(array('action'=>'dashboard'));
    }

    /**
    * Mailing Lists front page.
    */
    public function admin_mailing_list_index() {}

    /**
    * Mailing List of individuals for newsletter
    */
    public function admin_mailing_list_individuals() {

        $fields = array('DISTINCT email', 'id_name');
        $conditions = array('User.class' => array('CIM', 'DIM'), 'User.bca_status' => array('Current', 'Overdue'), 'User.admin_email_ok <>' => 0,
            'User.bca_email_ok <>' => 0, 'User.email <>' => '');

        $result = $this->User->find('all', array('fields' => $fields, 'conditions' => $conditions, 'order' => array('User.email'), 'recursive' => -1));

        $this->set('users', $result);
    }

    /**
    * Mailing List of clubs/groups for newsletter
    */
    public function admin_mailing_list_groups() {

        $fields = array('DISTINCT email', 'id_name');
        $conditions = array('User.class' => array('GRP'), 'User.bca_status' => array('Current', 'Overdue'), 'User.email <>' => '');

        $result = $this->User->find('all', array('fields' => $fields, 'conditions' => $conditions, 'order' => array('User.email'), 'recursive' => -1));

        $this->set('users', $result);
    }

    /**
    * Mailing List for a ballot
    */
    public function admin_mailing_list_ballot() {

        ini_set('max_execution_time', 60);

        //Find all current voting bca members.
        //ie WHERE (class = 'CIM' or class = 'DIM' or (class = 'GRP' AND (class_code = 'GRP' or 'ACB' or 'CCB' or 'RCC'))) AND bca_status = 'Current'

        $fields = array('bca_no', 'class', 'class_code', 'id_name', 'full_name', 'organisation', 'email', 'address1', 'address2', 'address3',
            'town', 'county', 'postcode', 'country', 'admin_email_ok');

        $conditions =
            array('OR' =>
                array(
                    'class' => array('CIM', 'DIM'),
                    array('class' => 'GRP', 'Class_code' => array('ACB', 'CCB', 'GRP', 'RCC'))
                ),
                'bca_status' => array('Current'),

            );

        $order = array('bca_no');

        $users = $this->User->find('all', array('fields' => $fields, 'conditions' => $conditions, 'order' => $order, 'recursive' => -1));

        //Some members join by more than one organisation and end up with more than one record. There should only be one.
        //If email address is present in one record make sure it is present in all the duplicates for that member.
        //Then remove any duplicates. The any address and/or email should be valid for all so it doesn't matter which we delete.

        //Work through all users. $users is ordered by bca_no.
        $no_users = count($users);
        $c1 = 0;
        while ($c1 < $no_users) {

            //If a block of duplicates find the first email address.
            $my_email = '';
            $c2 = 0;
            do {
                if (trim($users[$c1+$c2]['User']['email']) != '') $my_email = trim($users[$c1+$c2]['User']['email']);

                $c2++;
                if ($c1+$c2 >= $no_users) break; //Don't exceed the $users array's index.

            } while ($users[$c1+$c2]['User']['bca_no'] == $users[$c1]['User']['bca_no'] && $my_email == '');

            //If found an email address, assign it to any records in the block missing an email address.
            if ($my_email != '') {
                $c2 = 0;
                do {
                    if (trim($users[$c1+$c2]['User']['email']) == '') $users[$c1+$c2]['User']['email'] = $my_email;

                    $c2++;
                    if ($c1+$c2 >= $no_users) break; //Don't exceed the $users array's index.

                } while ($users[$c1+$c2]['User']['bca_no'] == $users[$c1]['User']['bca_no']);
            }

            //Start on next block;
            $c1 += $c2;
        }

        for ($c1 = 0; $c1 < $no_users; $c1++) {

            //Add unique no.
            $ballot_id = sha1(uniqid());
            $users[$c1]['User']['ballot_id'] = substr($ballot_id,0,3)."-".substr($ballot_id,3,3)."-".substr($ballot_id,6,3);

            //Set house as either be house of individuals (IND) or house of groups (GRP).
            if (in_array($users[$c1]['User']['class'], array('CIM', 'DIM'))) {
                $users[$c1]['User']['house'] = 'IND';
            } else {
                $users[$c1]['User']['house'] = 'GRP';
            }

            //Blank email address if don't have permission to use it.
            if ($users[$c1]['User']['admin_email_ok'] == 0) {
                $users[$c1]['User']['email'] = '';
            }
        }

        //Check no duplicate ballot id.
        $duplicates = false;
        for ($c1 =0; $c1 < $no_users - 1; $c1++) {

            for ($c2 = $c1+1; $c2 < $no_users; $c2++) {

                if ($users[$c1]['User']['ballot_id'] == $users[$c2]['User']['ballot_id']) {
                    $duplicates = true;
                    break;
                }

            }
            if ($duplicates) break;
        }

        //Remove duplicates BCA members.
        for ($my_bca_no = '', $c1 = 0; $c1 < $no_users; $c1++) {

            if ($users[$c1]['User']['bca_no'] == $my_bca_no) {
                unset($users[$c1]);
            } else {
                $my_bca_no = $users[$c1]['User']['bca_no'];
            }
        }

        //Sort users into house then email address order ready for concatenation step below.
        usort($users,
            function($a, $b) {
                return strcasecmp($a['User']['house'].$a['User']['email'], $b['User']['house'].$b['User']['email']);
            }
        );

        //Concatenate the name and ballot token fields of multiple occurrences of the same email address to form a single email record.
        //Mailing lists discard repeated email addresses.
        //Since sorted into house/email order, group email addresses should only occur once so won't be concatenated.
        $no_users = count($users);
        $occurance = 1;
        $last_email = '';
        for ($c1 = 0; $c1 < $no_users; $c1++) {

            //If email is '' or different from the previous row then reset the occurance to 1.
            if ($users[$c1]['User']['email'] == '' || strcasecmp($users[$c1]['User']['email'], $last_email) != 0) {
                $last_email = $users[$c1]['User']['email'];
                $users[$c1]['User']['occurance'] = $occurance = 1;
            } else {
                $users[$c1-$occurance]['User']['occurance'] = $occurance+1;
                $users[$c1-$occurance]['User']['id_name'] = $users[$c1-$occurance]['User']['id_name'].', '.$users[$c1]['User']['id_name'];
                $users[$c1-$occurance]['User']['full_name'] = $users[$c1-$occurance]['User']['full_name'].', '.$users[$c1]['User']['full_name'];
                $users[$c1-$occurance]['User']['ballot_id'] = $users[$c1-$occurance]['User']['ballot_id'].', '.$users[$c1]['User']['ballot_id'];
                unset($users[$c1]);
                $occurance++;
            }
        }

        $this->set('duplicates', $duplicates);
        $this->set('users', $users);

        ini_set('max_execution_time', 30);
    }


    /**
    * Bulk set the email status flag. OK, Soft Bounced, Hard Bounced, Black Listed, etc.
    *
    * The processed emails are remove from the form.
    * The unprocessed (badly formed, unrecognised) emails are retained for the user to edit or delete.
    */
    public function admin_set_email_status(){

        if ($this->request->is('post')) {

            $success = true;

            $fields = array(
                array('name' => 'hard_bounced_emails', 'code' => 'HB'),
                array('name' => 'soft_bounced_emails', 'code' => 'SB'),
                array('name' => 'black_listed_emails', 'code' => 'BL'),
                array('name' => 'ok_emails', 'code' => 'OK')
            );

            //Set the email status flag for all the emails listed in each field.
            foreach ($fields as $field) {

                if (!empty($this->request->data['User'][$field['name']])) {

                    //Returns a list of unprocessed emails.
                    $this->request->data['User'][$field['name']] = $this->User->SetEmailStatus($this->request->data['User'][$field['name']], $field['code']);

                    if (!empty($this->request->data['User'][$field['name']])) $success = false;
                }
            }

            if ($success) {
                $this->Session->setFlash(__('Processing complete.'), 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash(__('Incomplete. The unprocessed emails are listed below.'));
            }
        }
    }


    /**
    * Become as though logged in as user.
    * Only the Admin role can do this in debugging mode.
    * Useful for testing.
    */
    public function admin_become_user($id = null) {

        if (Configure::read('debug') == 0) {
            throw new BadRequestException(__('Only available in debug mode'));
        }

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Remember the current user id.
        $admin_id = $this->Auth->user('id');

        //Get details of the new user.
        $user_info = $this->User->find('first', array('conditions' =>array('User.id' => $id), 'contain' => false));

        //Login as new user.
        //Remember former Admin user id in the Session.
        // - Used to swap back to.
        // - Used to check if in swapped state.
        if (!empty($user_info)) {
            if ($this->Auth->login($user_info['User'])) {

                //Don't overwrite the Admin id if it already exists. This is the one we want to return to.
                //Allows swap to a sucession of user before swapping back to Admin.
                if (!$this->Session->check('Auth.Admin.id')) {
                    $this->Session->write('Auth.Admin.id', $admin_id);
                }
                $this->Session->setFlash(__('Swap successful.'), 'default', array('class' => 'success'));
                return $this->redirect(array('action'=>'members_area', 'admin' => false));
            }
        }
        $this->Session->setFlash(__('Failed to swap user.'));
        return $this->redirect(array('action'=>'index'));
    }

    /**
    * Swap back to previous Admin user after being logged in as another user.
    */
    public function become_admin() {

        //Recover original Admin id.
        $admin_id = $this->Session->read('Auth.Admin.id');

        if (!$this->User->exists($admin_id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Get details of the new user.
        $user_info = $this->User->find('first', array('conditions' =>array('User.id' => $admin_id), 'contain' => false));

        //Login as former Admin.
        if (!empty($user_info)) {
            if ($this->Auth->login($user_info['User'])) {

                //Remove Admin id from Session. No longer in swapped state.
                $this->Session->delete('Auth.Admin.id');

                $this->Session->setFlash(__('Swap successful.'), 'default', array('class' => 'success'));
                return $this->redirect(array('action'=>'members_area', 'admin' => false));
            }
        }
        $this->Session->setFlash(__('Failed to swap user.'));
        return $this->redirect(array('action'=>'members_area', 'admin' => false));
    }
}




