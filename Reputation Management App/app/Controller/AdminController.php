<?php 
App::uses('AppController', 'Controller');

class AdminController extends AppController {
  	
 
public $components = array('Paginator');
function beforeFilter()
           {
                         parent::beforeFilter();
						$this->Auth->allow('postReview','thanksToCustomer','thanksToNegativeCustomer');   
             
           }
 
public function index()
 {
 	$userType=$this->Session->read('Auth.User.usertype');
 	if($userType == 'admin')
 	{
	 	$this->loadModel('User');
	 	$this->paginate= array('limit'=>'15','conditions'=>array('User.usertype'=>'reseller'),'order'=>array('User.id'=>'DESC'));
	 	$this->set('agency_data',$this->paginate('User'));
	 	if($this->request->is('post'))
          	{  $data = $this->data; 
                $this->loadModel('User');                   
                $search = $data['searchForm']['search'];
				$search = trim($search);
				$this->paginate = array(
					    'conditions' => array('User.usertype'=>'reseller',
					    	'OR'=>array('User.firstname LIKE' => '%'.$search.'%','User.lastname LIKE' => '%'.$search.'%')));	
				$this->set('agency_data',$this->paginate('User'));
                                $this->set('searchText',$search);
								   
		 }
	 	
	}
	else
	{
		$this->Session->setFlash('You are not authorised...!!!');
 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
	}
 }

