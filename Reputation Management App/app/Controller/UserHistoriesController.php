<?php
App::uses('AppController', 'Controller');
/**
 * UserHistories Controller
 *
 * @property UserHistory $UserHistory
 * @property PaginatorComponent $Paginator
 */
class UserHistoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserHistory->recursive = 0;
		$this->set('userHistories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserHistory->exists($id)) {
			throw new NotFoundException(__('Invalid user history'));
		}
		$options = array('conditions' => array('UserHistory.' . $this->UserHistory->primaryKey => $id));
		$this->set('userHistory', $this->UserHistory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserHistory->create();
			if ($this->UserHistory->save($this->request->data)) {
				$this->Session->setFlash(__('The user history has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user history could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserHistory->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserHistory->exists($id)) {
			throw new NotFoundException(__('Invalid user history'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserHistory->save($this->request->data)) {
				$this->Session->setFlash(__('The user history has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user history could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserHistory.' . $this->UserHistory->primaryKey => $id));
			$this->request->data = $this->UserHistory->find('first', $options);
		}
		$users = $this->UserHistory->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserHistory->id = $id;
		if (!$this->UserHistory->exists()) {
			throw new NotFoundException(__('Invalid user history'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserHistory->delete()) {
			$this->Session->setFlash(__('The user history has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user history could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
