<?php
App::uses('AppController', 'Controller');
/**
 * BusinessSocialMedia Controller
 *
 * @property BusinessSocialMedia $BusinessSocialMedia
 * @property PaginatorComponent $Paginator
 */
class BusinessSocialMediaController extends AppController {

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
		$this->BusinessSocialMedia->recursive = 0;
		$this->set('businessSocialMedia', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BusinessSocialMedia->exists($id)) {
			throw new NotFoundException(__('Invalid business social media'));
		}
		$options = array('conditions' => array('BusinessSocialMedia.' . $this->BusinessSocialMedia->primaryKey => $id));
		$this->set('businessSocialMedia', $this->BusinessSocialMedia->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BusinessSocialMedia->create();
			if ($this->BusinessSocialMedia->save($this->request->data)) {
				$this->Session->setFlash(__('The business social media has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business social media could not be saved. Please, try again.'));
			}
		}
		$businesses = $this->BusinessSocialMedia->Business->find('list');
		$socialMedia = $this->BusinessSocialMedia->SocialMedia->find('list');
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
		if (!$this->BusinessSocialMedia->exists($id)) {
			throw new NotFoundException(__('Invalid business social media'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BusinessSocialMedia->save($this->request->data)) {
				$this->Session->setFlash(__('The business social media has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business social media could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BusinessSocialMedia.' . $this->BusinessSocialMedia->primaryKey => $id));
			$this->request->data = $this->BusinessSocialMedia->find('first', $options);
		}
		$businesses = $this->BusinessSocialMedia->Business->find('list');
		$socialMedia = $this->BusinessSocialMedia->SocialMedia->find('list');
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
		$this->BusinessSocialMedia->id = $id;
		if (!$this->BusinessSocialMedia->exists()) {
			throw new NotFoundException(__('Invalid business social media'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BusinessSocialMedia->delete()) {
			$this->Session->setFlash(__('The business social media has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business social media could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
