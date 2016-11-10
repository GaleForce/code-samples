<?php
App::uses('AppController', 'Controller');
/**
 * Trainings Controller
 *
 * @property Training $Training
 * @property PaginatorComponent $Paginator
 */
class TrainingsController extends AppController {

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
		$this->Training->recursive = 0;
		$this->set('trainings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Training->exists($id)) {
			throw new NotFoundException(__('Invalid training'));
		}
		$options = array('conditions' => array('Training.' . $this->Training->primaryKey => $id));
		$this->set('training', $this->Training->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Training->create();
			if ($this->Training->save($this->request->data)) {
				$this->Session->setFlash(__('The training has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.'));
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
		if (!$this->Training->exists($id)) {
			throw new NotFoundException(__('Invalid training'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Training->save($this->request->data)) {
				$this->Session->setFlash(__('The training has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Training.' . $this->Training->primaryKey => $id));
			$this->request->data = $this->Training->find('first', $options);
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
		$this->Training->id = $id;
		if (!$this->Training->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Training->delete()) {
			$this->Session->setFlash(__('The training has been deleted.'));
		} else {
			$this->Session->setFlash(__('The training could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
