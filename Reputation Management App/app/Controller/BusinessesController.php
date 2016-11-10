<?php
App::uses('AppController', 'Controller');
/**
 * Businesses Controller
 *
 * @property Business $Business
 * @property PaginatorComponent $Paginator
 */
class BusinessesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Business->recursive = 0;
		$this->set('businesses', $this->Paginator->paginate());
		$this->Business->find();
		
	}
	public function pdf()
	{
		 
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
            require(APP . 'Vendor' . DS  . 'dompdf' .DS . 'dompdf_config.inc.php');
           if (isset($_POST['htmlContent']) && $_POST['htmlContent'] != '')
			{
				$file_name = 'AgencyReport'."_".date('M').'-'.date('dy').".pdf";
			    $html = $_POST['htmlContent'];
			    $dompdf = new DOMPDF();
			    $dompdf->load_html($html);
			    $dompdf->render();
			    $dompdf->stream($file_name);
			     
			    
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
		
		if (!$this->Business->exists($id)) {
			throw new NotFoundException(__('Invalid business'));
		}
		$options = array('conditions' => array('Business.' . $this->Business->primaryKey => $id));
		$this->set('business', $this->Business->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($par=null) {
		$this->loadModel('SocialMedia');
		$this->loadModel('BusinessSocialMedia');
		//$socialmedia = $this->SocialMedia->find('list',array('fields'=>array('id','mediasitename')));
		$socialmedia = $this->SocialMedia->find('list',array('contain'=>false,'fields'=>array('id','mediasitename','accounttype'),'conditions'=>array('OR'=>array(array('SocialMedia.accounttype'=>'SocialSite'),array('SocialMedia.accounttype'=>'ReviewSite')),'SocialMedia.status'=>1)));	
		$mearge=array();
		foreach ($socialmedia['ReviewSite'] as $key => $value) {
			$mearge[$key]=$value;
		}
		foreach ($socialmedia['SocialSite'] as $key => $value) {
			$mearge[$key]=$value;
		}
		$socialmedia=$mearge;

		$searchlist = $this->SocialMedia->find('list',array('contain'=>false,'fields'=>array('id','mediasitename','accounttype'),'conditions'=>array('OR'=>array(array('SocialMedia.accounttype'=>'DirectoryListing'),array('SocialMedia.accounttype'=>'SearchEngine')),'SocialMedia.status'=>1)));
		$mergelist=array();
		foreach ($searchlist['DirectoryListing'] as $key => $value) {
			$mergelist[$key]=$value;
		}
		foreach ($searchlist['SearchEngine'] as $key => $value) {
			$mergelist[$key]=$value;
		}
		$searchlist=$mergelist;

		$this->set('searchlist', $searchlist);
		$this->set('socialmedia', $socialmedia);
		if ($this->request->is('post') && !$par) {
			$this->request->data['User']['usertype'] = 'subscriber';
			$this->loadModel('User');
			$this->User->create();
			if ($this->User->save($this->request->data['User'])) {
			    $this->request->data['Business']['user_Id'] =intval($this->User->getLastInsertId());
			    $this->request->data['Business']['business_category_id']=intval($this->request->data['Business']['business_category_id']);
			    $this->request->data['Business']['createdat']=Date('Y-m-d');
			    $this->request->data['Business']['agency_id']=$this->Session->read('Auth.User.id');
			  // pr($this->request->data);die;
			    $this->Business->create();
				if ($this->Business->save($this->request->data['Business'])) {
					$data = $this->request->data;
					$data['BusinessSocialMedia']['business_id']=$this->Business->getLastInsertId();
					//pr($data);die;
					for ($i=0; $i <count($data['Business']['Attendees']); $i++) { 
						$this->BusinessSocialMedia->create();
						$data['BusinessSocialMedia']['social_media_id'] = $data['Business']['Attendees'][$i];
						$data['BusinessSocialMedia']['checker_type'] = 'socialchecker';
						$this->BusinessSocialMedia->save($data);
					}

					for ($i=0; $i <count($data['Business']['visibilitychecker']); $i++) { 
						$this->BusinessSocialMedia->create();
						$data['BusinessSocialMedia']['social_media_id'] = $data['Business']['visibilitychecker'][$i];
						$data['BusinessSocialMedia']['checker_type'] = 'visibilitychecker';
						$this->BusinessSocialMedia->save($data);	
					}

					$this->Session->setFlash('The business has been saved.','success');
					return $this->redirect(array('controller'=>'dashboard','action' => 'manageUser'));
				} else {
					$this->Session->setFlash('The business could not be saved. Please, try again.','error');
				}
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.','error');
			}			
		}
		if($par && $par=='addnew'){
           $this->set('bname',$this->request->data['Business']['name']);
		}
		$this->loadModel('BusinessCategory');		
		$businessCategories = $this->BusinessCategory->find('list',array('order'=>array('BusinessCategory.name ASC'),'conditions'=>array('BusinessCategory.status'=>1)));
		
		$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
                $us = $countries[1];
			unset($countries[1]);
			$countries[1] = $us;
		$this->set(compact('businessCategories', 'countries'));
	}

	public function updateBusiness($id=null) {
		if($this->request->is('post')) {
				$this->loadModel('User');
				$this->loadModel('BusinessSocialMedia');
				if ($this->User->save($this->request->data['User'])) {
					$this->request->data['Business']['usertype'] = 'subscriber';
					
					if ($this->Business->save($this->request->data['Business'])) {
					$data = $this->request->data;
					$this->BusinessSocialMedia->deleteAll(array('BusinessSocialMedia.business_id'=>$data['Business']['id'],'BusinessSocialMedia.checker_type'=>'socialchecker'));
                   			$data['BusinessSocialMedia']['business_id']=$data['Business']['id'];
					for($i=0;$i<count(@$this->data['Business']['Attendees']);$i++) {
                     				$id = $data['Business']['Attendees'][$i];
						$this->BusinessSocialMedia->create();
               					$data['BusinessSocialMedia']['social_media_id'] = $data['Business']['Attendees'][$i];
						$data['BusinessSocialMedia']['checker_type'] = 'socialchecker';
						$this->BusinessSocialMedia->save($data);
					}

                   			$this->BusinessSocialMedia->deleteAll(array('BusinessSocialMedia.business_id'=>$data['Business']['id'],'BusinessSocialMedia.checker_type'=>'visibilitychecker'));
                   			for($i=0;$i<count(@$this->data['Business']['visibilitychecker']);$i++) {
                      				$id = $data['Business']['visibilitychecker'][$i];
						$this->BusinessSocialMedia->create();
			       			$data['BusinessSocialMedia']['social_media_id'] = $data['Business']['visibilitychecker'][$i];
						$data['BusinessSocialMedia']['checker_type'] = 'visibilitychecker';
						$this->BusinessSocialMedia->save($data);
                      		        }


						$this->Session->setFlash('The business has been saved.','success');
						return $this->redirect(array('controller'=>'dashboard','action' => 'manageUser'));
					} else {
						$this->Session->setFlash('The business could not be saved. Please, try again.','error');
					}
				} else {
					$this->Session->setFlash('The user could not be saved. Please, try again.','error');
				}			
			}
		else{
		    if(!$id){
			$this->redirect($this->referer());
		    }else{
		    	
				$data=$this->Business->findById(base64_decode($id));
				$this->loadModel('BusinessSocialMedia');		
				$Ids=$this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia'),'conditions'=>array('BusinessSocialMedia.business_id'=>base64_decode($id),'SocialMedia.status'=>1),'fields'=>array('social_media_id')));
				$selmediaIds=array();
				foreach ($Ids as $key => $value) {
					$selmediaIds[$key]=$value['BusinessSocialMedia']['social_media_id'];
				}
				//pr($selmediaIds);die;
				$this->set('selmediaIds',$selmediaIds);
				$this->set('data', $data);
				$this->loadModel('User');
				$userdata=$this->User->findById($data['Business']['user_Id']);
				$this->set('userdata', $userdata);
				$this->loadModel('SocialMedia');

				$socialmedia = $this->SocialMedia->find('list',array('contain'=>false,'fields'=>array('id','mediasitename','accounttype'),'conditions'=>array('OR'=>array(array('SocialMedia.accounttype'=>'SocialSite'),array('SocialMedia.accounttype'=>'ReviewSite')),'SocialMedia.status'=>1)));
				$mearge=array();
				foreach ($socialmedia['ReviewSite'] as $key => $value) {
					$mearge[$key]=$value;
				}
				foreach ($socialmedia['SocialSite'] as $key => $value) {
					$mearge[$key]=$value;
				}
				$socialmedia=$mearge;

				$searchlist = $this->SocialMedia->find('list',array('contain'=>false,'fields'=>array('id','mediasitename','accounttype'),'conditions'=>array('OR'=>array(array('SocialMedia.accounttype'=>'DirectoryListing'),array('SocialMedia.accounttype'=>'SearchEngine')),'SocialMedia.status'=>1)));
				$mergelist=array();
				foreach ($searchlist['DirectoryListing'] as $key => $value) {
					$mergelist[$key]=$value;
				}
				foreach ($searchlist['SearchEngine'] as $key => $value) {
					$mergelist[$key]=$value;
				}
				$searchlist=$mergelist;
				$this->set('searchlist', $searchlist);
				$this->set('socialmedia', $socialmedia);

				//$socialmedia = $this->SocialMedia->find('list',array('fields'=>array('id','mediasitename')));
				//$this->set('socialmedia', $socialmedia);
				#$parentBusinesses   = $this->Business->ParentBusiness->find('list',array('fields'=>array('id','businessname')));
				$this->loadModel('BusinessCategory');
				$businessCategories = $this->BusinessCategory->find('list',array('order'=>array('BusinessCategory.name asc'),'conditions'=>array('BusinessCategory.status'=>1)));
				$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
				$this->set(compact('businessCategories', 'countries'));
				$this->loadModel('State');
				$states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
				$this->set('states',$states);
				$this->loadModel('City');
				$cities= $this->City->find('list',array('fields'=>array('id','city_name'),'conditions'=>array('City.state_id'=>$data['State']['id']),'order'=>array('city_name ASC')));
				$this->set('cities',array_unique($cities));
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
		//die("fngkjdf");
		$this->Business->id = $id;
		if (!$this->Business->exists($id)) {
			throw new NotFoundException(__('Invalid business'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$user_Id = $this->request->data['Business']['user_Id'];

			if ($this->Business->save($this->request->data['Business'])) {

				$this->loadModel('User');
				$this->User->id = $user_Id;
				$this->User->save($this->request->data['User']);
				$this->Session->setFlash('The business has been saved.','success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The business could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Business.' . $this->Business->primaryKey => $id));
			$business = $this->Business->find('first', $options);
			$this->request->data['Business'] = $business['Business'];
			$user_Id = $this->request->data['Business']['user_Id'];
			$this->loadModel('User');
			$useroptions = array('conditions' => array('User.' . $this->User->primaryKey => $user_Id));
			$user = $this->User->find('first', $useroptions);
			$this->request->data['User'] = $user['User'];
		}

		$parentBusinesses = $this->Business->ParentBusiness->find('list');
		$businessCategories = $this->Business->BusinessCategory->find('list');
		$countries = $this->Business->Country->find('list', array('fields'=>array('id','country_name')));
		$states = $this->Business->State->find('list', array('fields'=>array('id','stateName')));
		$cities = $this->Business->City->find('list', array('fields'=>array('id','city_name')));
		$this->set(compact('parentBusinesses', 'businessCategories','countries', 'states', 'cities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Business->id = $id;
		$specificallyThisOne = $this->Business->find('first', array(
	        'conditions' => array('Business.id' => $id)
	 	));
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Business->delete()) {
	 	  	$user_Id = $specificallyThisOne['Business']['user_Id'];
			$this->loadModel('User');
			$this->User->id = $user_Id;
			$this->User->delete();
			$this->Session->setFlash('The business has been deleted.','success');
		} else {
			$this->Session->setFlash('The business could not be deleted. Please, try again.','error');
		}
		return $this->redirect(array('action' => 'index'));
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

    public function resetPassword($id=null)
    {	
    	if($this->request->is('post')){
    		$this->loadModel('User');
    		//pr($this->request->data['User']);die;
    		if($this->User->save($this->request->data['User'])){
                $this->Session->setFlash('Password has been reset successfully.','success');
                $this->redirect(array('controller'=>'dashboard','action'=>'manageUser'));
    		}else{
    			 $this->Session->setFlash('Unable to reset password.','error');
    			 $this->redirect(array('controller'=>'dashboard','action'=>'manageUser'));
    		}
		}else{
			if($id){
				$this->loadModel('User');
				$udata=$this->User->findById(base64_decode($id));
				//pr($udata);die(base64_decode($id));
				if(count($udata)>0){
					$this->set('udata',$udata);
				}else{
					$this->Session->setFlash('Invalid User Id.','error');
					 $this->redirect(array('controller'=>'dashboard','action'=>'manageUser'));
				}
			    
			}else{
			  $this->redirect($this->referer());
			}
		}
    }

    public function deleteBusiness($id=null,$uid=null){
    		if($id && $uid){
    			$id=base64_decode($id);
    			$uid=base64_decode($uid);
    			$data['Business']['id']=$id;
    			$data['Business']['is_deleted']=1;
    			// if($this->Business->delete($id)){
    			if($this->Business->save($data)){
    				//$this->loadModel('User');
    				//$this->User->delete($uid);
    				$this->Session->setFlash('Record delete successfully.','success');
					$this->redirect($this->referer());
    			}else{
    				$this->Session->setFlash('Unable to delete the record.','error');
					$this->redirect($this->referer());	
    			}
    		}else{
    			$this->Session->setFlash('Invalid Business Id.','error');
			    $this->redirect(array('controller'=>'dashboard','action'=>'manageUser'));
    		}
    }

   public function resendCredentail($uid=null){
    		if($uid){
    			$uid=base64_decode($uid);
    			$this->loadModel('User');
    			$udata=$this->User->findById($uid);
    			//pr($udata);die;
    			if(count($udata)>0){
    				$user=$udata['User']['email'];
    				//$user="mss.mohdali@gmail.com";
    				$pass=$this->RandomStringGenerator(); 
    				$from="support@repmgsys.com";
    				$email_template="Usernam=$user </br> Password=$pass";
    				$data['User']['id']=$uid;
    				$data['User']['password']=$pass;
				$subject = "Resend Credentail";
    				if($this->User->save($data)){
    					$this->sendEmail($email_template,$from,$user,$subject);
    					$this->Session->setFlash('Credential has been sent. Please check your email.','success');
						$this->redirect($this->referer());	
    				}else{
    					$this->Session->setFlash('Unable to send the user resendCredentail.','error');
						$this->redirect($this->referer());	
    				}
    			}else{
    				$this->Session->setFlash('Unable to send the user resendCredentail.','error');
					$this->redirect($this->referer());	
    			}
    		}else{
    			$this->Session->setFlash('Invalid User Id.','error');
			    $this->redirect(array('controller'=>'dashboard','action'=>'manageUser'));
    		}
    } 

    public function businessDashboard($id=null){

        $this->Session->delete('User'); 
       //$this->Cookie->delete('remember');        
        $this->redirect(array('controller'=>'users','action'=>'businessUserLogin'));

    	
    }

    public function report(){
    	if($this->Session->read('Auth.User.usertype')=='reseller'){
	    	$ratarr=array('1R','2R','3R','4R','5R');
	    	if($this->request->is('post') && $this->request->data['Business']['id']){
                        $this->set('business_report_id',$this->request->data['Business']['id']);
	    		$busIds=$this->Business->find('list',array('conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0,'Business.id'=>$this->request->data['Business']['id']),'fields'=>array('Business.id')));
	    		
	    		$this->set('selectedId',$this->request->data['Business']['id']);
	    		$this->loadModel('Customer');
		    	$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$this->request->data['Business']['id'])));
		    	$this->set('success',$successFeed);
		    	$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$this->request->data['Business']['id'])));
		    	$this->set('notFeed',$notFeed);
		    	$this->loadModel('BusinessReview');
		    	if(isset($this->request->data['searchForm']['search']) && $this->request->data['searchForm']['search']){
		    		$searhval=$this->request->data['searchForm']['search'];
		    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));
		    	$this->set('searchText',$searhval);	
		    	}elseif(isset($this->request->data['BusinessReview']['starrating']) && $this->request->data['BusinessReview']['starrating']){
		    		$rating=$this->request->data['BusinessReview']['starrating'];
		    		
		    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
		    		$this->set('rating',$rating);
		    	}else{

		    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
		    	}
		    	$this->set('customersReviews',$this->paginate('BusinessReview'));
	    	}else{
	    		
	    		$busIds=$this->Business->find('list',array('conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0),'fields'=>array('Business.id')));
	    		
	    		//pr($busIds);die;
	    		$this->set('selectedId',"");
	    		$this->loadModel('Customer');
		    	$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$busIds)));
		    	$this->set('success',$successFeed);
		    	$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$busIds)));
		    	$this->set('notFeed',$notFeed);

		    	$this->loadModel('BusinessReview');
		    	if(isset($this->request->data['searchForm']['search']) && $this->request->data['searchForm']['search']){
		    		$searhval=$this->request->data['searchForm']['search'];
                                $this->set('searchText',$searhval);
		    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));
		    	}elseif(isset($this->request->data['BusinessReview']['starrating']) && $this->request->data['BusinessReview']['starrating']){
		    		$rating=$this->request->data['BusinessReview']['starrating'];
		    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
		    		$this->set('rating',$rating);
		    	}else{
		    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
		    	}
		    	$this->set('customersReviews',$this->paginate('BusinessReview'));
		    	//pr($customersReviews);die;
	    	}
	    	$this->loadModel('BusinessReview');
	    	$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'Customer.status'=>$ratarr)));
	    	$this->set('onestar',$onestar);
	    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'Customer.status'=>$ratarr)));
	    	$this->set('twostar',$twostar);
	    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'Customer.status'=>$ratarr)));
	    	$this->set('threestar',$threestar);
	    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'Customer.status'=>$ratarr)));
	    	$this->set('fourstar',$fourstar);
	    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'Customer.status'=>$ratarr)));
	    	$this->set('fivestar',$fivestar);
	    	$allbusiness=$this->Business->find('all',array('contain'=>array('User'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0),'fields'=>array('Business.id','Business.businessname'),'order'=>array('Business.businessname'=>'ASC')));
	    	$this->set('allbusiness',$allbusiness);
	    }else{
	    	$this->Session->setFlash('You are not authorized user to access that location,','error');
	    	$this->redirect($this->referer());
	    }	
    }
