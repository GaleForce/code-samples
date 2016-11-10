<?php
App::uses('AppController', 'Controller');
/**
 * Visibilities Controller
 *
 * @property Visibility $Visibility
 * @property PaginatorComponent $Paginator
 */
class VisibilitiesController extends AppController {

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
		$this->Visibility->recursive = 0;
		$this->set('visibilities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Visibility->exists($id)) {
			throw new NotFoundException(__('Invalid visibility'));
		}
		$options = array('conditions' => array('Visibility.' . $this->Visibility->primaryKey => $id));
		$this->set('visibility', $this->Visibility->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Visibility->create();
			if ($this->Visibility->save($this->request->data)) {
				$this->Session->setFlash(__('The visibility has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The visibility could not be saved. Please, try again.'));
			}
		}
		$businesses = $this->Visibility->Business->find('list');
		$socialMedia = $this->Visibility->SocialMedia->find('list');
		$this->set(compact('businesses', 'socialMedia'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Visibility->exists($id)) {
			throw new NotFoundException(__('Invalid visibility'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Visibility->save($this->request->data)) {
				$this->Session->setFlash(__('The visibility has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The visibility could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Visibility.' . $this->Visibility->primaryKey => $id));
			$this->request->data = $this->Visibility->find('first', $options);
		}
		$businesses = $this->Visibility->Business->find('list');
		$socialMedia = $this->Visibility->SocialMedia->find('list');
		$this->set(compact('businesses', 'socialMedia'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Visibility->id = $id;
		if (!$this->Visibility->exists()) {
			throw new NotFoundException(__('Invalid visibility'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Visibility->delete()) {
			$this->Session->setFlash(__('The visibility has been deleted.'));
		} else {
			$this->Session->setFlash(__('The visibility could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
