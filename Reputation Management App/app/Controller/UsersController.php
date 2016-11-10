<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
	function beforeFilter(){
   		parent::beforeFilter();
   		$this->Auth->allow('validatZip','forgot','businessUserForgot','businessUserLogin','businessUserResetPassword','resetPassword','checkUserEmail','validUserEmail','registerBusinessUser','findState','findCity','chk_password','checkEmail_user','validate_first_name','validate_last_name','admin','employee');

	}

	
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function businessUserLogin($siteid=null){
		$this->layout = 'login';
    	if($siteid){ 
				$bid=base64_decode($siteid);
				if(!empty($bid)){
					$this->loadModel('AgencysiteSetting');
					$siteSetting = $this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>$bid)));
				}else{
					$siteSetting="";
				}
		}else{
				$siteSetting="";
		}

		$this->set('design',$siteSetting);
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$user_id=$this->Session->read('Auth.User.id');
				$del_user = $this->Business->find('first',array('fields'=>array('id','is_deleted','user_Id'),'conditions'=>array('Business.user_Id'=>$user_id),'recursive'=>-1));
				if($del_user['Business']['is_deleted']==1){
				$this->logout();
				$this->Session->setFlash('Invalid User..!!');
				$this->redirect($this->referer());
				}
				$usertype=$this->Session->read('Auth.User.usertype');
				switch ($usertype) {
					/*case 'reseller':
					    $this->Session->destroy();
						$this->redirect($this->Auth->redirect('/dashboard'));
						break;*/
					case 'subscriber':
					  /*  if ($this->request->data['remember'] == 1) {
				                $cookieTime = time() + (86400 * 30);
				               	unset($this->request->data['remember']);
				                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
				                $this->Cookie->write('remember', $this->request->data['User'], true, $cookieTime);
			            }*/
			            $this->loadModel('Business');
						$agId=$this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.user_Id'=>$this->Session->read('Auth.User.id')),'fields'=>array('Business.agency_id')));
						if(!empty($agId)){
							$this->loadModel('AgencysiteSetting');
							$sitedata=$this->AgencysiteSetting->find('first',array('contain'=>false,'conditions'=>array('AgencysiteSetting.user_id'=>$agId['Business']['agency_id'])));
						}else{
							$sitedata="";
						}
						$server=array();
						$server[]='http://'.$_SERVER['HTTP_HOST'];
						$server[]='https://'.$_SERVER['HTTP_HOST'];
						$server[]='www.'.$_SERVER['HTTP_HOST'];
						if($_SERVER['HTTP_HOST']!==DNS && $sitedata['AgencysiteSetting']['domainname'] && !in_array($sitedata['AgencysiteSetting']['domainname'], $server)){
							$this->Auth->logout();
							$this->Session->setFlash('Username or Password is incorrect. Please try again.','error');
							$this->redirect(array('controller'=>'Users','action'=>'businessUserLogin'));
							break;
						}else{
							$this->Session->write('sitedata', $sitedata);
				            $data['UserHistory']['user_id']=$this->Session->read('Auth.User.id');
							$this->loadModel('UserHistory');
							$this->UserHistory->save($data);
							$this->redirect($this->Auth->redirect('/dashboard/feedback'));
							break;
						}
					default:
						$this->Session->destroy();
	            		$this->redirect('/');
						break;
				}
			} else {
					$data=$this->User->find('first',array('contain'=>false,'conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.usertype'=>'subscriber'),'fields'=>array('User.status')));
					if(!empty($data) && $data['User']['status']==0){
						$this->Session->setFlash('You are deactivated by your Agency. Please contact your agency.','error');
						$this->redirect($this->referer());
					}else{
						$this->Session->setFlash('Username or Password is incorrect. Please try again.','error');
						$this->redirect($this->referer());
					}
			
			}
		}else{
	    	//$cookie = $this->Cookie->read('remember');
    		//$this->set('cookie',$cookie);
    		if ($this->Session->read('Auth.User')) {
		      
		       return $this->redirect($this->Auth->redirectUrl());
		  }
	    }
    }