public function exportReport($business_report_id = NULL)
    {
      
      if($this->request->is('post'))
  	         {    
  	         	  $ratarr=array('1R','2R','3R','4R','5R');
  	         	  $this->loadModel('BusinessReview');
  	              $this->loadModel('Business');
				  $this->layout = '';
		          $search_data = $this->data;
		          $conditions = array();
		          $busIds=$this->Business->find('list',array('conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0),'fields'=>array('Business.id')));
		          if(!empty($search_data['exportby']['all']) && $search_data['exportby']['all'] == 'allType')
		           {
		             if(empty($business_report_id))
		             { 
		             $conditions = array('BusinessReview.business_id'=>$busIds,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr); 
		             $search_data['exportby']['search'] = '';
		             }
		             else
		             {
                     $conditions = array('BusinessReview.business_id'=>$business_report_id,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr); 
		             $search_data['exportby']['search'] = '';
		             	
		             } 
		           
		           }
		           if(is_numeric($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		           {
		           	 if(empty($business_report_id))
		             { 
		             $conditions = array('BusinessReview.ratingstar' => $search_data['exportby']['search'],'BusinessReview.business_id'=>$busIds,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr);
		             $search_data['exportby']['search'] = '';
		             }
		             else
		             {
		             $conditions = array('BusinessReview.ratingstar' => $search_data['exportby']['search'],'BusinessReview.business_id'=>$business_report_id,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr);
		             $search_data['exportby']['search'] = '';	
		             }
		           }
          	    $this->loadModel('BusinessReview');
				$this->autoRender = false;
				$data = "Firstname,Lastname,Feedbackdate,Phonenumber,EmailId,Rating \n";
				ini_set("memory_limit",-1);
		        $result = $this->BusinessReview->find('all',array('contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>$conditions));
	       	 if(count($result) > 0 && !empty( $conditions ))
	          {
	          	foreach ($result as $rslt) {
                               $data .= $rslt['Customer']['firstname'].",";
				                $data .= $rslt['Customer']['lastname'].",";
				                 $data .= $rslt['BusinessReview']['ratingdate'].",";
				                  $data .= $rslt['Customer']['phonenumber'].",";
				                   $data .= $rslt['Customer']['email'].",";
				                    $data .= $rslt['BusinessReview']['ratingstar'].",";
				                     $data .="\n";
				             }                                  
				            header("Content-Type: application/csv");
				            header("Content-type: application/octet-stream");
				            $csv_filename = 'Agency_Reporting_Status'."_".date('M').date('dy').".csv";
				            header("Content-Disposition:attachment;filename=$csv_filename");
				            $fd = fopen ($csv_filename, "w");
				            fputs($fd,$data);
				            fclose($fd);
				            echo $data;
				            die();
				            $this->Session->setFlash('CSV file record has been downloaded please check your browser or folder..','success');
			                $this->redirect($this->referer());

	          }
	          else
	          {
		   	     $this->Session->setFlash('No data found on this catagory..','error');
	             $this->redirect($this->referer());
			  }

		           
	        }

    }

    public function customerView($id=null){
    	if($id){
    			$this->loadModel('BusinessReview');
    			$customer=$this->BusinessReview->find('first',array('contain'=>array('Customer'),'conditions'=>array('BusinessReview.id'=>$id)));
    			if($customer){
    				// pr($customer);die;
    				$this->set('customer',$customer);
		    	 }else{
		           $this->Session->setFlash('Invalid Cusomer Id.','error');
				   $this->redirect($this->referer());	
				 }   
    	}else{
           $this->Session->setFlash('Invalid Cusomer Id.','error');
		   $this->redirect($this->referer());	
    	}
    }
    public function customerBusView($id=null){
    	if($id){
    			$this->loadModel('BusinessReview');
    			$customer=$this->BusinessReview->find('first',array('contain'=>array('Customer'),'conditions'=>array('BusinessReview.id'=>$id)));
    			if($customer){
    				// pr($customer);die;
    				$this->set('customer',$customer);
		    	 }else{
		           $this->Session->setFlash('Invalid Cusomer Id.','error');
				   $this->redirect($this->referer());	
				 }   
    	}else{
           $this->Session->setFlash('Invalid Cusomer Id.','error');
		   $this->redirect($this->referer());	
    	}
    }


	public function setup($id=NULL){
			$uid=$this->routing();
			if($uid){
				$this->loadModel('BusinessCategory');
				if(!empty($this->data)){
					$data = $this->data; 
					$combined_array = array();
					foreach($data['to'] as $key=>$value)
					{
					    $combined_array[$key]=$value." => ".$data['from'][$key];
					}
					$bus_hour = json_encode($combined_array);
					$data['Business']['business_hours'] = $bus_hour;
					$dest='../webroot/img/';
					if(!empty($data['Business']['business_logo']['name'])){
						$file = $data['Business']['business_logo'];
						$image=$this->upload_image($dest,$file,'');
						$data['Business']['business_logo']=$image;
						
					}else{
						$data['Business']['business_logo'] = $data['Business']['business_logo1'];
					}
					if($this->Business->save($data)){
							$this->Session->setFlash('Data Saved Successfully.','success');
							$this->redirect($this->referer());
						}else{
						$this->Session->setFlash('data could not be saved. Please, try again.','error');
						$this->redirect($this->referer());
					}

				}
			}else{
		   	 	$this->Session->setFlash('You are not authorized to access that location.','error');
                if(isset($this->request->query['bussiness'])){
                	$qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
		   }
		}

	public function addemployee(){
		if(!empty($this->data)){
			$this->loadModel('User');
			$data = $this->data;
			$data['User']['usertype'] = 'employee';
			if($this->User->save($data)){
				$this->request->data['BusinessEmployee']['user_id']=$this->User->getLastInsertId();
				$this->request->data['BusinessEmployee']['emp_name']=$this->request->data['User']['firstname'].' '.$this->request->data['User']['lastname'];
				$this->request->data['BusinessEmployee']['created_at']=date('Y-m-d H:i:s');
				$this->request->data['BusinessEmployee']['business_id']=$this->request->data['Business']['id'];
				$this->loadModel('BusinessEmployee');
				if($this->BusinessEmployee->save($this->request->data['BusinessEmployee'])){
					$this->Session->setFlash('Employee has been added successfully.','success');
	 				$this->redirect($this->referer());
				}
			}
		}
	}

    
}