  public function add(){
 	$this->loadModel('User');
 	$this->loadModel('AgencysiteSetting');
 	$userType=$this->Session->read('Auth.User.usertype'); 
 	if($userType == 'admin'){
	 	if(!empty($this->data)){
	 		$data = $this->data;
			$data['User']['usertype'] = 'reseller';
			
			if($data['User']['status'] ==''){
				$data['User']['status']=0;
			} 
			
 			if($this->User->save($data)){
 				$id = $this->User->getLastInsertId();
 				$info['AgencysiteSetting']['user_id'] = $id;
 				$info['AgencysiteSetting']['agencyname'] = $data['agency']['agencyname'];
 				if($this->AgencysiteSetting->save($info))
 				{ 
 				$this->Session->setFlash('Agency added successfully.','success');
 				$this->redirect('/admin/index');
 			   }
 			}
		}
 	}else{
 		$this->Session->setFlash('You are not authorized user to access that location.','error');
 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 	}
 }
public function updatestatusagency($id = null, $status = null){
	    $st=$status;
		$this->loadModel('User');
		$this->loadModel('Business');
		$this->loadModel('BusinessEmployee');
		$id= base64_decode($id);
		$agency['User']['id'] = $id;
		$agency['User']['status'] = $status;
		if($this->User->save($agency))
		{
            $agency_data = $this->User->find('first',array('conditions'=>array('User.id'=>$id),'recursive'=> -1)); 
            if(@$agency_data['User']['usertype'] == 'reseller' && @$agency_data['User']['status'] == $status)
            {
            	$conditions = array('Business.agency_id'=>@$agency_data['User']['id']);
            	$agency_business = $this->Business->find('all',array('contain'=>array('User'),'conditions'=>$conditions));
            	foreach (@$agency_business as $key => $value) 
            	{
            		$business['User']['id'] = @$value['Business']['user_Id'];
            		if($status==1){
            			if(isset($value['Business']['stage']) && $value['Business']['stage']){
            			$business['User']['status']=$value['Business']['stage'];
	            		}else{
	            			$business['User']['status']=0;
	            		}
            		}else{
            			$business['User']['status'] = $status;
            		}
            		if($this->User->save(@$business))
            		{
            			if($status==0){
            				$value['Business']['stage']=$value['User']['status'];
            				$this->Business->save($value);
            			}
            			$conditions = array('BusinessEmployee.business_id'=>$value['Business']['id']);
            			$business_employee = $this->BusinessEmployee->find('all',array('contain'=>array('User'),'conditions'=>$conditions));
            			foreach (@$business_employee as $key1 => $value1) 
            			{
            				
            			  	$employee['User']['id'] = @$value1['BusinessEmployee']['user_id'];
            			  	if($status==1){
		            			if(isset($value1['BusinessEmployee']['stage']) && $value1['BusinessEmployee']['stage']){
		            				$employee['User']['status']=$value1['BusinessEmployee']['stage'];
			            		}else{
			            			$employee['User']['status']=0;
			            		}
		            	    }else{
		            	    	$employee['User']['status'] = $status;
		            	    }
	            		    if($this->User->save(@$employee)){
		            		      	if($status==0){
			            				$value1['BusinessEmployee']['stage']=$value1['User']['status'];
			            				$this->BusinessEmployee->save($value1);
		            				}
	            		    }

            			}
            		}
        	    }

            }
             $response[]='success';
             $response[]=base64_encode($id);
             if($st==1){
             	$st=0;
             }else{
  				$st=1;           	
             }
             $response[]=$st;
             $response[]=$id;
             echo json_encode($response);die;
          
		}

	}
	public function updatestatusbusiness($id = null, $status = null)
	{
		$st=$status;
		$this->loadModel('User');
		$this->loadModel('Business');
		$this->loadModel('BusinessEmployee');
		$id= base64_decode($id);
		$business['User']['id'] = $id;
		$business['User']['status'] = $status;
		$business_user_data = $this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$id),'recursive'=> -1)); 
		$con = array('User.id'=>$business_user_data['Business']['agency_id']);
        $agencyStatus = $this->User->find('first',array('conditions'=>$con,'fields'=>array('User.status'),'recursive'=> -1));
		 if($agencyStatus['User']['status'] == 0)
		 {
		   /*$this->Session->setFlash('This Business Agency is Deactivated Please Active Business Agency First..');
		   $this->redirect($this->referer());	*/
		   $response[]='agency';
		    echo json_encode($response);die;
		 }
		if($this->User->save($business))
		{
			 $business_user_data = $this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$id),'recursive'=> -1)); 
			 
             $conditions = array('BusinessEmployee.business_id'=>@$business_user_data['Business']['id']);
		     $business_employee = $this->BusinessEmployee->find('all',array('contain'=>array('User'),'conditions'=>$conditions));
		     foreach(@$business_employee as $key=>$value)
		     {
     	          $employee['User']['id'] = @$value['BusinessEmployee']['user_id'];
     	          if($status==1){
     	          	if(isset($value['BusinessEmployee']['stage']) && $value['BusinessEmployee']['stage']){
     	          		$employee['User']['status']= $value['BusinessEmployee']['stage'];
     	          	}else{
     	          		$employee['User']['status']= 0;
     	          	}
     	          }else{
     	          	$employee['User']['status'] = $status;
     	          }
    		      if($this->User->save(@$employee)){
    		      	 if($status==0){
    		      	 	$value['BusinessEmployee']['stage']=$value['User']['status'];
    		      	 	$this->BusinessEmployee->save($value);
    		      	 }
    		      }      	
		     }

		    $response[]='success';
            $response[]=base64_encode($id);
            if($st==1){
             	$st=0;
             }else{
  				$st=1;           	
             }
            $response[]=$st;
            $response[]=$id;
            echo json_encode($response);die;
		}	
	}
	public function updatestatusemployee($id = null, $status = null)
	{
		$st=$status;
		$this->loadModel('User');
		$this->loadModel('BusinessEmployee');
		$this->loadModel('Business');
		$id= base64_decode($id);
		$employee['User']['id'] = $id;
		$employee['User']['status'] = $status;
		$cond = array('BusinessEmployee.user_id'=>$id);
		$b_id = $this->BusinessEmployee->find('first',array('conditions'=>$cond,'fields'=>array('BusinessEmployee.business_id'),'recursive'=> -1));
	     $con = array('Business.id'=>$b_id['BusinessEmployee']['business_id']);
	     $business_user_id = $this->Business->find('first',array('conditions'=>$con,'fields'=>array('Business.user_Id','Business.agency_id'),'recursive' => -1));
	     $condi = array('User.id'=>$business_user_id['Business']['user_Id']);
	     $businessStatus = $this->User->find('first',array('conditions'=>$condi,'fields'=>array('User.status')));
	     if($businessStatus['User']['status'] == 0)
	     {
	      $response[]='business'	;
	      echo json_encode($response);die;	
	     /* $this->Session->setFlash('This Business is Deactivated Please Active Business First..');
		  $this->redirect($this->referer());	*/
	     }
         $condi = array('User.id'=>$business_user_id['Business']['agency_id']);
	     $businessStatus = $this->User->find('first',array('conditions'=>$condi,'fields'=>array('User.status')));
	    
        if(!empty($businessStatus) && $businessStatus['User']['status'] == 0)
	     {
	      $response[]='agency'	;
	      echo json_encode($response);die;		
	      /*$this->Session->setFlash('This Business Agency is Deactivated Please Active Agency First..');
		  $this->redirect($this->referer());	*/
	     }
       if($this->User->save($employee))
		{
			$response[]='success';
            $response[]=base64_encode($id);
            if($st==1){
             	$st=0;
             }else{
  				$st=1;           	
             }
            $response[]=$st;
            $response[]=$id;
            echo json_encode($response);die;
			  /*  $this->Session->setFlash('Status has been updated successfully.');
		    	$this->redirect($this->referer());*/
		}	

	}


  public function editAgency($id=NULL){ 
 	$this->loadModel('User');
 	$this->loadModel('AgencysiteSetting');
 	$edit_agency=$this->User->find('first',array('fields'=>array('id','firstname','lastname','lastlogin','email','status','agencyname'),'conditions'=>array('User.id'=>base64_decode($id)),'recursive'=>-1));
    $this->set(compact('edit_agency'));
 	$userType=$this->Session->read('Auth.User.usertype');
 	if($userType == 'admin')
 	{
	 	if(!empty($this->data))
	 	{
	 		$data = $this->data;
	 	
	 		if(empty($data['User']['status']))
	 		{
				$data['User']['status'] = 0;
			}
	 		if($this->User->save($data))
	 		{
	 			$con = array('AgencysiteSetting.user_id'=>$data['User']['id']);
                $agency_site_id = $this->AgencysiteSetting->find('first',array('conditions'=>$con,'fields'=>array('id'),'recursive'=> -1));
                $info['AgencysiteSetting']['id'] = $agency_site_id['AgencysiteSetting']['id'];
 				$info['AgencysiteSetting']['agencyname'] = $data['agency']['agencyname'];
 				if($this->AgencysiteSetting->save($info))
 				{ 
 				$this->Session->setFlash('Agency updated successfully.','success');
 				$this->redirect($this->Auth->redirect('/admin/index'));
 			   }
	 			
	 		}
	 	}
 	}
 	else
 	{
 		$this->Session->setFlash('You are not authorized user to access that location.','error');
 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 	}
 }


 	function delete($model,$id){
		$this->loadModel($model);
		$this->$model->delete(base64_decode($id));
		$this->Session->setFlash('Record deleted successfully.','success');
		$this->redirect($this->referer());
	}

	
  

 function agencyBusiness($id = NULL)
  {
      	$userType=$this->Session->read('Auth.User.usertype');
      	if($userType == 'admin')
 		{
	        if(empty($id))
	        {
	 		$this->loadModel('Business');
		 	$this->paginate= array('limit'=>'15','conditions'=>array('Business.agency_id >'=>0,'Business.is_deleted'=>0),'order'=>array('Business.id'=>'DESC'));
		 	$this->set('Agency_bus',$this->paginate('Business'));
		 	}
		 	if(!empty($id))
	 		{
	 		$id = base64_decode($id); 
	 		$this->loadModel('Business');
		 	$this->paginate= array('limit'=>'15','conditions'=>array('Business.agency_id'=>$id,'Business.is_deleted'=>0),'order'=>array('Business.id'=>'DESC'));
		 	$this->set('Agency_bus',$this->paginate('Business'));
		 	$this->set('agency_id',$id);
                        $this->set('valid',1);
		    }
	        if($this->request->is('post'))
	        {                       
                                    $this->loadModel('Business');
	        	                    $data = $this->data;
	        	                    if(isset($data['searchForm']['agency_id']) && !empty($data['searchForm']['agency_id']))
	        	                    {  
                                    $search = $data['searchForm']['search'];
									$search = trim($search);
									$this->paginate = array(
										    'conditions' => array(
										    'Business.businessname LIKE'=>'%'.$search.'%','Business.agency_id'=>$data['searchForm']['agency_id'],'Business.is_deleted'=>0));	
									$this->set('Agency_bus',$this->paginate('Business'));
                                                                        $this->set('valid',1);   
                                                                        $this->set('searchText',$search);   
	        	                    }
	        	                    else
	        	                    {	
									$search = $data['searchForm']['search'];
									$search = trim($search);
									$this->paginate = array(
										    'conditions' => array(
										    'Business.businessname LIKE'=>'%'.$search.'%','Business.agency_id >'=>0,'Business.is_deleted'=>0));	
									$this->set('Agency_bus',$this->paginate('Business'));
                                                                        $this->set('searchText',$search); 
								   }
		 	}
		}
		else
		{
			$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}
	}		

	function add_business(){
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->loadModel('BusinessCategory');
			$this->loadModel('User');
			$businessCategories = $this->BusinessCategory->find('list',array('conditions'=>array('BusinessCategory.status'=>1),'fields'=>array('id','name'),'recursive'=>-1,'order'=>'name ASC'));
			$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));
			
			$this->set(compact('businessCategories','agency_list'));
			if(!empty($this->data)){
				$data= $this->data;
				$this->loadModel('User');
				$this->loadModel('Business');
				$data['User']['usertype'] = 'subscriber';
				if($data['User']['status'] ==''){
					$data['User']['status']=0;
				}
				
				if($this->User->save($data)){
					$id = $this->User->getLastInsertId();
					$data['Business']['user_Id'] = $id;
                                        $data['Business']['createdat']=Date('Y-m-d');
					if($this->Business->save($data)){
						$this->Session->setFlash('Business added successfully.','success');
	 					$this->redirect('/admin/agencyBusiness');
					}
				}

			}
		}else{
	 		$this->Session->setFlash('You are not authorized user to access that location.','error');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}
	}

	/*function edit_business($id=NULL){
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->loadModel('Business');
			$this->loadModel('BusinessCategory');
			$this->loadModel('User');
			$id = base64_decode($id); 
			$edit_bus = $this->Business->find('first',array('contain'=>array('User'),'conditions'=>array('Business.id'=>$id)));
			//$businessCategories = $this->BusinessCategory->find('list',array('fields'=>array('id','name'),'recursive'=>-1));
			$businessCategories = $this->BusinessCategory->find('list',array('conditions'=>array('BusinessCategory.status'=>1),'fields'=>array('id','name'),'recursive'=>-1,'order'=>'name ASC'));
			$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller'),'recursive'=>-1));
			$this->set(compact('edit_bus','businessCategories','agency_list'));

			if(!empty($this->data)){
				$data = $this->data;
				$this->loadModel('User');
				if($this->Business->save($data)){
					$data['User']['id']=$data['Business']['user_Id'];
					if(empty($data['User']['status'])){
						$data['User']['status'] = 0;
					}
					if($this->User->save($data)){
						$this->Session->setFlash('Business updated successfully.');
	 					$this->redirect('/admin/agencyBusiness');
					}
				}
			}
		}else{
	 		$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}
	}*/
