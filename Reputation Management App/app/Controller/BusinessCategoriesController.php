<?php
App::uses('AppController', 'Controller');
/**
 * BusinessCategories Controller
 *
 * @property BusinessCategory $BusinessCategory
 * @property PaginatorComponent $Paginator
 */
class BusinessCategoriesController extends AppController {

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
		$this->BusinessCategory->recursive = 0;
		$this->set('businessCategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BusinessCategory->exists($id)) {
			throw new NotFoundException(__('Invalid business category'));
		}
		$options = array('conditions' => array('BusinessCategory.' . $this->BusinessCategory->primaryKey => $id));
		$this->set('businessCategory', $this->BusinessCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BusinessCategory->create();
			if ($this->BusinessCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The business category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business category could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BusinessCategory->exists($id)) {
			throw new NotFoundException(__('Invalid business category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BusinessCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The business category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BusinessCategory.' . $this->BusinessCategory->primaryKey => $id));
			$this->request->data = $this->BusinessCategory->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BusinessCategory->id = $id;
		if (!$this->BusinessCategory->exists()) {
			throw new NotFoundException(__('Invalid business category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BusinessCategory->delete()) {
			$this->Session->setFlash(__('The business category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