function checkEmail_user()
		{ 
			$email = trim($_REQUEST['data']['Business']['companywebaddress']);
			$this->autoRender = false;
			$count = $this->User->find('count',array('conditions'=>array('User.email'=>$email)));
			if($count>0)
			{
				echo "false";die;
			}
			else
			{
				echo "true";die;
			}	
		}
public function findState()
    {	 
    	$this->autoRender=false;
        if ($this->request->is('Ajax'))
        {
        	$country_id = $this->data['id'];

	        $data = $this->Business->State->find('list',array('conditions'=>array('State.country_id'=>$country_id), 'fields'=>array('State.id','stateName'),'order'=>array('stateName ASC')));   
	        $data=array_unique($data);
	        asort($data);
	        //pr($data);die;
	        $this->set('states', $data);
            echo json_encode(array('html' => $data));
        }
    }
    public function findCity()
    {	
    	$this->autoRender=false;
        if ($this->request->is('Ajax'))
        {
        	$state_id = $this->data['id'];
	        $data = $this->Business->City->find('list',array('conditions'=>array('City.state_id'=>$state_id), 'fields'=>array('id','city_name'),'order'=>array('city_name ASC')));  
	        $data=array_unique($data);
	       // sort($data);
	        $this->set('cities', array_unique($data));
            echo json_encode(array('html' => $data));
        }
    }


	public function registerBusinessUser($siteid=null)
	{
		if($siteid){ 

				$bid=base64_decode($siteid);
				
				if(!empty($bid)){
					$this->loadModel('AgencysiteSetting');
					$siteSetting = $this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>$bid)));
         
				}else{
					$siteSetting="";
				}
	    $this->set('design',$siteSetting);
		$this->set('agency_id',@$bid);
		}
		else
		{
				$siteSetting="";
		}
		
		 $this->set('design',$siteSetting);	   
		$this->loadModel('User');
		$this->loadModel('Business');
		if($this->Session->read('Auth.User')) 
                   {
        			//$this->Session->delete('Auth.User');
        			$this->routing();
				  }
		if ($this->request->is('post')) 
		{
			$data = $this->data;
			$email=$this->request->data['Business']['companywebaddress'];
			$info['User']['email'] = $data['Business']['companywebaddress'];
			$info['User']['firstname'] = $data['User']['firstname'];
			$info['User']['password'] = $data['User']['password'];
			$info['User']['createdat'] = date('Y-m-d H:i:s');
			$info['User']['usertype'] = 'subscriber';
			$this->User->create();
			if ($this->User->save($info)) 
			{
				unset($data['Business']['companywebaddress']);
				$data['Business']['user_Id'] = intval($this->User->getLastInsertId());
				if ($this->Business->save($data['Business'])) 

				{

		           /* $content="<p>Your Account has been created with us..</p>";
		            $content .= 'User Name is    '.$info['User']['email'].'Password Is     '.$info['User']['password']; 
		            $subject = 'business user registration'; 
	               	    $this->sendEmail($content,"support@repmgsys.com",$email,$subject);
       			    $this->Session->setFlash(__('The user has been saved.'));
		            return $this->redirect(array('action' => 'businessUserLogin')); */
					$udata= $this->User->find('first',array('fields'=>array('id','email'),'conditions'=>array('User.id'=>@$data['Business']['agency_id']),'recursive'=>-1));
					$agencyname = $this->AgencysiteSetting->find('first',array('fields'=>array('id','AgencysiteSetting.agencyname'),'conditions'=>array('AgencysiteSetting.user_id'=>@$udata['User']['id']),'recursive'=>-1));
					$business_name = @$data['Business']['businessname'];
					$agency_name = @$agencyname['AgencysiteSetting']['agencyname'];
					$agency_email = @$udata['User']['email'];
					
					$this->loadModel('AgencyTemplate');
					$eTemplate = $this->AgencyTemplate->find('first',array('conditions'=>array('AgencyTemplate.agency_id'=>@$data['Business']['agency_id'],'AgencyTemplate.default'=>0)));
					$name = $data['User']['firstname'];
					$signature = $eTemplate['AgencyTemplate']['signature'];
					$replace=array('$name'=>$name,'$agency_name'=>$agency_name,'$agency_email'=>$agency_email,'$business_name'=>$business_name,'$business_email'=>$email,'$signature'=>$signature);
	              			if(!empty($eTemplate)){
						$sendername=@$eTemplate['AgencyTemplate']['sendername'];
						$sendemail=@$eTemplate['AgencyTemplate']['senderemail'];
						$content=$eTemplate['AgencyTemplate']['emailcontent'];	
						$subject=@$eTemplate['AgencyTemplate']['emailsubject'];
						$receiveremail=$email;
					}else{
						$dest = '../webroot/emailTemplate/businessSignup.txt';
						$content=file_get_contents($dest ,true);
						$sendername=$agencyname;
						$sendemail=$agency_email;
						$subject='Registered Email Notification';
						$receiveremail=$email;
					}
	                	$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
       				$this->Session->setFlash(__('The user has been saved.','success'));
				return $this->redirect(array('action' => 'businessUserLogin'));
			       }
				
			}
			else
			{
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}

			}	


         $businessCategories = $this->Business->BusinessCategory->find('list',array('conditions'=>array('BusinessCategory.status'=>1),'order'=>'name ASC'));
        $countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
            $us = $countries[1];
			unset($countries[1]);
			$countries[1] = $us;
     	$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));		
     	$this->set(compact('businessCategories', 'countries','agency_list')); 

	}
      public function chk_password()
	{
			$password = trim($_REQUEST['data']['User']['password']);

    	    $this->autoRender = false;
    	    
            if (preg_match('((?=.*\\d)(?=.*[a-z]).{6,20})', $password)) {
 			   echo "true";die;
			} else {
    		echo "false";die;
			}
	}








	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	/**
 * login method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	 

	public function login() {
	
			$this->layout = 'login';
			if ($this->request->is('post')) { 
				if ($this->Auth->login()) {
					$usertype=$this->Session->read('Auth.User.usertype');
					switch ($usertype) {
						case 'reseller':
							$data['UserHistory']['user_id']=$this->Session->read('Auth.User.id');
							/*Check Agency Domain*/
							$this->loadModel('AgencysiteSetting');
							$site=$this->AgencysiteSetting->find('first',array('contain'=>false,'conditions'=>array('AgencysiteSetting.user_id'=>$this->Session->read('Auth.User.id')),'fields'=>array('AgencysiteSetting.domainname')));
							$server=array();
							$server[]='http://'.$_SERVER['HTTP_HOST'];
							$server[]='https://'.$_SERVER['HTTP_HOST'];
							$server[]='www.'.$_SERVER['HTTP_HOST'];
							if(isset($site['AgencysiteSetting']['domainname']) && $_SERVER['HTTP_HOST']!==DNS && $site['AgencysiteSetting']['domainname'] && !in_array($site['AgencysiteSetting']['domainname'], $server)){
								$this->Auth->logout();
								$this->Session->setFlash('Username or Password is incorrect. Please try again.','error');
								$this->redirect(array('controller'=>'Users','action'=>'login'));
								break;
							}else{
								$this->loadModel('UserHistory');
								$this->UserHistory->save($data);
								$this->redirect($this->Auth->redirect('/dashboard'));
								break;
							}
						/*case 'subscriber':
							$this->Session->destroy();
							$this->redirect($this->Auth->redirect('/users/businessUserLogin'));
							break;
						case 'admin':
							$this->Session->destroy();
							$this->redirect($this->Auth->redirect('/users/admin'));
							break;
                            case 'employee':
							$this->Session->destroy();
							$this->redirect($this->Auth->redirect('/users/employee'));
							break;*/
						default:
							$this->Auth->logout();
		            		$this->redirect('/');
							break;
					}

				    
				} else {
					$data=$this->User->find('first',array('contain'=>false,'conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.usertype'=>'reseller'),'fields'=>array('User.status')));
					if(!empty($data) && $data['User']['status']==0){
						$this->Session->setFlash('You are deactivated by Admin. Please contact your administrator.','error');
						$this->redirect($this->referer());
					}else{
						$this->Session->setFlash('Username or Password is incorrect. Please try again.','error');
						$this->redirect($this->referer());
					}
				 
				}
		    }

		  if ($this->Session->read('Auth.User')) {
		      
		       return $this->redirect($this->Auth->redirectUrl());
		  }
	}
	public function admin() {
		$this->layout = 'login';
			if ($this->request->is('post')) { 
				if ($this->Auth->login()) {
					$usertype=$this->Session->read('Auth.User.usertype');
						if($usertype=='admin'){
							$data['UserHistory']['user_id']=$this->Session->read('Auth.User.id');
							$this->loadModel('UserHistory');
							$this->UserHistory->save($data);
							$this->redirect($this->Auth->redirect('/admin/index'));
						
						}else{
							$this->Session->destroy();
							$this->Session->setFlash('You are not authorized user to access that location.','error');
						}
				}else {
					$this->Session->setFlash('Username or Password is incorrect. Please try again.','error');
					$this->redirect($this->referer());
				 
				}
		    }
		    if ($this->Session->read('Auth.User')) {
		      
		       return $this->redirect($this->Auth->redirectUrl());
		  }
	}

	public function employee() {
		$this->layout = 'login';
			if ($this->request->is('post')) { 
				if ($this->Auth->login()) {
					$usertype=$this->Session->read('Auth.User.usertype');
						if($usertype=='employee'){
							$data['UserHistory']['user_id']=$this->Session->read('Auth.User.id');
							$this->loadModel('UserHistory');
							$this->UserHistory->save($data);
							$this->redirect($this->Auth->redirect('/Employee'));
						}else{
							$this->Session->destroy();
							$this->Session->setFlash('You are not authorized user to access that location.','error');
						}
				}else {
					$data=$this->User->find('first',array('contain'=>false,'conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.usertype'=>'employee'),'fields'=>array('User.status')));
					if(!empty($data) && $data['User']['status']==0){
						$this->Session->setFlash('You are deactivated by your business. Please contact your business.','error');
						$this->redirect($this->referer());
					}else{
						$this->Session->setFlash('Username or Password is incorrect. Please try again.','error');
						$this->redirect($this->referer());
					}
				}
		    }
		    if ($this->Session->read('Auth.User')) {
		      
		       return $this->redirect($this->Auth->redirectUrl());
		  }
	}
		
	public function logout() {
			if($this->Session->check('sitedata')){
				$this->Session->delete('sitedata');
			}
			return $this->redirect($this->Auth->logout());
		}


		public function forgot(){
			if($this->request->is('post')){
				$email=$this->request->data['User']['email'];
				$user=$this->checkEmail($email, 'User');
				if($user){
					$uid=$this->generateUniqueKey();
					$url=Router::url('/users/resetPassword?key='.$uid, true);
					$content="<a href=$url>Click here to reset your password.</a>";
					$subject = 'Forget password';
	                $this->sendEmail($content,"support@repmgsys.com",$email,$subject);
	                $data=array();
	                $data['User']['id']=$user['User']['id'];
	                $data['User']['password_reset']=$uid;
	                $this->loadModel('User');
	                $this->User->save($data);
	                $this->Session->setFlash('Password reset link sent on your mail id.Please Check your email.');
					$this->redirect($this->referer());
				}else{
					$this->Session->setFlash('Email Id does not exist. Please try again.');
					$this->redirect($this->referer());
				}
			}else{
			   $this->render('forgot','login');	
			}
		}

		public function resetPassword(){
			if($this->request->is('post')){
				$uid=$this->request->data['User']['key'];
				//pr($this->request->params);die;
				$user=$this->User->find('first',array('conditions'=>array('password_reset'=>$uid)));
				//pr($user);die;
				if($user)
				{  // pr($this->request->data['User']);die;
					$pass=$this->request->data['User']['password'];
					$cpass=$this->request->data['User']['cpassword'];
					
						if($pass===$cpass){
							$data['User']['id']=$user['User']['id'];
							$data['User']['password']=$pass;
							$data['User']['password_reset']='';
							//pr($data);die;
							if($this->User->save($data)){
								$this->Session->setFlash('Password has been updated successfully.');
								return $this->redirect($this->Auth->logout());		
							}else{
								$this->Session->setFlash('!Opps, Something is wrong to update password.');
								return $this->redirect($this->Auth->logout());	
							}
						}else{
							$this->Session->setFlash('Password does not match.');
							$this->redirect($this->referer());	
						}
					
					
				}else{
					$this->Session->setFlash('Invalid reset Password link.Please try again.');
					$this->redirect($this->referer());	
				}
			}else{
				$data=array();
				$data['key']=$_GET['key'];
                $this->set('data', $data);
				$this->render('resetPassword','default');
			}
			
		}


                  public function businessUserForgot(){
			if($this->request->is('post')){
                                   
				$email=$this->request->data['User']['email'];
				$user=$this->checkEmail($email, 'User');
				if($user){
					$uid=$this->generateUniqueKey();
					$url=Router::url('/users/businessUserResetPassword?key='.$uid, true);
					$content="<a href=$url>Click here to Reset your password.</a>";
					$subject = 'Forget password';
	                $this->sendEmail($content,"support@repmgsys.com",$email,$subject);
	                $data=array();
	                $data['User']['id']=$user['User']['id'];
	                $data['User']['password_reset']=$uid;
	                $this->loadModel('User');
	                $this->User->save($data);
	                $this->Session->setFlash('Password reset link has been sent on your mail id.Please Check your email.');
					$this->redirect($this->referer());
				}else{
					$this->Session->setFlash('Email Id does not exist. Please try again.');
					$this->redirect($this->referer());
				}
			}else{
			    $this->render('business_user_forgot','default');	
			}
		}
