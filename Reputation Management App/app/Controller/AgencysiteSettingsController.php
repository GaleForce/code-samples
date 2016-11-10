<?php
App::uses('AppController', 'Controller');
/**
 * AgencysiteSettings Controller
 *
 * @property AgencysiteSetting $AgencysiteSetting
 * @property PaginatorComponent $Paginator
 */
class AgencysiteSettingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Resize');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->request->is('post')){
			$this->request->data['AgencysiteSetting']['user_id']=$this->Session->read('Auth.User.id');
			$this->request->data['AgencysiteSetting']['created_at']=date('Y-m-d');
			if($this->request->data['AgencysiteSetting']['faviconimageurl']['name']){
							$dest = '../../app/webroot/img/agencylogo';
							$file = $this->request->data['AgencysiteSetting']['faviconimageurl'];
							$dimension=getimagesize($file['tmp_name']);
							$allowed =  array('ico');
							$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
						    $width=$dimension[0];
						    $height=$dimension[1];
						    if(in_array($ext, $allowed)){
							    if($width>=10 && $height>=10){
							    	$favicon_image = $this->upload_image($dest,$file,'');
									$this->request->data['AgencysiteSetting']['faviconimageurl']=$favicon_image;
									// if(is_uploaded_file($file['tmp_name']))
									// 	{
									// 	    $n_width=30;
									// 	    $n_height=30;
									// 	    $dest1 = '../../app/webroot/img/agencylogo/medium';
									// 		$result = $this->Resize->resize($file['tmp_name'], realpath($dest1).'/'.$favicon_image,"as_define",$n_width,$n_height,0,0,0,0);
									// 	}
							    }else{
							    	$this->Session->setFlash('Invalid Image Size. Image must be atleast 10X10.','error');
									$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
							    }
							}else{
								$this->Session->setFlash('Invalid Image format. Allowed Format(ico).','error');
								$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
							}    
										
						}else{
							if(isset($this->request->data['Agency']['favicon']) && $this->request->data['Agency']['favicon']){
								$this->request->data['AgencysiteSetting']['faviconimageurl']=$this->request->data['Agency']['favicon'];		
							}else{
								$this->request->data['AgencysiteSetting']['faviconimageurl']="defaultfavicon.jpg";		
							}
						}

			if($this->request->data['AgencysiteSetting']['sitebackgroundimageurl']['name']){
							$dest = '../../app/webroot/img/agencylogo';
							$file = $this->request->data['AgencysiteSetting']['sitebackgroundimageurl'];
							$dimension=getimagesize($file['tmp_name']);
							$allowed =  array('gif','png' ,'jpg','jpeg');
							$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
						    $width=$dimension[0];
						    $height=$dimension[1];
						    if(in_array($ext, $allowed)){
							    if($width>=270 && $height>=263){
							    	$background_image = $this->upload_image($dest,$file,'');
									$this->request->data['AgencysiteSetting']['sitebackgroundimageurl']=$background_image;
									if(is_uploaded_file($file['tmp_name']))
										{
										    $n_width=270;
										    $n_height=263;
										    $dest1 = '../../app/webroot/img/agencylogo/medium';
											$result = $this->Resize->resize($file['tmp_name'], realpath($dest1).'/'.$background_image,"as_define",$n_width,$n_height,0,0,0,0);
										}
							    }else{
							    	$this->Session->setFlash('Invalid Image Size. Image must be atleast 270X263.','error');
									$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
							    }
							}else{
								$this->Session->setFlash('Invalid Image format. Allowed Format(gif,png ,jpg,jpeg).','error');
								$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
							}    
										
						}else{
							if(isset($this->request->data['Agency']['background']) && $this->request->data['Agency']['background']){
								$this->request->data['AgencysiteSetting']['sitebackgroundimageurl']=$this->request->data['Agency']['background'];		
							}else{
								$this->request->data['AgencysiteSetting']['sitebackgroundimageurl']="default.jpg";		
							}
						}
						
       /*     if($this->request->data['AgencysiteSetting']['agencylogo']['name']){
							$dest = '../../app/webroot/img/agencylogo';
							$file = $this->request->data['AgencysiteSetting']['agencylogo'];
							$dimension=getimagesize($file['tmp_name']);
							$allowed =  array('gif','png' ,'jpg','jpeg');
							$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
						    $width=$dimension[0];
						    $height=$dimension[1];
						    if(in_array($ext, $allowed)){
							    if($width>=270 && $height>=263){
							    	$logo_image = $this->upload_image($dest,$file,'');
									$this->request->data['AgencysiteSetting']['agencylogo']=$logo_image;
									if(is_uploaded_file($file['tmp_name']))
										{
										    $n_width=270;
										    $n_height=263;
										    $dest1 = '../../app/webroot/img/agencylogo/medium';
											$result = $this->Resize->resize($file['tmp_name'], realpath($dest1).'/'.$logo_image,"as_define",$n_width,$n_height,0,0,0,0);
										}
							    }else{
							    	$this->Session->setFlash('Invalid Image Size. Image must be atleast 270X263.');
									$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
							    }
							}else{
								$this->Session->setFlash('Invalid Image format. Allowed Format(gif,png ,jpg,jpeg).');
								$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
							}    
										
						}else{
							if(isset($this->request->data['Agency']['logoname']) && $this->request->data['Agency']['logoname']){
								$this->request->data['AgencysiteSetting']['agencylogo']=$this->request->data['Agency']['logoname'];		
							}else{
								$this->request->data['AgencysiteSetting']['agencylogo']="defaultbackground.jpg";		
							}
						}*/



			$this->loadModel('AgencysiteSetting');

			 if($this->AgencysiteSetting->save($this->request->data)){
			 	$this->Session->setFlash('My site setting has been updated successfully.','success');	
			 	$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
			 }else{
			 	$this->Session->setFlash('Mysite setting could not be saved. Please, try again.','error');
			 }
            
		}
		$setting=$this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>$this->Session->read('Auth.User.id'))));
		$this->set('setting',$setting);
		//pr();die;
		
		$this->loadModel('Country');
		$countries=$this->Country->find('list',array('fields'=>array('Country.id','Country.country_name')));
		$this->set('countries',$countries);
		$this->loadModel('State');
		$states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
		$this->set('states',$states);
		$this->loadModel('City');
		//pr($cities);die;
		if(!empty($setting)){
			$cities= $this->City->find('list',array('fields'=>array('id','city_name'),'order'=>array('city_name ASC'),'conditions'=>array('City.state_id'=>$setting['AgencysiteSetting']['state_id'])));
		}else{
			$cities="";
		}
		$this->set('cities',$cities);
		
	}
