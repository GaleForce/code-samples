<?php
App::uses('AppController', 'Controller');
/**
 * BusinessReviews Controller
 *
 * @property BusinessReview $BusinessReview
 * @property PaginatorComponent $Paginator
 */
class BusinessReviewsController extends AppController {

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
		$this->BusinessReview->recursive = 0;
		$this->set('businessReviews', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BusinessReview->exists($id)) {
			throw new NotFoundException(__('Invalid business review'));
		}
		$options = array('conditions' => array('BusinessReview.' . $this->BusinessReview->primaryKey => $id));
		$this->set('businessReview', $this->BusinessReview->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BusinessReview->create();
			if ($this->BusinessReview->save($this->request->data)) {
				$this->Session->setFlash(__('The business review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business review could not be saved. Please, try again.'));
			}
		}
		$businesses = $this->BusinessReview->Business->find('list');
		$users = $this->BusinessReview->User->find('list');
		$customers = $this->BusinessReview->Customer->find('list');
		$this->set(compact('businesses', 'users', 'customers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BusinessReview->exists($id)) {
			throw new NotFoundException(__('Invalid business review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BusinessReview->save($this->request->data)) {
				$this->Session->setFlash(__('The business review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business review could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BusinessReview.' . $this->BusinessReview->primaryKey => $id));
			$this->request->data = $this->BusinessReview->find('first', $options);
		}
		$businesses = $this->BusinessReview->Business->find('list');
		$users = $this->BusinessReview->User->find('list');
		$customers = $this->BusinessReview->Customer->find('list');
		$this->set(compact('businesses', 'users', 'customers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BusinessReview->id = $id;
		if (!$this->BusinessReview->exists()) {
			throw new NotFoundException(__('Invalid business review'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BusinessReview->delete()) {
			$this->Session->setFlash(__('The business review has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business review could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
