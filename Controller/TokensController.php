<?php
App::uses('AppController', 'Controller');
/**
 * Tokens Controller
 *
 * @property Token $Token
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TokensController extends AppController {

    public $components = array('Paginator', 'Session');

    public $paginate = array(
        'limit' => 30,
        'order' => array('Token.desc' => 'asc')
    );

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow(); // Allow all to public.
    }

    public function isAuthorized($user) {

        //User Admin role can also do the following.
        if ($this->UserUtilities->hasRole(array('UserAdmin'))) {
            if (in_array($this->action, array('admin_index', 'admin_view', 'admin_edit', 'admin_delete'))) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

/**
 * admin_index method
 *
 * @return void
 */
    public function admin_index() {
        $this->Token->recursive = 0;
        $this->set('tokens', $this->Paginator->paginate());
    }

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_view($id = null) {
        if (!$this->Token->exists($id)) {
            throw new NotFoundException(__('Invalid token'));
        }
        $options = array('conditions' => array('Token.' . $this->Token->primaryKey => $id));
        $this->set('token', $this->Token->find('first', $options));
    }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null) {
        if (!$this->Token->exists($id)) {
            throw new NotFoundException(__('Invalid token'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Token->save($this->request->data)) {
                $this->Session->setFlash(__('The token has been saved.'), 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The token could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Token.' . $this->Token->primaryKey => $id));
            $this->request->data = $this->Token->find('first', $options);
        }
    }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null) {
        $this->Token->id = $id;
        if (!$this->Token->exists()) {
            throw new NotFoundException(__('Invalid token'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Token->delete()) {
            $this->Session->setFlash(__('The token has been deleted.'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('The token could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