public function restoreDefaultSettings()
	{
      $this->loadModel('AgencysiteSetting');
      $users_agency_id = $this->Session->read('Auth.User');
      if($users_agency_id['usertype'] == 'reseller')
      {	
	      if($this->AgencysiteSetting->updateAll(array('AgencysiteSetting.agencylogo'=>"''",'AgencysiteSetting.sitetitle'=>"''",'AgencysiteSetting.siteheadcolor'=>"''",'AgencysiteSetting.sitebarcolor'=>"''",'AgencysiteSetting.settingsdescription'=>"''",'AgencysiteSetting.sitebackgroundcolor'=>"''",'AgencysiteSetting.faviconimageurl'=>"''"),array('AgencysiteSetting.user_id'=>$users_agency_id['id'])))
	      {
	      	$this->Session->setFlash('The Deafault Site Settings has been changed.','success');
	      	$this->redirect(array('controller'=>'agencysiteSettings','action'=>'index'));
	      }
	      else
	      {
	         $this->Session->setFlash('Error..Settings could not be changed','error');
	         
	      }
     }
     else
     {
        $this->Session->setFlash('Sorry We find some error..','error');
     } 
 }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AgencysiteSetting->exists($id)) {
			throw new NotFoundException(__('Invalid agencysite setting'));
		}
		$options = array('conditions' => array('AgencysiteSetting.' . $this->AgencysiteSetting->primaryKey => $id));
		$this->set('agencysiteSetting', $this->AgencysiteSetting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AgencysiteSetting->create();
			if ($this->AgencysiteSetting->save($this->request->data)) {
				$this->Session->setFlash('The agencysite setting has been saved.','success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The agencysite setting could not be saved. Please, try again.','error');
			}
		}
		$users = $this->AgencysiteSetting->User->find('list');
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
		if (!$this->AgencysiteSetting->exists($id)) {
			throw new NotFoundException(__('Invalid agencysite setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AgencysiteSetting->save($this->request->data)) {
				$this->Session->setFlash('The agencysite setting has been saved.','success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The agencysite setting could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('AgencysiteSetting.' . $this->AgencysiteSetting->primaryKey => $id));
			$this->request->data = $this->AgencysiteSetting->find('first', $options);
		}
		$users = $this->AgencysiteSetting->User->find('list');
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
		$this->AgencysiteSetting->id = $id;
		if (!$this->AgencysiteSetting->exists()) {
			throw new NotFoundException(__('Invalid agencysite setting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AgencysiteSetting->delete()) {
			$this->Session->setFlash('The agencysite setting has been deleted.','error');
		} else {
			$this->Session->setFlash('The agencysite setting could not be deleted. Please, try again.','error');
		}
		return $this->redirect(array('action' => 'index'));
	}

       public function businessUserSiteSetting()
	{       $this->loadModel('Business');
		if($this->Session->read('Auth.User')) {
                                 $session = $this->Session->read('Auth.User');
                                 //pr($session);die;
                                if($session['usertype'] == 'reseller')
                                 { 
				 $this->routing();
                                }
                            }
       	   
            $this->loadModel('Business');
            $b_id = $this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$this->Session->read('Auth.User.id')),'fields'=>array		 ('Business.id','Business.businessname')));
            
 $this->set('business_name',$b_id['Business']['businessname']);
            
       

	} 






}
