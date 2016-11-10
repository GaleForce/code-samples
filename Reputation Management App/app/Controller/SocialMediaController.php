<?php
App::uses('AppController', 'Controller');
/**
 * SocialMedia Controller
 *
 * @property SocialMedia $SocialMedia
 * @property PaginatorComponent $Paginator
 */
class SocialMediaController extends AppController {

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
		$this->SocialMedia->recursive = 0;
		$this->set('socialMedia', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SocialMedia->exists($id)) {
			throw new NotFoundException(__('Invalid social media'));
		}
		$options = array('conditions' => array('SocialMedia.' . $this->SocialMedia->primaryKey => $id));
		$this->set('socialMedia', $this->SocialMedia->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SocialMedia->create();
			if ($this->SocialMedia->save($this->request->data)) {
				$this->Session->setFlash(__('The social media has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The social media could not be saved. Please, try again.'));
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
		if (!$this->SocialMedia->exists($id)) {
			throw new NotFoundException(__('Invalid social media'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SocialMedia->save($this->request->data)) {
				$this->Session->setFlash(__('The social media has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The social media could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SocialMedia.' . $this->SocialMedia->primaryKey => $id));
			$this->request->data = $this->SocialMedia->find('first', $options);
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
		$this->SocialMedia->id = $id;
		if (!$this->SocialMedia->exists()) {
			throw new NotFoundException(__('Invalid social media'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SocialMedia->delete()) {
			$this->Session->setFlash(__('The social media has been deleted.'));
		} else {
			$this->Session->setFlash(__('The social media could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
