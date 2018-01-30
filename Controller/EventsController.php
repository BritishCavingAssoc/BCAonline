<?php
App::uses('AppController', 'Controller');
/**
 * Events (Diary) Controller
 *
 * @property Event $Event
 */
class EventsController extends AppController {

  public function beforeFilter() {

    parent::beforeFilter();

    //Publically visible//
    //$this->Auth->allow(); //Allow all to public//
    $this->Auth->allow('index');
  }

  public function isAuthorized($user) {

    //Logged in users can do the following.
    if (in_array($this->action, array('index'))) {
      return true;
    }

    //Diary Administrator role can do the following.
    if ($this->UserUtilities->hasRole('DiaryAdmin')) {
        if (in_array($this->action, array('admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_copy'))) {
            return true;
        }
    }

    return parent::isAuthorized($user);
  }

  /**
   * index method
   *
   * @return void
   */
  public function index() {
    //return $this->redirect('action' => 'display');

    // Get current events.
    $this->set('events', $this->Event->find('all', array(
      'conditions' => array('Event.date >=' => date('Y-m-d', strtotime('today'))),
      'order' => array('Event.date'=>'asc', 'Event.time'=>'asc')
    )));

    // Get past years events.
    $this->set('past_events', $this->Event->find('all', array(
      'conditions' => array(
        'Event.date <=' => date('Y-m-d', strtotime('today')),
        'Event.date >=' => date('Y-m-d', strtotime('-1 year'))
      ),
      'order' => array('Event.date'=>'desc', 'Event.time'=>'asc')
    )));
  }

  /**
  * admin_index method
  *
  * @return void
  */
  public function admin_index() {
    // Get events
    $this->set('events', $this->Event->find('all', array('order' => array('Event.date'=>'desc', 'Event.time'=>'desc'))));
  }

  /**
  * admin_view method
  *
  * @param string $id
  * @return void
  *
  public function admin_view($id = null) {
    $this->Event->id = $id;
    if (!$this->Event->exists()) {
      throw new NotFoundException(__('Invalid event'));
    }
    $this->set('event', $this->Event->read(null, $id));
  }
  */

  /**
  * admin_add method
  *
  * @return void
  */
  public function admin_add() {
    if ($this->request->is('post')) {
      
      $this->request->data['Event']['user_id'] = $this->Auth->user('id'); //Update user id for audit purposes.

      $this->Event->create();
      if ($this->Event->save($this->request->data)) {
        $this->Session->setFlash(__('The event has been saved'), 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
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
    $this->Event->id = $id;
    if (!$this->Event->exists()) {
      throw new NotFoundException(__('Invalid event'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {

      $this->request->data['Event']['user_id'] = $this->Auth->user('id'); //Update user id for audit purposes.
      
      if ($this->Event->save($this->request->data)) {
        $this->Session->setFlash(__('The event has been saved'), 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
      }
    } else {
      $this->request->data = $this->Event->read(null, $id);
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
    $this->Event->id = $id;
    if (!$this->Event->exists()) {
      throw new NotFoundException(__('Invalid event'));
    }
    if ($this->Event->delete()) {
      $this->Session->setFlash(__('Event deleted'), 'default', array('class' => 'success'));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('Event was not deleted'));
    $this->redirect(array('action' => 'index'));
  }

  /**
  * admin_copy method
  *
  * @param string $id
  * @return void
  */
  public function admin_copy($id = null) {
    if (!$this->request->is('post')) {
      throw new MethodNotAllowedException();
    }
    $this->Event->id = $id;
    if (!$this->Event->exists()) {
      throw new NotFoundException(__('Invalid event'));
    }
    $data = $this->Event->read(null, $id);

    unset($data['Event']['id']); // Force an Add rather than Update.
    
    unset($data['Event']['created']); // Don't copy dates.
    unset($data['Event']['modified']);

    $data['Event']['user_id'] = $this->Auth->user('id'); //Save user id for audit purposes.

    $this->Event->create();
    if ($this->Event->save($data)) {
      $this->Session->setFlash(__('The event has been copied'), 'default', array('class' => 'success'));
      $this->redirect(array('action' => 'index'));
    } else {
      $this->Session->setFlash(__('The event could not be copied. Please, try again.'));
    }
  }

}
