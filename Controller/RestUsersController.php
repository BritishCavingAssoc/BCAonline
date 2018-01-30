<?php
//App::uses('AppController', 'Controller');

class RestUsersController extends AppController {

    public $uses = array('User');

    public $helpers = array('Html', 'Form');

    public $components = array(
        'RequestHandler',
        'Auth' => array('authenticate' => array('Basic')),
    );

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow(); // Allow all to public.
        $this->Auth->allow('club_list');
    }

    public function isAuthorized($user) {

        //Users with ADMIN role can do everything
        if ($this->UserUtilities->hasRole('Admin')) return true;

        //Logged in Users with role UserEnquiry can do the following.
        if ($this->UserUtilities->hasRole(array('UserEnquiry')) &&
            //in_array($this->action, array('view', 'edit','club_list'))
            in_array($this->action, array('view', 'edit'))
        ) return true;

        if(in_array($this->params['controller'],array('rest_users'))) {
            // For RESTful web service requests, we check the name of our contoller
            $this->Auth->allow();
            // this line should always be there to ensure that all rest calls are secure
            // $this->Security->requireSecure();
            //$this->Security->unlockedActions = array('edit','delete','add','view');
        }else{
            // setup out Auth
            $this->Auth->allow(); //Allow all!!!!
        }

        return parent::isAuthorized($user);
    }

/*
    public function index() {

        $fields = array('User.id', 'User.bca_no', 'User.full_name', 'User.admin_email_ok',
            'User.bca_email_ok', 'User.bcra_email_ok');

        $order = array('User.bca_no');

        $users = $this->User->find('all', array('fields' => $fields, 'order' =>$order, 'limit' => 10, 'contain' => false));

        $this->set(array( 'users' => $users, '_serialize' => array('users') ));
    }
*/
/*
    public function add() {
        $this->User->create();
        if ($this->User->save($this->request->data)) {
             $message = 'Created';
        } else {
            $message = 'Add Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
*/

    public function view($bca_no) {

        //Allow CORS for all domains.
        $this->response->header(array('Access-Control-Allow-Origin: *'));

        $conditions = array('User.bca_no' => $bca_no);

        $fields = array('User.id', 'User.bca_no', 'User.full_name', 'User.admin_email_ok',
            'User.bca_email_ok', 'User.bcra_email_ok');

        $user = $this->User->find('first', array('conditions' => $conditions, 'fields' => $fields, 'contain' => false));

        $this->set(array('user' => $user['User'], '_serialize' => array('user')));
    }



    public function edit($bca_no) {

        //Allow CORS for all domains.
        $this->response->header(array('Access-Control-Allow-Origin: *'));

        //Cast to int. Any funny strings will become 0.
        $bca_no = (int) $bca_no;
        if(empty($bca_no) or $bca_no == 0) {
            throw new BadRequestException(__('Bad BCA membership number'));
        }

        if ($this->request->params['ext'] == 'json') $data = $this->request->input('json_decode', true); //true needed to return array().

        if ($this->request->params['ext'] == 'xml') $data = Xml::toArray($this->request->input('Xml::build'));

        if(empty($data)) {
            throw new BadRequestException(__('Invalid data'));
        }

        //Setup field values
        $fields =array();

        if (isset($data['user']['admin_email_ok'])) $fields['User.admin_email_ok'] = $data['user']['admin_email_ok'];

        if (isset($data['user']['bca_email_ok'])) $fields['User.bca_email_ok'] = $data['user']['bca_email_ok'];

        if (isset($data['user']['bcra_email_ok'])) $fields['User.bcra_email_ok'] = $data['user']['bcra_email_ok'];

        $conditions = array('User.bca_no' => $bca_no);

        //debug($fields);die();

        if ($this->User->updateAll($fields, $conditions)) {
            $message = 'Saved';
        } else {
            $message = 'Update Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

/*
    public function delete($id) {
        if ($this->User->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Delete Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
*/

    public function club_list() {

        $conditions = array('User.class_code' => 'GRP');

        //$fields = array('User.id', 'User.bca_no', 'User.organisation', 'User.website');
        $fields = array('User.organisation', 'User.website');

        $user = $this->User->find('all', array('conditions' => $conditions, 'fields' => $fields, 'contain' => false));

        $this->set(array('user' => $user, '_serialize' => array('user')));
    }
}