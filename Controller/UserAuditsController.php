<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UserAuditsController extends AppController {

    public $components = array('Filter.Filter');

    public $paginate = array(
        'limit' => 100,
        'order' => array('UserAudit.id' => 'desc')
    );

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow(); // Allow all to public.
    }

    public function isAuthorized($user) {

        //User Enquiry/Manager/Admin role can do the following.
        if ($this->UserUtilities->hasRole(array('UserEnquiry', 'UserManager', 'UserAdmin'))) {
            if (in_array($this->action, array('admin_index', 'admin_compare_current', 'admin_compare_adjacent',
                'admin_changes_report'))) {
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
            'UserAudit' => array (
                'UserAudit.user_id' => array('label' => 'User Id', 'condition' => '=', 'type' => 'text'),
                'UserAudit.bca_no' => array('label' => 'BCA No', 'condition' => '=', 'type' => 'text'),
            )
        )
    );

    /**
    * admin_index method
    *
    * @return void
    */
    public function admin_index() {

        //Empty is allowed for the search filter.
        //Can't set in the filter configuration, so override the model's validation here.
        //$this->UserAudit->validate['bca_no']['allowEmpty'] = true;

        //$this->UserAudit->recursive = 0;
        $this->set('userAudits', $this->paginate());

    }

    /**
    * admin_view method
    *
    * @param string $id
    * @return void
    * /
    public function admin_view($id = null) {

        if (!$this->UserAudit->exists($id)) {
            throw new NotFoundException(__('Invalid user audit'));
        }

        $this->set('userAudit', $this->UserAudit->read(null, $id));

        //"Add", "Edit" & "Delete" buttons shown if user is this list.
        $admins = array(1072, 5658); //List of authorised BCA members.
        $this->set('task_admin', in_array($this->Auth->user('bca_no'), $admins));
    }

    /**
    * admin_compare_current method
    *
    * @param string $id
    * @return void
    */
    public function admin_compare_current ($id = null) {

        if (!$this->UserAudit->exists($id)) {
            throw new NotFoundException(__('Invalid user audit id'));
        }

        $userAuditSelected = $this->UserAudit->find('first', array('conditions' => array('UserAudit.id' => $id)));

        $options = array(
            'conditions' => array('UserAudit.user_id' => $userAuditSelected['UserAudit']['user_id']), //, 'UserAudit.id >' => $id),
            'order' => array('UserAudit.id' => 'desc'),
        );

        // Find current (most recent) record with the same user_id.
        $userAuditCurrent = $this->UserAudit->find('first', $options);

        //if ($userAuditSelected['UserAudit']['id'] == $userAuditCurrent['UserAudit']['id']) {

//             $this->Session->setFlash(__('Current record selected'));
  //      }

        //Find neighbours with the same user_id.
        $options = array('field' => 'id', 'value' => $id,
            'conditions' => array('UserAudit.user_id' => $userAuditSelected['UserAudit']['user_id']));

        $neighbours = $this->UserAudit->find('neighbors', $options);

        // Assign next and previous id. Use the currently selected record if hit the end stops.
        if (!empty($neighbours['next'])) {
            $next_id = $neighbours['next']['UserAudit']['id'];
        } else {
            $next_id = $id;
            $this->Session->setFlash(__('No later record to compare with'));
        }

        if (!empty($neighbours['prev'])) {
            $previous_id = $neighbours['prev']['UserAudit']['id'];
        } else {
            $previous_id = $id;
            $this->Session->setFlash(__('No earlier record to compare with'));
        }

        // Create lines to be displayed in the view from the user audit record.
        foreach ($userAuditSelected['UserAudit'] as $key => $value) {
            $lines[] = array($key, $this->_htmlDiff($userAuditSelected['UserAudit'][$key], $userAuditCurrent['UserAudit'][$key]));
        }

        $this->set('lines', $lines);
        $this->set('next_id', $next_id);
        $this->set('previous_id', $previous_id);
    }

    /**
    * admin_compare_previous method
    *
    * @param string $id
    * @return void
    */
    public function admin_compare_adjacent ($id = null) {

        if (!$this->UserAudit->exists($id)) {
            throw new NotFoundException(__('Invalid user audit id'));
        }

        $userAuditSelected = $this->UserAudit->find('first', array('conditions' => array('UserAudit.id' => $id)));

        //Find neighbours with the same user_id.
        $options = array('field' => 'id', 'value' => $id,
            'conditions' => array('UserAudit.user_id' => $userAuditSelected['UserAudit']['user_id']));

        $neighbours = $this->UserAudit->find('neighbors', $options);

        // Assign comparison (next) record. Use the currently selected record if hit the end stops.
        // Assign next and previous id.
        if (!empty($neighbours['next'])) {
            $userAuditNext = $neighbours['next'];
            $next_id = $neighbours['next']['UserAudit']['id'];
        } else {
            $userAuditNext = $userAuditSelected;
            $next_id = $id;
            $this->Session->setFlash(__('No later record to compare with'));
        }

        if (!empty($neighbours['prev'])) {
            $previous_id = $neighbours['prev']['UserAudit']['id'];
        } else {
            $previous_id = $id;
            $this->Session->setFlash(__('No earlier record to compare with'));
        }

        // Create lines to be displayed in the view from the user audit record.
        foreach ($userAuditSelected['UserAudit'] as $key => $value) {
            $lines[] = array($key, $this->_htmlDiff($userAuditSelected['UserAudit'][$key], $userAuditNext['UserAudit'][$key]));
        }

        $this->set('lines', $lines);
        $this->set('next_id', $next_id);
        $this->set('previous_id', $previous_id);
    }

    public function admin_changes_report () {

        //Find Users in the given range.
        $conditions = array(
            'UserAudit.id >=' => 7177,
            //'UserAudit.id >=' => 30267,
            'UserAudit.id <' => 99999,
        );

        if (!$userList = $this->UserAudit->find('list', array('fields' => 'UserAudit.user_id', 'conditions' => $conditions))) {
            $this->Session->setFlash(__('No data'));
            return;
        }

        //Find the audit records for the given Users.
        $conditions = array('UserAudit.user_id' => $userList);
        $order = array('UserAudit.user_id', 'UserAudit.id');

        if (!$userAudits = $this->UserAudit->find('all', array('conditions' => $conditions, 'order' => $order))) {
            $this->Session->setFlash(__('No data'));
            return;
        }

        //debug($userAudits);die();

        $this->set('userAudits', $userAudits);

    }

    /**
    * admin_add method
    *
    * @return void
    * /
    public function admin_add() {
      if ($this->request->is('post')) {
          $this->User->create();
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user has been saved'));
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
    * /

    public function admin_edit($id = null) {
      $this->User->id = $id;
      if (!$this->User->exists()) {
          throw new NotFoundException(__('Invalid user'));
      }
      if ($this->request->is('post') || $this->request->is('put')) {
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user has been saved'));
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
    * /
    public function admin_delete($id = null) {
      if (!$this->request->is('post')) {
          throw new MethodNotAllowedException();
      }
      $this->User->id = $id;
      if (!$this->User->exists()) {
          throw new NotFoundException(__('Invalid user'));
      }
      if ($this->User->delete()) {
          $this->Session->setFlash(__('User deleted'));
          return $this->redirect(array('action' => 'index'));
      }
      $this->Session->setFlash(__('User was not deleted'));
      return $this->redirect(array('action' => 'index'));
    }
*/
}


