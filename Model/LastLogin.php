<?php
App::uses('AppModel', 'Model');

class LastLogin extends AppModel
{
    public $name = 'LastLogin';
    public $primaryKey = 'user_id';
    public $belongsTo = 'User';
}
