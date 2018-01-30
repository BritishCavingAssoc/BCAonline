<?php
App::uses('AppModel', 'Model');

class Token extends AppModel
{
    public $name = 'Token';
    public $displayField = 'id';

    /**
    * store method
    *
    * Creates and saves a token record.
    *
    * @param string $users_id Id from Users record.
    * @param string $action Action to be performed.
    * @return string The created Token Code.
    */
    public function store($users_id, $action) {

        //Expire old tokens first.
        $this->expire();

        $this->create();

        $data[$this->alias]['token_code'] = $this->data[$this->alias]['token_code'] = sha1(uniqid()); //Create unique token.
        $data[$this->alias]['user_id'] = $users_id;
        $data[$this->alias]['action'] = $action;
        $data[$this->alias]['expires'] = date("Y-m-d H:i:s", strtotime('+1 hour')); //Expire 1 hour from now.

        if(!$this->save($data, false, array('token_code', 'user_id', 'action', 'expires'))) {
            throw new RunTimeException(__('Failed to store the token.'));
        }

        return  $data[$this->alias]['token_code'];
    }

    /**
    * retrieve method
    *
    * Retrieves a token given the token code.
    *
    * Expired tokens are removed first before attempting to retrieve the token.
    *
    * @param string $token_code Token code.
    * @param string $action Action to be performed.
    * @return void
    */
    public function retrieve($token_code, $action) {

        //Expire old tokens first.
        $this->expire();

        $token = $this->find('first', array('conditions' => array('Token.token_code' => $token_code)));

        return ($token);
    }

    /**
    * expire method
    *
    * Expires old tokens.
    *
    * @param
    *
    * @return void
    */
    public function expire() {

        $this->deleteAll(array('expires <' => date("Y-m-d H:i:s")), false); //Expired before now.
    }
    
}