function edit_business($id=NULL){
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->loadModel('Business');
			$this->loadModel('BusinessCategory');
			$this->loadModel('User');
			$id = base64_decode($id); 
			$edit_bus = $this->Business->find('first',array('contain'=>array('User'),'conditions'=>array('Business.id'=>$id)));
			$businessCategories = $this->BusinessCategory->find('list',array('conditions'=>array('BusinessCategory.status'=>1),'fields'=>array('id','name'),'recursive'=>-1,'order'=>'name ASC'));
			$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));
			 
			$this->set(compact('edit_bus','businessCategories','agency_list'));

			if(!empty($this->data)){
				$data = $this->data;
				$this->loadModel('User');
				if($this->Business->save($data)){
					$data['User']['id']=$data['Business']['user_Id'];
					if(empty($data['User']['status'])){
						$data['User']['status'] = 0;
					}
					if($this->User->save($data)){
						$this->Session->setFlash('Business updated successfully.','success');
	 					$this->redirect('/admin/agencyBusiness');
					}
				}
			}
		}else{
	 		$this->Session->setFlash('You are not authorized user to access that location.','error');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}
	}


	 

	function employee_list($id){
		$this->loadModel('BusinessEmployee');
		$emp_list =$this->BusinessEmployee->find('all',array('conditions'=>array('BusinessEmployee.business_id'=>base64_decode($id))));
		$this->paginate = array('limit'=>'15','conditions'=>array('BusinessEmployee.business_id'=>base64_decode($id)),'order'=>array('BusinessEmployee.id'=>'DESC'));
		$this->set('emp_list',$this->paginate('BusinessEmployee'));
	}


	function category(){
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->loadModel('BusinessCategory');
			if(isset($this->request->data['searchForm']['search'])){
				if($this->request->is('post')){ 
					$data = $this->data;
					$search = $data['searchForm']['search'];
					$search = trim($search);
					$this->paginate = array(
							'order'=>array('BusinessCategory.name ASC'),
						    'conditions' => array(
						    'BusinessCategory.name LIKE'=>'%'.$search.'%'));	
				}
				$this->set('bus_cat',$this->paginate('BusinessCategory'));
                                $this->set('searchText',$search);
			}else{
					$this->paginate = array('limit'=>'15','order'=>array('BusinessCategory.name'=>'ASC'),'recursive'=>-1);
					$this->set('bus_cat',$this->paginate('BusinessCategory'));
			}


	 	}else{
	 		$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}	
	}
	function add_category(){
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			if(!empty($this->data)){
				$this->loadModel('BusinessCategory');
				if ($this->BusinessCategory->save($this->data)) {
					$this->Session->setFlash('Category added successfully.','success');
	 				$this->redirect($this->Auth->redirect('/admin/category'));	
				}
			}
		}else{
	 		$this->Session->setFlash('You are not authorised...!!!','error');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}
	}

	function edit_category($id=NULL){
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->loadModel('BusinessCategory');
			$edit_category = $this->BusinessCategory->find('first',array('conditions'=>array('BusinessCategory.id'=>base64_decode($id)),'recursive'=>-1));
			$this->set(compact('edit_category'));
			
			if(!empty($this->data)){
				$data = $this->data;
				if(empty($data['User']['status'])){
				$data['User']['status'] = 0;
				}
				if(empty($this->data['BusinessCategory']['status'])){
					$data['BusinessCategory']['status'] = 0;
				}
				
				if ($this->BusinessCategory->save($data)) {
					$this->Session->setFlash('Category updated successfully.','success');
	 				$this->redirect($this->Auth->redirect('/admin/category'));	
				}
			}
		}else{
	 		$this->Session->setFlash('You are not authorised...!!!','error');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}
	}

	function cat_updatestatus($id,$status)
	{
		$st=$status;
		$this->loadModel('BusinessCategory');
		$id= base64_decode($id);
		$data['BusinessCategory']['id'] = $id;
		$data['BusinessCategory']['status'] = $status;
		if($this->BusinessCategory->save($data))
		{
			$response[]='success';
            $response[]=base64_encode($id);
            if($st==1){
             	$st=0;
             }else{
  				$st=1;           	
             }
            $response[]=$st;
             $response[]=$id;
            echo json_encode($response);die;
			/*$this->Session->setFlash('Status has been updated successfully.');
			$this->redirect($this->referer());*/
		}

	}

	function bus_cat_list($id){
		$this->loadModel('Business');
		$this->paginate = array('limit'=>'15','conditions'=>array('Business.business_category_id'=>base64_decode($id)),'order'=>array('Business.id'=>'DESC'));
		$this->set('bus_cat_list',$this->paginate('Business'));
	}

	/*function customer($id = null)
	{
		 $userType=$this->Session->read('Auth.User.usertype');
      	if($userType == 'admin')
 		{
	        if(empty($id))
	        {
	 		$this->loadModel('Customer');
		 	$this->paginate= array('limit'=>'15','order'=>array('Customer.id'=>'DESC'));//pr($this->paginate('Customer'));die;
		 	$this->set('Customer',$this->paginate('Customer'));
		 	}
		 	if($this->request->is('post'))
            		 {  	$data = $this->data; 
                		$this->loadModel('Customer');                   
               			 $search = $data['searchForm']['search'];
				$search = trim($search);
				$this->paginate = array(
					    'conditions' => array('OR'=>array('Customer.firstname LIKE' => "%$search%",'Customer.lastname LIKE' => "%$search%",'Customer.email LIKE' => "%$search%")));	
				$this->set('Customer',$this->paginate('Customer'));
                                 $this->set('searchText',$search);
								   
		 	}
		}
		else
		{
			$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}

	}*/
