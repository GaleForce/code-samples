<?php
App::uses('AppController', 'Controller');
/**
 * BusinessEmployees Controller
 *
 * @property BusinessEmployee $BusinessEmployee
 * @property PaginatorComponent $Paginator
 */
class BusinessEmployeesController extends AppController {

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
		$this->BusinessEmployee->recursive = 0;
		$this->set('businessEmployees', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BusinessEmployee->exists($id)) {
			throw new NotFoundException(__('Invalid business employee'));
		}
		$options = array('conditions' => array('BusinessEmployee.' . $this->BusinessEmployee->primaryKey => $id));
		$this->set('businessEmployee', $this->BusinessEmployee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BusinessEmployee->create();
			if ($this->BusinessEmployee->save($this->request->data)) {
				$this->Session->setFlash(__('The business employee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business employee could not be saved. Please, try again.'));
			}
		}
		$users = $this->BusinessEmployee->User->find('list');
		$businesses = $this->BusinessEmployee->Business->find('list');
		$this->set(compact('users', 'businesses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BusinessEmployee->exists($id)) {
			throw new NotFoundException(__('Invalid business employee'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BusinessEmployee->save($this->request->data)) {
				$this->Session->setFlash(__('The business employee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business employee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BusinessEmployee.' . $this->BusinessEmployee->primaryKey => $id));
			$this->request->data = $this->BusinessEmployee->find('first', $options);
		}
		$users = $this->BusinessEmployee->User->find('list');
		$businesses = $this->BusinessEmployee->Business->find('list');
		$this->set(compact('users', 'businesses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BusinessEmployee->id = $id;
		if (!$this->BusinessEmployee->exists()) {
			throw new NotFoundException(__('Invalid business employee'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BusinessEmployee->delete()) {
			$this->Session->setFlash(__('The business employee has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business employee could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
