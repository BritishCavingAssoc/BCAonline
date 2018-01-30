<?php
App::uses('AppController', 'Controller');

/**
 * Last Login Controller
 *
 * @property Email $Email
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SentEmailsController extends AppController {

    public $components = array('Paginator', 'Session', 'Filter.Filter');

    public $paginate = array(
        'limit' => 30,
        'order' => array('SentEmail.created' => 'desc')
    );

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow(); // Allow all to public.
        //$this->Auth->allow('request_login_details', 'details_found');
    }

    public function isAuthorized($user) {
        
        //Role Enquiry/Manager/Admin can do the following.
        if ($this->UserUtilities->hasRole(array('UserEnquiry', 'UserManager', 'UserAdmin'))) {
            if (in_array($this->action, array('admin_index', 'admin_view'))) {
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
            'SentEmail' => array (
                'SentEmail.bca_no' => array('label' => 'BCA No', 'condition' => '=', 'type' => 'text'),
                'SentEmail.user_id' => array('label' => 'User Id', 'condition' => '=', 'type' => 'text'),
                'SentEmail.to',
                'SentEmail.subject',
            )
        )
    );

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Paginator->settings = $this->paginate;

        $this->SentEmail->recursive = 0;
        $this->set('sentEmails', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->SentEmail->id = $id;
        if (!$this->SentEmail->exists()) {
          throw new NotFoundException(__('Invalid sent email'));
        }
        $this->set('sentEmail', $this->SentEmail->read(null, $id));
    }
}