<?php
App::uses('AppController', 'Controller');
/**
 * EmailTemplates Controller
 *
 * @property EmailTemplate $EmailTemplate
 * @property PaginatorComponent $Paginator
 */
class EmailTemplatesController extends AppController {

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
		$this->EmailTemplate->recursive = 0;
		$this->set('emailTemplates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
		$this->set('emailTemplate', $this->EmailTemplate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		

		$uid = $this->routing();
		if($uid)
		{	

			/*$this->loadModel('DefaultTemplate');
			$defaultemplate=$this->DefaultTemplate->find('first',array('conditions'=>array('DefaultTemplate.identifier'=>'agencyTemplate')));
			$this->set('defaultemplate',$defaultemplate);*/
			$con = $this->getemailTemplates();
			$dest = '../webroot/emailTemplate/emailvariables/variables.txt';
			$variables=explode(',', file_get_contents($dest ,true));
		    	$this->set(compact('con','variables'));
			if(@base64_decode($_GET['bussiness']) != '')
			{
             $this->set('bussiness_id',base64_decode($_GET['bussiness']));
            }else{
            	$this->loadModel('Business');
            	$business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>0));
                $this->set('bussiness_id',$business_id['Business']['id']);
		
            }

			if ($this->request->is('post')) {
            			$this->request->data['EmailTemplate']['default'] =1;
				$this->EmailTemplate->create();
				if ($this->EmailTemplate->save($this->request->data)) {
					$this->Session->setFlash(__('The email template has been saved.'));

                   if(isset($this->request->query['bussiness'])){
                 $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		         $this->redirect(array('controller'=>'dashboard','action'=>'notification/'.$qury));                    
			
				} else {

					$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
				}
			}
			$businesses = $this->EmailTemplate->Business->find('list');
			$this->set(compact('businesses'));
		}else{
			$this->Session->setFlash('You are not authorized to access that location.');
                 if(isset($this->request->query['bussiness'])){
                 $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		         $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
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

		$uid = $this->routing();
		if($uid)
		{
			$this->loadModel('DefaultTemplate');
			$edit_temp = $this->EmailTemplate->find('first', array('conditions'=>array('EmailTemplate.id'=>$id),'recursive'=>-1));
			$defaultemplate=$this->DefaultTemplate->find('first',array('conditions'=>array('DefaultTemplate.identifier'=>'agencyTemplate')));
			$this->set(compact('edit_temp','defaultemplate'));
			$con = $this->getemailTemplates();
			$dest = '../webroot/emailTemplate/emailvariables/variables.txt';
            		$variables=explode(',', file_get_contents($dest ,true));
			$this->set(compact('con','variables'));
			if(!empty($this->data)){
				if ($this->EmailTemplate->save($this->data)) {
					$this->Session->setFlash(__('The email template has been saved.'));
					  if(isset($this->request->query['bussiness'])){
                	 $qury='?bussiness='.$this->request->query['bussiness'];
                 	   }else{
                        $qury='';
              		   } 
		         $this->redirect(array('controller'=>'dashboard','action'=>'notification/'.$qury));   

				}else{
					$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
				}
			}
		}else{
			$this->Session->setFlash('You are not authorized to access that location.');
                if(isset($this->request->query['bussiness'])){
                $qury='?bussiness='.$this->request->query['bussiness'];
                }else{
                   $qury='';
                } 
		        $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
		}
		/*if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The email template has been saved.'));
				return $this->redirect(array('controller'=>'dashboard','action' => 'notification'));
			} else {
				$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
			$this->request->data = $this->EmailTemplate->find('first', $options);
		}
		$businesses = $this->EmailTemplate->Business->find('list');
		$this->set(compact('businesses')); */
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EmailTemplate->delete()) {
			$this->Session->setFlash(__('The email template has been deleted.'));
		} else {
			$this->Session->setFlash(__('The email template could not be deleted. Please, try again.'));
		}
		$this->redirect($this->referer());
	}
public function update($id = null)
{
	 if ($this->request->is('post')) {
    	$this->request->data['EmailTemplate']['default'] = 0;
			if ($this->EmailTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The EmailTemplate setting has been saved.'));
				return $this->redirect(array('controller'=>'dashboard','action' => 'businesSetup'));
			} else {
				$this->Session->setFlash(__('The EmailTemplate setting could not be saved. Please, try again.'));
			}
		}
     return $this->redirect(array('controller'=>'dashboard','action' => 'businesSetup'));
}


}