function customer($id = null)
	{
		 $userType=$this->Session->read('Auth.User.usertype');
      	if($userType == 'admin')
 		{
	        if(empty($id))
	        {
	 		$this->loadModel('Customer');
		 	$this->paginate= array('conditions'=>array('Customer.is_delete'=>0),'limit'=>'15','order'=>array('Customer.id'=>'DESC')); 
		 	$this->set('Customer',$this->paginate('Customer'));
		 	}
		 	if($this->request->is('post'))
            		 {  	$data = $this->data; 
                		$this->loadModel('Customer');                   
               			 $search = $data['searchForm']['search'];
				$search = trim($search);
				$this->paginate = array(
					    'conditions' => array('Customer.is_delete'=>0,'OR'=>array('Customer.firstname LIKE' => "%$search%",'Customer.lastname LIKE' => "%$search%",'Customer.email LIKE' => "%$search%")));	
				$this->set('Customer',$this->paginate('Customer'));
                                 $this->set('searchText',$search);
								   
		 	}
		}
		else
		{
			$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}

	}

	
function add_customer()
{
$userType=$this->Session->read('Auth.User.usertype');
	if($userType == 'admin')
	{
		$this->loadModel('Country');
		$this->loadModel('Customer');
		$this->loadModel('User');
		$this->loadModel('Business');
		$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
                    $us = $countries[1];
		unset($countries[1]);
		$countries[1] = $us;
		$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));
		   $this->set(compact('countries','agency_list'));
		if(!empty($this->data))
		{  
			$data = $this->data;
			$business_info = $this->Business->find('first',array('contain'=>array('User'),'conditions'=>array('Business.id'=>$data['Customer']['business_id']),'fields'=>array('User.email','User.id','Business.businessname','Business.id')));
			$business_name = $business_info['Business']['businessname'];
			$business_email = $business_info['User']['email'];
			$user_id = base64_encode($business_info['User']['id']);
           if((@$data['Customer']['preview'] == 1) && (@$data['Customer']['permission_to_email'] =='on'))
            {  
            $this->request->data['Customer']['permission_to_email'] = 1;	
        	$this->request->data['Customer']['status'] = 'InFeedbackSequence';
        	$this->request->data['Customer']['emailstatuscounter'] = 1;
            }
            else
            {
            $this->request->data['Customer']['status'] = 'NotInFeedbackSequence';
            }
            if($this->Customer->save($this->request->data['Customer']));
			{ 
		    $todaydate = date("Y-m-d");
            $customer_id = $this->Customer->getLastInsertId();
            if((@$this->request->data['Customer']['preview'] == 1) && (@$this->request->data['Customer']['permission_to_email'] ==1))
				{ 		
		            $email = $data['Customer']['email'];
					$name = $data['Customer']['firstname']. ' '. $data['Customer']['lastname'];
					$url=Router::url('/admin/postReview?id='.$user_id.'&customer_id='.base64_encode($customer_id), true);
					$eTemplate=$this->getEmailcontent($business_info['Business']['id'],1);
					$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
					$sendername=@$eTemplate['sendername'];
					$sendemail=@$eTemplate['senderemail'];
					$content=$eTemplate['emailcontent'];	
					$subject=@$eTemplate['emailsubject'];
					$receiveremail=$email;
					if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
						  $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
			        	  $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
			        	  $this->redirect('/admin/customer');
					else:
						 $this->Session->setFlash('not healthy email id','error');
					endif;
				}
				else
				{
					$this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));	
					$this->Session->setFlash('Customer has been successfully Added','success');
					$this->redirect('/admin/customer');
                }
             }
		}

	}
   else
   {
	$this->Session->setFlash('You are not authorized user to access that location.','error');
	$this->redirect(array('controller'=>'dashboard','action'=>'index'));
	}
}
function edit_customer($id=NULL)
{
  $userType=$this->Session->read('Auth.User.usertype');
  if($userType == 'admin')
  {
	$this->loadModel('Customer');
	$this->loadModel('User');
	$this->loadModel('Country');
	$this->loadModel('BusinessEmployee');
	if($this->request->is('post'))
       {
       	        $data = $this->data;
       	        $business_info = $this->Business->find('first',array('contain'=>array('User'),'conditions'=>array('Business.id'=>$data['Customer']['business_id']),'fields'=>array('User.email','User.id','Business.businessname','Business.id')));
			    $business_name = $business_info['Business']['businessname'];
			    $business_email = $business_info['User']['email'];
			    $user_id = base64_encode($business_info['User']['id']);
                if((@$data['Customer']['preview'] == 1) && (@$data['Customer']['permission_to_email'] == 'on'))
	              {
                    $data['Customer']['status'] = 'InFeedbackSequence';
	            	$data['Customer']['emailstatuscounter'] = 1;
	            	$data['Customer']['permission_to_email'] = 1;
                   }
                   else if(!(isset($data['Customer']['preview'])) && (!isset($data['Customer']['permission_to_email'])))
	              {
                    
	            	$data['Customer']['status'] = 'InFeedbackSequence';
	            	$data['Customer']['emailstatuscounter'] = 1;
	            	$data['Customer']['permission_to_email'] = 1;
                   }
                   else
	                {
                     $data['Customer']['status'] = 'NotInFeedbackSequence';
       			 	}	

       	        if($this->Customer->save($data))
				{
					 $todaydate = date("Y-m-d");
                     $customer_id = $this->data['Customer']['id'];
                    if((@$data['Customer']['preview'] == 1) && (@$data['Customer']['permission_to_email'] == 1))
					{   
						$user_id = base64_encode($business_info['User']['id']);
						$email = $this->request->data['Customer']['email'];
						$name = $this->request->data['Customer']['firstname']. ' '. $this->request->data['Customer']['lastname'];
						$url=Router::url('/admin/postReview?id='.$user_id.'&customer_id='.base64_encode($customer_id), true);
						$eTemplate=$this->getEmailcontent($business_info['Business']['id'],1);
						$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
						$sendername=@$eTemplate['sendername'];
						$sendemail=@$eTemplate['senderemail'];
						$content=$eTemplate['emailcontent'];	
						$subject=@$eTemplate['emailsubject'];
						$receiveremail=$email;
						if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
					    $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
		        	    $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
		        	    $this->redirect('/admin/customer');
						else:
					    $this->Session->setFlash('not saved email id','error');
						endif;         
                             
            	}
                else
                {
                  	$this->Session->setFlash('Customer has been Updated successfully','success');
					$this->Session->setFlash('Customer has been updated successfully.','success');
					$this->redirect('/admin/customer');
				}
		}
	}
else
	 {	
				$edit_cus = $this->Customer->find('first',array('conditions'=>array('Customer.id'=>base64_decode($id))));
				$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));
                $bus_list = $this->Business->find('all',array('contain'=>array('User'),'fields'=>array('id','agency_id','status','businessname','is_deleted','User.id','User.status'),'conditions'=>array('Business.is_deleted'=>0,'Business.status'=>1,'User.status'=>1,'Business.agency_id'=>$edit_cus['Business']['agency_id'])));
		        $emp_list = $this->BusinessEmployee->find('all',array('conditions'=>array('Business.status'=>1,'Business.is_deleted'=>0,'User.status'=>1,'BusinessEmployee.business_id'=>$edit_cus['Customer']['business_id'])));
			    $countries = $this->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));

		 		$this->loadModel('State');
				$states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
			    $this->set('states',$states);
			    $this->set(compact('edit_cus','agency_list','emp_list','bus_list','countries'));
        }
    }
	else
		{
			$this->Session->setFlash('You are not authorized user to access that location.','error');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}
}
function validatZip()
		{
			$zip = trim($_REQUEST['data']['Customer']['zip']);
			$this->autoRender = false;
			$rexSafety = "/^[0-9]|([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/";
            if (preg_match($rexSafety, $zip)) {
 			   echo "true";die;
			} else {
    		echo "false";die;
			}
		}

	function ormBusiness(){
		$this->loadModel('Business');
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->paginate= array('conditions'=>array('Business.agency_id'=>NULL),'limit'=>'15','contain'=>array('BusinessCategory','User'=>array('AgencysiteSetting')),'order'=>array('Business.id'=>'DESC'));
	 		//pr($this->paginate('Business'));die;
	 		$this->set('bus_data',$this->paginate('Business'));
		}else{
	 		$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
 		}
	}

	public function employees($id = null)
	{ 
      	$userType=$this->Session->read('Auth.User.usertype');
      	if($userType == 'admin')
 		{
	        if(empty($id))
	        {
	 		$this->loadModel('BusinessEmployee');
		 	$this->paginate= array('limit'=>'15','order'=>array('BusinessEmployee.id'=>'DESC'));
		 	//pr($this->paginate('BusinessEmployee'));die;
		 	$this->set('employee',$this->paginate('BusinessEmployee'));
		 	}
		 	if(!empty($id))
	 		{
	 		$id = base64_decode($id); 
	 		$this->loadModel('BusinessEmployee');
		 	$this->paginate= array('limit'=>'15','conditions'=>array('BusinessEmployee.business_id'=>$id),'order'=>array('BusinessEmployee.id'=>'DESC'));
		 	$this->set('employee',$this->paginate('BusinessEmployee'));
		 	$this->set('business_id',$id);
		    }
	        if($this->request->is('post'))
	        {                       

	        	                    $data = $this->data;
	        	                    if(isset($data['searchForm']['business_id']) && !empty($data['searchForm']['business_id']))
	        	                    {
                                    $search = $data['searchForm']['search'];
									$search = trim($search);
									$this->paginate = array(
										    'conditions' => array(
										    'BusinessEmployee.emp_name LIKE'=>'%'.$search.'%','BusinessEmployee.id=>'<> NULL,'BusinessEmployee.business_id'=>$data['searchForm']['business_id']));	
									$this->set('employee',$this->paginate('BusinessEmployee'));
                                                                         $this->set('searchText',$search);  
	        	                    }
	        	                    else
	        	                    {	
									$search = $data['searchForm']['search'];
									$search = trim($search);
									$this->paginate = array(
										    'conditions' => array(
										    'BusinessEmployee.emp_name LIKE'=>'%'.$search.'%','BusinessEmployee.id=>'<> NULL));	
									$this->set('employee',$this->paginate('BusinessEmployee'));
                                                                         $this->set('searchText',$search); 
								   }
		 	}
		}
		else
		{
			$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}

	}
