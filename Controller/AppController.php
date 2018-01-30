<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public $components = array(
    'Session',
    'UserUtilities',
    'Auth' => array(
      'authenticate' => array('Form'),
      'authError' => 'Sorry, you can not do that.',
      'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin' => false),
      'loginRedirect' => array('controller' => 'users', 'action' => 'members_area', 'admin' => false),
      'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'admin' => false),
      //'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')//,
      'authorize' => array('Controller')
    )
  );

  public $helpers = array('Menu');

  public $layout='bca';

  public function beforeFilter() {

    //Suppress error message if not logged in.
    if (!$this->Auth->loggedIn()) $this->Auth->authError = false;

    //Available to the public.
    $this->Auth->allow('logout');
    //$this->Auth->allow(); //Allow all to public.

  }

  public function isAuthorized($user) {

    //Users with ADMIN role can do everything
    if ($this->UserUtilities->hasRole('Admin')) return true;

    return false;
  }

  /*
   * Save an Activity record.
   */
  protected function _recordActivity($status = null, $info = null) {

    $this->loadModel('Activity');

    $this->request->data['Activity']['remote_addr'] = $_SERVER['REMOTE_ADDR'];
    $this->request->data['Activity']['controller'] = $this->request->params['controller'];
    $this->request->data['Activity']['action'] = $this->request->params['action'];
    $this->request->data['Activity']['status'] = $status;
    $this->request->data['Activity']['info'] = $info;
    $this->request->data['Activity']['http_user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $this->request->data['Activity']['http_referer'] = $_SERVER['HTTP_REFERER'];

    $this->Activity->save($this->request->data);

    unset($this->request->data['Activity']);

  }

  /*
   * Count the number of Activity records in the last day.
   */
  protected function _countActivity($controller, $action, $status = '%') {

    $this->loadModel('Activity');

    $count = $this->Activity->find('count', array(
      'conditions' => array(
        'Activity.remote_addr' => $_SERVER['REMOTE_ADDR'],
        'Activity.controller' => $controller,
        'Activity.action' => $action,
        'Activity.status like' => $status,
        'Activity.created >' => date('Y-m-d H:i:s', strtotime('-1 day'))
    )));

    unset($this->request->data['Activity']);

    return $count;
  }


protected function _isCurrentMember($user) {

  //Current subscription codes.
  $current_codes = '|E|F|H|HOS|IND|JNT|L|LMS|LOS|LSOS|O|OIN|OJN|ORI|ORJ|PER|PMOB|PMOT|PMUB|PMUT|REI|REJ|SS|U|';

  if (isset($user['subscription_code']) &&
    $user['lapsed'] == 0 && $user['resigned'] == 0 && $user['deceased'] == 0 &&
    strpos($current_codes, '|'. trim($user['subscription_code']) .'|') != false) {

    return true;
  }
  return false;
}

/*
    Paul's Simple Diff Algorithm v 0.1
    (C) Paul Butler 2007 <http://www.paulbutler.org/>
    May be used and distributed under the zlib/libpng license.

    This code is intended for learning purposes; it was written with short
    code taking priority over performance. It could be used in a practical
    application, but there are a few ways it could be optimized.

    Given two arrays, the function diff will return an array of the changes.
    I won't describe the format of the array, but it will be obvious
    if you use print_r() on the result of a diff on some test data.

    htmlDiff is a wrapper for the diff command, it takes two strings and
    returns the differences in HTML. The tags used are <ins> and <del>,
    which can easily be styled with CSS.
*/

protected function _diff($old, $new){

    $matrix = array();
    $maxlen = 0;

    foreach($old as $oindex => $ovalue){
        $nkeys = array_keys($new, $ovalue, true);
        foreach($nkeys as $nindex){
            $matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
                $matrix[$oindex - 1][$nindex - 1] + 1 : 1;
            if($matrix[$oindex][$nindex] > $maxlen){
                $maxlen = $matrix[$oindex][$nindex];
                $omax = $oindex + 1 - $maxlen;
                $nmax = $nindex + 1 - $maxlen;
            }
        }
    }

    if($maxlen == 0) return array(array('d'=>$old, 'i'=>$new));

    return array_merge(
        $this->_diff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
        array_slice($new, $nmax, $maxlen),
        $this->_diff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen))
    );
}

protected function _htmlDiff($old, $new){

    $ret = '';
    $diff = $this->_diff(preg_split("/[\s]+/", $old), preg_split("/[\s]+/", $new));

    foreach($diff as $k){
        if(is_array($k))
        $ret .= (!empty($k['d'])?"<del>".implode(' ',$k['d'])."</del> ":'').
            (!empty($k['i'])?"<ins>".implode(' ',$k['i'])."</ins> ":'');
        else $ret .= $k . ' ';
    }
    return $ret;
}

}
