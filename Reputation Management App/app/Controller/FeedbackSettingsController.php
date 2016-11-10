<?php
App::uses('AppController', 'Controller');
/**
 * FeedbackSettings Controller
 *
 * @property FeedbackSetting $FeedbackSetting
 * @property PaginatorComponent $Paginator
 */
class FeedbackSettingsController extends AppController {

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
		$this->FeedbackSetting->recursive = 0;
		$this->set('feedbackSettings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackSetting->exists($id)) {
			throw new NotFoundException(__('Invalid feedback setting'));
		}
		$options = array('conditions' => array('FeedbackSetting.' . $this->FeedbackSetting->primaryKey => $id));
		$this->set('feedbackSetting', $this->FeedbackSetting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(empty($this->request->data['FeedbackSetting']['displayvideo'])){
					$this->request->data['FeedbackSetting']['displayvideo'] = 0;
			}
			$this->FeedbackSetting->create();
			if ($this->FeedbackSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback setting has been saved.'));
				return $this->redirect(array('controller'=>'dashboard','action' => 'businesSetup'));
			} else {
				$this->Session->setFlash(__('The feedback setting could not be saved. Please, try again.'));
			}
		}
return $this->redirect(array('controller'=>'dashboard','action' => 'businesSetup'));
		$businesses = $this->FeedbackSetting->Business->find('list');
		$this->set(compact('businesses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FeedbackSetting->exists($id)) {
			throw new NotFoundException(__('Invalid feedback setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback setting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackSetting.' . $this->FeedbackSetting->primaryKey => $id));
			$this->request->data = $this->FeedbackSetting->find('first', $options);
		}
		$businesses = $this->FeedbackSetting->Business->find('list');
		$this->set(compact('businesses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FeedbackSetting->id = $id;
		if (!$this->FeedbackSetting->exists()) {
			throw new NotFoundException(__('Invalid feedback setting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FeedbackSetting->delete()) {
			$this->Session->setFlash(__('The feedback setting has been deleted.'));
		} else {
			$this->Session->setFlash(__('The feedback setting could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
 
  #Update the value if exists
  public function update($id = null)
  {
  		
  if ($this->request->is('post')) {
  			if(empty($this->request->data['FeedbackSetting']['displayvideo'])){
					$this->request->data['FeedbackSetting']['displayvideo'] = 0;
			}
			if ($this->FeedbackSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback setting has been saved.'));
				return $this->redirect(array('controller'=>'dashboard','action' => 'businesSetup'));
			} else {
				$this->Session->setFlash(__('The feedback setting could not be saved. Please, try again.'));
			}
		}
  return $this->redirect(array('controller'=>'dashboard','action' => 'businesSetup'));
  }



}