public function addemp()
	{
		$this->loadModel('User');
		$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));
		$this->set('agnc',$agency_list);
		
		if($this->request->is('post')){
			$this->request->data['User']['usertype']="employee";
			$this->request->data['User']['createdat']=date('Y-m-d H:i:s');
			
			if(isset($this->request->data['User']['status']) && $this->request->data['User']['status']=='on'){
				$this->request->data['User']['status']=1;
			}else{
				$this->request->data['User']['status']=0;
			}
			if($this->User->save($this->request->data['User'])){
				$this->request->data['BusinessEmployee']['user_id']=$this->User->getLastInsertId();
				$this->request->data['BusinessEmployee']['emp_name']=$this->request->data['User']['firstname'].' '.$this->request->data['User']['lastname'];
				$this->request->data['BusinessEmployee']['created_at']=date('Y-m-d H:i:s');
				$this->loadModel('BusinessEmployee');
				if($this->BusinessEmployee->save($this->request->data['BusinessEmployee'])){
					$this->Session->setFlash('Employee has been added successfully.','success');
	 				$this->redirect(array('controller'=>'admin','action'=>'employees'));
				}
			}else{
				$this->Session->setFlash('Unable to save data ! Please try again.','error');
	 			$this->redirect(array('controller'=>'admin','action'=>'employees'));
			}
			
		}
	}
	
	public function editEmployee($id = null) 
{
			if($id)
			{       
				    $this->loadModel('User');
					$id=base64_decode($id);
					$this->loadModel('BusinessEmployee');
					$emp=$this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.id'=>$id)));
					$this->set('emp',$emp);
					$this->loadModel('Business');
					$buss=$this->Business->find('all',array('contain'=>array('User'),'conditions'=>array('Business.is_deleted'=>0,'User.status'=>1,'Business.agency_id'=>$emp['Business']['agency_id'])));
					$this->set('buss',$buss);
					$agency_list = $this->User->find('all',array('conditions'=>array('User.usertype'=>'reseller','User.status'=>1,'User.agencyname <>'=>''),'recursive'=>-1,'order'=>'agencyname ASC'));
					$this->set('agnc',$agency_list);


			}
			elseif($this->request->is('post'))
			{    
					$this->loadModel('BusinessEmployee');
					$this->loadModel('AgencysiteSetting');
					$this->loadModel('User');
					$emp=$this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.id'=>$this->request->data['BusinessEmployee']['id'])));

					$this->set('emp',$emp);
					$this->loadModel('Business');
					$buss=$this->Business->find('all',array('contain'=>array('User'),'conditions'=>array('Business.is_deleted'=>0,'User.status'=>1),'fields'=>array('Business.id','Business.businessname')));
					$this->set('buss',$buss);
					
					if(isset($this->request->data['User']['status']) && $this->request->data['User']['status']=='on')
					{
						$this->request->data['User']['status']=1;
					}
					else
					{
						$this->request->data['User']['status']=0;
					}
					
					if($this->User->save($this->request->data['User']))
					{  
						$this->loadModel('BusinessEmployee');
						$this->request->data['BusinessEmployee']['emp_name']=$this->request->data['User']['firstname'].' '.$this->request->data['User']['lastname']; 
					   if($this->BusinessEmployee->save($this->request->data['BusinessEmployee']))
					   {
	                        if($this->Business->save($this->request->data['Business']))
	                        {
							$this->Session->setFlash('Employee has been updated successfully.','success');
		 					$this->redirect(array('controller'=>'admin','action'=>'employees'));
						    } 
					   }
					}
			}
			else
			{
				$this->Session->setFlash('Invalid Employee ! Please try again.','error');
		 		$this->redirect(array('controller'=>'admin','action'=>'employees'));
			}
}		
	

	

	function sites(){
		
		$userType=$this->Session->read('Auth.User.usertype');
		if($userType == 'admin'){
			$this->loadModel('SocialMedia');
			$this->paginate= array('limit'=>'15','order'=>array('SocialMedia.mediasitename ASC'));
	 		//echo"<pre>";pr($this->paginate('SocialMedia'));die;
	 		$this->set('bus_site',$this->paginate('SocialMedia'));
	 		if($this->request->is('post'))
          	{  
          		$data = $this->data; 
                $search = $data['searchForm']['search'];
				$search = trim($search);
				//pr($search);die;
				$this->paginate = array(
						'order'=>array('SocialMedia.mediasitename ASC'),
					    'conditions' => array('SocialMedia.mediasitename LIKE'=>'%'.$search.'%'));	
				$this->set('bus_site',$this->paginate('SocialMedia'));
                $this->set('searchText',$search);
								   
		 }
		}else{
	 		$this->Session->setFlash('You are not authorised...!!!');
	 		$this->redirect($this->referer());
 		}
	}

	function editsite($id=null){
		$id=base64_decode($id);
		$this->loadModel('SocialMedia');
		if($id){
			$site=$this->SocialMedia->find('first',array('conditions'=>array('SocialMedia.id'=>$id)));
			$this->set('site',$site);
		}elseif($this->request->is('post')){
			// pr($this->request->data);die;
			if(isset($this->request->data['SocialMedia']['status'])){
				$this->request->data['SocialMedia']['status']=1;
			}else{
				$this->request->data['SocialMedia']['status']=0;
			}
		if($this->SocialMedia->save($this->request->data)){
			$this->Session->setFlash('Site has been updated successfully.','success');
	 		$this->redirect(array('controller'=>'admin','action'=>'sites'));
		}	
		}else{
			$this->Session->setFlash('You are not authorised...!!!','error');
	 		$this->redirect($this->referer());
		}
	}

	function business_list($id){
		$this->loadModel('Business');
		$this->paginate = array('limit'=>'15','conditions'=>array('Business.user_Id'=>base64_decode($id)),'order'=>array('Business.id'=>'DESC'));
		$this->set('bus_list',$this->paginate('Business'));
	}

	function searchAgency(){
		if($this->request->is('post')){
			$searchValue = $this->request->data['searchForm']['search'];
			$searchValue = trim($searchValue);
			$this->loadModel('AgencysiteSetting');
			$this->paginate = array(
					    'conditions' => array(
					    'AgencysiteSetting.agencyname LIKE' => "%$searchValue%"));
			$this->set('agency_data',$this->paginate('AgencysiteSetting'));
			return $this -> render('agency');
		}else {
			$this->redirect( '/agency' );
		}
	}

	function findBusiness(){
		$this->autoRender=false;
        if ($this->request->is('Ajax'))
        {
        	$this->loadModel('Business');
        	$bus_id = $this->data['id'];
        	$data1 = $this->Business->find('all',array('conditions'=>array('Business.agency_id'=>$bus_id,'Business.is_deleted'=>0,'User.status'=>1,'Business.agency_id >'=>0), 'fields'=>array('id','businessname'),'order'=>array('businessname ASC'))); 
        	
	        $data=array();
	        foreach ($data1 as $key => $value) {
	        $data[$value['Business']['id']]=$value['Business']['businessname'];
	        }
	        asort($data);
	        $this->set('bus', $data);
            echo json_encode(array('html' => $data));
        }
	}

	function findEmployee(){
		$this->autoRender=false;
		$this->loadModel('BusinessEmployee');
        if ($this->request->is('Ajax'))
        {
        	$bus_id = $this->data['id'];
        	$data = $this->BusinessEmployee->find('list',array('conditions'=>array('BusinessEmployee.business_id'=>$bus_id),'fields'=>array('id','emp_name'),'order'=>'BusinessEmployee.emp_name ASC'));   
	        asort($data);
            
	        $this->set('emp', $data);
            echo json_encode(array('html' => $data));
        }
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
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
	        //sort($data);
	        $this->set('cities', array_unique($data));
            echo json_encode(array('html' => $data));
        }
    }

   function checkEmail_user()
	{   $this->autoRender=false;
	    if ($this->request->is('Ajax'))
        {
	    $this->loadModel('Customer');
            $email = trim($_REQUEST['data']['Customer']['email']);
	    $count = $this->Customer->find('count',array('conditions'=>array('Customer.email'=>$email,'Customer.is_delete'=>0)));
		
		if($count > 0)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
	}

	}
     function updatesite($id = null, $status = null)
	{
		$st=$status;
		$this->loadModel('SocialMedia');
		$id= base64_decode($id);
		$data['SocialMedia']['id'] = $id;
		$data['SocialMedia']['status'] = $status;
		
		if($this->SocialMedia->save($data))
		{
			$response[]='success';
             $response[]=base64_encode($id);
             if($st==1){
             	$st=0;
             }else{
  				$st=1;           	
             }
             $response[]=$st;
             $response[]=$id;
             echo json_encode($response);die;
			/*$this->Session->setFlash('Status has been updated successfully.');
			$this->redirect($this->referer());*/
		}

	}	
	public function postReview()
    {    
        if( ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty (base64_decode (@$_GET['id'] ) ) ) || $this->request->is('post') )
        { 
				        $this->layout = 'micro';
				    	$this->loadModel('Business');
				    	$this->loadModel('BusinessReview');
				    	$this->loadModel('Customer');
				    	$this->loadModel('User');

		    	if($this->request->is('post'))
		    	{
				         
				    	$busiess_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$this->data['BusinessReview']['user_id']),'fields'=>array('Business.id','Business.businessname','Business.feedbackthreshold'),'recursive'=>'-1')); 
				    	$threshold = $busiess_id['Business']['feedbackthreshold'];
                                        $business_emial_template_id = $busiess_id['Business']['id']; 
					$business_name = $busiess_id['Business']['businessname'];
					
				    	$user_email = $this->User->find('first',array('contain'=>false,'conditions'=>array('User.id'=>$this->data['BusinessReview']['user_id']),'fields'=>array('User.email'))); 
				        $admin_email = $user_email['User']['email'];
					$this->request->data['BusinessReview']['business_id'] = $busiess_id['Business']['id'];
				    	$desc = strip_tags($this->request->data['BusinessReview']['ratingdescription']);

				    	$this->request->data['BusinessReview']['ratingdescription'] = $desc;
				    	$customer_id = $this->request->data['BusinessReview']['customer_id'];
				        $business_id = $this->request->data['BusinessReview']['business_id']; 
				        $cus_rating_status = $this->request->data['BusinessReview']['ratingstar'].'R';
				        $datetime = date_create()->format('Y-m-d H:i:s');
				        $this->request->data['BusinessReview']['ratingdate'] = $datetime; 
				        $this->loadModel('FeedbackSetting');
					$feedbacksetting=$this->FeedbackSetting->find('first',array('conditions'=>array('FeedbackSetting.business_id'=>$busiess_id['Business']['id']),'recursive'=>-1));
					$this->set('feedbacksetting',$feedbacksetting);
				    	if($this->BusinessReview->save($this->request->data['BusinessReview']))
				    	{         
				    		        $business_review_id = $this->BusinessReview->getLastInsertId();
				    		        
				    		        $this->Customer->updateAll(array('Customer.status' =>"'$cus_rating_status'"), array('Customer.id' => $customer_id,'Customer.business_id'=>$business_id));
				    		        $cus_email = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customer_id),'fields'=>array('Customer.email','Customer.firstname','Customer.lastname')));
				                        $email = $cus_email['Customer']['email'];
							$name = $cus_email['Customer']['firstname']. ' '. $cus_email['Customer']['lastname'];
							$google = 'www.google.com';
								if($this->request->data['BusinessReview']['ratingstar'] > $threshold)
                                    
                                   {
									$eTemplate=$this->getEmailcontent($business_emial_template_id,3);
									$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$admin_email);
									$sendername=@$eTemplate['sendername'];
									$sendemail=@$eTemplate['senderemail'];
									$content=$eTemplate['emailcontent'];	
									$subject=@$eTemplate['emailsubject'];
									$receiveremail=$email;
									if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
										 
											# send positive alert to business owner
											$eTemplate=$this->getEmailcontent($business_emial_template_id,5);
											$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$admin_email);
											$sendername=@$eTemplate['sendername'];
											$sendemail=@$eTemplate['senderemail'];
											$content=$eTemplate['emailcontent'];	
											$subject=@$eTemplate['emailsubject'];
											$receiveremail=$admin_email;
											$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
											$this->Session->setFlash('Your Reviews has been shared with us','success');
										  
											$this->redirect(array('controller'=>'admin','action'=>'thanksToCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id),'business_review_id'=>base64_encode($business_review_id))));
				                     
									endif;
                                             

                      									//$this->redirect(array('controller'=>'dashboard','action'=>'thanksToCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id),'business_review_id'=>base64_encode($business_review_id))));
				                       }else
				                       {
				                                $eTemplate=$this->getEmailcontent($business_emial_template_id,4);
												$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$admin_email);
												$sendername=@$eTemplate['sendername'];
												$sendemail=@$eTemplate['senderemail'];
												$content=$eTemplate['emailcontent'];	
												$subject=@$eTemplate['emailsubject'];
												$receiveremail=$email;
												if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
													$eTemplate=$this->getEmailcontent($business_emial_template_id,6);
													$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$admin_email);
													$sendername=@$eTemplate['sendername'];
													$sendemail=@$eTemplate['senderemail'];
													$content=$eTemplate['emailcontent'];	
													$subject=@$eTemplate['emailsubject'];
													$receiveremail=$admin_email;
													$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
													
													$this->redirect(array('controller'=>'admin','action'=>'thanksToNegativeCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id)))); 
													$this->Session->setFlash('Your Reviews has been shared with us','success');
				                             
												endif;
				                    
                                             }
                        }	
				        else
				        {
				        	
				        }
    			 }
                else 
                {
                	$this->loadModel('BusinessReview');
                        $this->loadModel('Business');
			        $user_id = base64_decode($_GET['id']);
			        $customer_id = base64_decode($_GET['customer_id']);
                                  
			        $agency_logo = $this->Business->find('first',array('conditions'=>array('Business.user_Id'=>@$user_id)));
                        $this->loadModel('FeedbackSetting');
			$feedbacksetting=$this->FeedbackSetting->find('first',array('conditions'=>array('FeedbackSetting.business_id'=>$agency_logo['Business']['id']),'recursive'=>-1));
			$this->set('feedbacksetting',$feedbacksetting);         
                    $cnt = $this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>@$agency_logo['Business']['id'],'BusinessReview.customer_id'=>$customer_id)));
                    if($cnt > 0)
                    {
                    	 
                    	$this->Session->setFlash('You already gave the Reviews..','error');
                    	$this->redirect($this->referer());

                    }
                 
                  

			        $this->set('user_id',@$user_id);
			        $this->set('customer_id',@$customer_id);
                    $this->loadModel('AgencysiteSetting');
			        $conditions = array('AgencysiteSetting.user_id'=>@$agency_logo['Business']['agency_id']);
			        $logo = $this->AgencysiteSetting->find('first',array('contain'=>false,'fields'=>array('AgencysiteSetting.agencylogo'),'conditions'=>$conditions));
			        $this->set('companylogo',@$logo['AgencysiteSetting']['agencylogo']);
			        $this->set('address',@$agency_logo);
                 }
	 }		     
	 else
	 {  
	 	echo "You are not authorized to access this location";die;

	 }    
      
	  
        
    }
    public function thanksToCustomer()
    {
        $customer_id = base64_decode(@$_GET['customer_id']);
        $business_id = base64_decode(@$_GET['business_id']);
        $business_review_id = base64_decode(@$_GET['business_review_id']);
    	if($customer_id && $business_id)
    	{	
		    	$this->layout = 'micro';
		    	$this->loadModel('Business');
		    	$this->loadModel('AgencysiteSetting');
		    	$this->loadModel('Customer');
		    	$this->loadModel('BusinessReview');
		    	$this->loadModel('Visibility');
		    	$sites=$this->Visibility->find('all',array('conditions'=>array('Visibility.business_id'=>$business_id,'Visibility.status'=>'visible','Visibility.pageurl !='=>'')));
		    	$this->set('sites',$sites);
		        $agency_logo = $this->Business->find('first',array('conditions'=>array('Business.id'=>@$business_id)));
		        $conditions = array('AgencysiteSetting.user_id'=>@$agency_logo['Business']['agency_id']);
					        $logo = $this->AgencysiteSetting->find('first',array('contain'=>false,'fields'=>array('AgencysiteSetting.agencylogo'),'conditions'=>$conditions));
			   $customer_name = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customer_id),'fields'=>array('Customer.firstname','Customer.lastname')));
			    $review_given = $this->BusinessReview->find('first',array('conditions'=>array('BusinessReview.id'=>$business_review_id),'fields'=>array('BusinessReview.ratingdescription')));
			    $this->set('companylogo',@$logo['AgencysiteSetting']['agencylogo']);
			    $this->set('address',@$agency_logo);
			    $this->set('customer_name',@$customer_name);
			    $this->set('review_given',@$review_given);
	   }
	   else{
	   	    echo "You are not authorized to access this location";die;
	   }	
    }
   public function thanksToNegativeCustomer() 
    {

        $customer_id = base64_decode(@$_GET['customer_id']);
        $business_id = base64_decode(@$_GET['business_id']);
        if(($customer_id && $business_id) || $this->request->is('post'))
    	{	
		        $this->layout = 'micro';
		    	$this->loadModel('Business');
		    	$this->loadModel('AgencysiteSetting');
		    	$this->loadModel('Customer');
		        
		        $agency_logo = $this->Business->find('first',array('conditions'=>array('Business.id'=>@$business_id)));
		        $conditions = array('AgencysiteSetting.user_id'=>@$agency_logo['Business']['agency_id']);
					        $logo = $this->AgencysiteSetting->find('first',array('contain'=>false,'fields'=>array('AgencysiteSetting.agencylogo'),'conditions'=>$conditions));
			   $customer_name = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customer_id),'fields'=>array('Customer.firstname','Customer.lastname')));
			    
			   		        
			    $this->set('companylogo',@$logo['AgencysiteSetting']['agencylogo']);
			    $this->set('address',@$agency_logo);
    		    $this->set('customer_name',@$customer_name);
    		    $this->set('customer_id',@$customer_id);
    		   
			       if($this->request->is('post'))
			       {
			       	$this->loadModel('Customer');
			       		if(!empty($this->data['Customer']['id']))
			       		{	
				    	   	if($this->Customer->save($this->data))
				       		{
				          	$this->Session->setFlash('Your Suggestion Shared with us We Strongly Consider your SUGGESTIONS.','success');
				       		}
				        }
				        else
				        {
				          echo "You are not authorized to access this location";die;	
				        }
			       }

      }
      else{
      	 echo "You are not authorized to access this location";die;
      }			    

 }	

}
?>