public function businessUserResetPassword(){
			if($this->request->is('post')){
				$uid=$this->request->data['User']['key'];
				//pr($this->request->params);die;
				$user=$this->User->find('first',array('conditions'=>array('password_reset'=>$uid)));
				 
				if($user)
				{  // pr($this->request->data['User']);die;
					$pass=$this->request->data['User']['password'];
					$cpass=$this->request->data['User']['cpassword'];
					
						if($pass===$cpass){
							$data['User']['id']=$user['User']['id'];
							$data['User']['password']=$pass;
							$data['User']['password_reset']='';
							//pr($data);die;
							if($this->User->save($data)){ 
								$this->Session->setFlash('Password has been updated successfulluy.');
								$this->redirect(array('controller'=>'users','action'=>'businessUserLogin'));	
							}else{
								$this->Session->setFlash('!Opps, Something is wrong to update password.');
								$this->redirect($this->referer());	
							}
						}else{
							$this->Session->setFlash('Password does not match.');
							$this->redirect($this->referer());	
						}
					
					
				}else{
					$this->Session->setFlash('Invalid reset password link. Please try again.');
					$this->redirect($this->referer());	
				}
			}else{
				$data=array();
				$data['key']=$_GET['key'];
                $this->set('data', $data);
				$this->render('businessUserResetPassword','default');
			}
			
		}



		function checkUserEmail($param=null)
		{
			$email = trim($_REQUEST['data']['User']['email']);
			$this->autoRender = false;
			$count = $this->User->find('count',array('conditions'=>array('User.email'=>$email)));
			if($count>0)
			{
				echo "true";die;
			}
			else
			{
				echo "false";die;
			}	
		}
    function validatZip()
		{
			$zip = trim($_REQUEST['data']['Business']['zip']);
			$this->autoRender = false;
			$rexSafety = "/^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/";
            if (preg_match($rexSafety, $zip)) {
 			   echo "true";die;
			} else {
    		echo "false";die;
			}
		}
		 

		function validUserEmail()
		{
			$email = trim($_REQUEST['data']['User']['email']);
			$this->autoRender = false;
			$count = $this->User->find('count',array('conditions'=>array('User.email'=>$email)));
			if($count>0)
			{
				echo "false";die;
			}
			else
			{
				echo "true";die;
			}	
		}
 
public function validate_first_name()
    	{
    	    $name = trim($_REQUEST['data']['User']['firstname']);
    	    $this->autoRender = false;
    	    $rexSafety = "/^[a-zA-Z]+$/";
            if (preg_match($rexSafety, $name)) {
 			   echo "true";die;
			} else {
    		echo "false";die;
			}
		}
		public function validate_last_name()
    	{
    	    $name = trim($_REQUEST['data']['User']['lastname']);
    	    $this->autoRender = false;
    	    $rexSafety = "/^[a-zA-Z]+$/";
            if (preg_match($rexSafety, $name)) {
 			   echo "true";die;
			} else {
    		echo "false";die;
			}
		}

		
	}
