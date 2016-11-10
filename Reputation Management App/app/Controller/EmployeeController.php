<?php 
App::uses('AppController', 'Controller');
class EmployeeController extends AppController {
	
	public $components = array('Paginator');
	function beforeFilter()
           {
                         parent::beforeFilter();
			$this->Auth->allow('postReview','thanksToCustomer','thanksToNegativeCustomer');   
             
           }
            public function pdf()
	{
     $usertype=$this->Session->read('Auth.User.usertype');   
      if($usertype == 'employee')
		   {	
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
	            require_once '../dompdf/dompdf_config.inc.php';
	            if (isset($_POST['htmlContent']) && $_POST['htmlContent'] != '')
				{
				    $file_name = 'BusinessCustomerReport.pdf';
				    $html = $_POST['htmlContent'];
				    $dompdf = new DOMPDF();
				    $dompdf->load_html($html);
				    $dompdf->render();
				    $dompdf->stream($file_name);
				     
				    
				}
			}	
		 else{
		 		$this->Session->setFlash('You are not authorized to access that location.','error');
				$this->redirect($this->referer());
		 }		

	}

    
   public function index()
	{
         $uid = $this->Session->read('Auth.User.id');
         $usertype=$this->Session->read('Auth.User.usertype');
         $this->loadModel('BusinessEmployee');
         $employee_id = $this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$uid),'fields'=>array('id')));
         $empID = $employee_id['BusinessEmployee']['id'];
         if($uid && $usertype == 'employee')
         {
         	$this->loadModel('Customer');
         	$this->paginate = array('limit'=>'15','conditions' => array('Customer.employee_id'=>$empID,'Customer.is_delete'=>0),'order' =>'Customer.id DESC');
           
           $this->set('businessuserreview',$this->paginate('Customer'));
           if($this->request->is('post'))
		   	{
		   		$name = trim(@$this->data['searchby']['text']);
			        if($name != '')
			        {  
			        				$this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'Customer.employee_id'=>$empID,'Customer.is_delete'=>0,'OR'=>array('Customer.firstname LIKE' => "%$name%",'Customer.lastname LIKE' => "%$name%",'Customer.email LIKE' => "%$name%")));	
								    $this->set('businessuserreview',$this->paginate('Customer'));
			      					$this->set('searchText',$name);
					}
					if(@$this->data['searchbystar'] != '')
					{
						foreach ($this->data['searchbystar'] as $key => $value) {
						 $rating = $value;
						}
									$this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'Customer.employee_id'=>$empID,'Customer.ratingstar'=>$rating,'Customer.is_delete'=>0));	
								    $this->set('businessuserreview',$this->paginate('Customer'));
			      					$this->set('rating',$rating);
					}
					if(@$this->data['advancesearch'] != '')
					{
						foreach (@$this->data['advancesearch'] as $key => $value) {
									 $ratingStatus = $value;
						 			 $this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'Customer.employee_id'=>$empID,'Customer.status'=>$ratingStatus,'Customer.is_delete'=>0,'Customer.ratingstar'=>NULL)); 
			      					$this->set('businessuserreview',$this->paginate('Customer'));
			      					$this->set('ratingStatus',$ratingStatus);
						}

					}

			} 
         }
         else
	        {
	        	$this->redirect($this->Auth->logout());
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
	public function employeeFeedback()
	{
		 $uid = $this->Session->read('Auth.User.id');
         $usertype=$this->Session->read('Auth.User.usertype');
         if($uid && $usertype == 'employee')
         {
          $this->loadModel('BusinessReview');	
          $this->loadModel('Customer');
          $this->loadModel('BusinessEmployee');
          
          $employee_id = $this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$uid),'fields'=>array('id')));
          $empID = $employee_id['BusinessEmployee']['id'];
          
          $customers = $this->Customer->find('all',array('contain'=>false,'fields'=>array('Customer.id'),'conditions'=>array('Customer.employee_id'=>$empID,'Customer.is_delete'=>0),'order' =>'Customer.id DESC'));
         $businessuserreview = array();
         foreach ($customers as $key => $value) 
         {

         $businessuserreview[] = $this->BusinessReview->find('first',array('conditions'=>array('BusinessReview.customer_id'=>$value['Customer']['id'])));
          }
 			 
          $this->set('reviews',@$businessuserreview);
      }
      else
	        {
	        	$this->redirect($this->Auth->logout());
	        }
	}
	public function editCustomer($customerid = null)
     {
         $uid = $this->Session->read('Auth.User.id');
         $usertype=$this->Session->read('Auth.User.usertype');
         if($uid && $usertype == 'employee')
         {

			    $this->loadModel('Customer');
			    $this->loadModel('State');
			    $this->loadModel('Country');
                $this->loadModel('City');  
			    $this->loadModel('Business');
				if($this->request->is('post')) 
				{  

				  unset($this->request->data['Customer']['employee_id']);	
	              if(@$this->request->data['Customer']['preview'] == 1){
	            	$this->request->data['Customer']['status'] = 'InFeedbackSequence';
	            	$this->request->data['Customer']['emailstatuscounter'] = 1;

	            }
	            else{
	                    $this->request->data['Customer']['status'] = 'NotInFeedbackSequence';
	            }		
	 

				if($this->Customer->save($this->request->data['Customer']))
				{
                      
                  $this->Session->setFlash('Customer has been Updated successfully','success');
						 
	             $this->redirect(array('controller'=>'Employee','action'=>'index'));
					 
				}
			}
		   	 $c_id = base64_decode($customerid);

		      $info = $this->Customer->find('first',array('conditions'=>array('Customer.id'=>$c_id),'contain'=>array('Country','State','City')));

		      
		       $this->set('info',$info);
		       $countries = $this->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
		       $states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
                        $cities= $this->City->find('list',array('fields'=>array('id','city_name'),'conditions'=>array('City.state_id'=>$info['State']['id']),'order'=>array('city_name ASC')));
                           $this->set('cities',array_unique($cities));
			   $this->set('countries',$countries); 
			   $this->set('states',$states); 
		 
	}
	 else
	        {
	        	$this->redirect($this->Auth->logout());
	        }

 }
	 

	public function deleteCustomer($customerid = null)
	{    
		  $uid = $this->Session->read('Auth.User.id');
         $usertype=$this->Session->read('Auth.User.usertype');
         if($uid && $usertype == 'employee')
         {
		     $c_id = base64_decode($customerid);
		     $this->loadModel('Customer');
			 $this->loadModel('BusinessReview');
			 $customer_business_id = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$c_id),'fields'=>array('Customer.business_id')));
			 $customers_businesss_id = $customer_business_id['Customer']['business_id'];
	         if($this->Customer->updateAll(array('Customer.is_delete' => 1),array('Customer.id'=>$c_id)))
			 {   
                    $this->BusinessReview->deleteAll(array('BusinessReview.customer_id' => $c_id,'BusinessReview.business_id'=>$customers_businesss_id), false);
			 		$this->Session->setFlash('Customer has been successfully Deleted','success');
					 
		    $this->redirect(array('controller'=>'Employee','action'=>'index'));
			 }
	   }
	   else
	   {
	        	$this->redirect($this->Auth->logout());
	    }

  } 
public function reporting(){
		   $usertype=$this->Session->read('Auth.User.usertype');
	       if($usertype=="employee"){
					$ratarr=array('1R','2R','3R','4R','5R');
		    		$this->loadModel('BusinessEmployee');
		    		$emp=$this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$this->Session->read('Auth.User.id'))));

		    		$this->loadModel('Business');
		    		$busIds=@$emp['Business']['id'];
		    		$this->loadModel('Customer');
			    	$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'])));
			    	
			    	$this->set('success',$successFeed);
			    	$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.employee_id'=>@$emp['BusinessEmployee']['id'])));
			    	$this->set('notFeed',$notFeed);
			    	$this->loadModel('BusinessReview');
			    	if(isset($this->request->data['searchForm']['search']) && $this->request->data['searchForm']['search']){
			    		$searhval=$this->request->data['searchForm']['search'];
			    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'],'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));
			    	}elseif(isset($this->request->data['BusinessReview']['starrating']) && $this->request->data['BusinessReview']['starrating']){
			    		$rating=$this->request->data['BusinessReview']['starrating'];
			    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>@$emp['BusinessEmployee']['id']));
			    		$this->set('rating',$rating);
			    	}else{
			    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>@$emp['BusinessEmployee']['id']));
			    	}
			    	// pr($this->paginate('BusinessReview'));die;
			    	$this->set('customersReviews',$this->paginate('BusinessReview'));
			    	$this->loadModel('BusinessReview');
			    	$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'],'Customer.status'=>$ratarr)));
			    	$this->set('onestar',$onestar);
			    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'],'Customer.status'=>$ratarr)));
			    	$this->set('twostar',$twostar);
			    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'],'Customer.status'=>$ratarr)));
			    	$this->set('threestar',$threestar);
			    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'],'Customer.status'=>$ratarr)));
			    	$this->set('fourstar',$fourstar);
			    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>@$emp['BusinessEmployee']['id'],'Customer.status'=>$ratarr)));
			    	$this->set('fivestar',$fivestar);

			    	$allbusinessemp=$this->Business->find('first',array('contain'=>array('BusinessEmployee'),'conditions'=>array('Business.user_Id'=>235,'Business.is_deleted'=>0)));
			   
			    	$this->set('allbusinessemp',$allbusinessemp);
		    	
	    	
	       }else{
	       		$this->Session->setFlash('You are not authorized user to access that location.','error');
	    		$this->redirect($this->referer());
	       }
	
}
public function exportReport()
{
	   $usertype=$this->Session->read('Auth.User.usertype');
	   if($usertype=="employee")
	   {
	   	 if($this->request->is('post'))
  	         {    
         	 	  $this->loadModel('BusinessEmployee');

   	 			  $emp=$this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$this->Session->read('Auth.User.id'))));
 				  $busIds=@$emp['BusinessEmployee']['business_id'];
				  $this->layout = '';
		          $search_data = $this->data;
		          $conditions = array();
		          if(!empty($search_data['exportby']['all']) && $search_data['exportby']['all'] == 'allType')
		           {
		            $conditions = array('BusinessReview.business_id'=>$busIds,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.user_id'=>$this->Session->read('Auth.User.id')); 
		            $search_data['exportby']['search'] = ''; 
		           }
		           if(is_numeric($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		           {
		             $conditions = array('BusinessReview.ratingstar' => $search_data['exportby']['search'],'BusinessReview.business_id'=>$busIds,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.user_id'=>$this->Session->read('Auth.User.id'));
		             $search_data['exportby']['search'] = '';
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
				            $csv_filename = 'Employee_Reporting_Status'."_".date('M').date('dy').".csv";
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
	   else
	   {
	    $this->Session->setFlash('You are not authorized user to access that location.','error');
		$this->redirect($this->referer());
		}
		

}
public function notification()
{
 	$uid = $this->Session->read('Auth.User.id');
 	$usertype=$this->Session->read('Auth.User.usertype');
	 		if($uid && $usertype == 'employee')
	        { 
	        	 $this->loadModel('BusinessEmployee');
	        	 $emp=$this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$uid)));
	        	// pr($emp);die;
	        	 if(isset($emp['Business']['feedbackthreshold'])){
	        	 	$threshold=$emp['Business']['feedbackthreshold'];
	        	 }else{
	        	 	$threshold=0;
	        	 }
	             $this->loadModel('Customer');
	             $this->paginate = array('recursive'=>-1,'limit'=>'15','conditions' => array('Customer.user_id'=>$uid,'Customer.is_delete'=>0,'Customer.ratingstar <='=>$threshold),'order' =>'Customer.id DESC');
	            $this->set('businessuserreview',$this->paginate('Customer'));
	            if($this->request->is('post'))
	            {
	            	 $searchText = $this->data['searchby']['text'];
	                 if(!empty($searchText))
	                 {
	                 	$conditions = array('Customer.user_id'=>$uid,'Customer.ratingstar <='=>$threshold,'Customer.is_delete'=>0,'OR'=>array('Customer.firstname LIKE'=>"%$searchText%",'Customer.lastname LIKE'=>"%$searchText%",'Customer.email LIKE'=>"%$searchText%"));
	                 				$this->paginate = array('recursive'=>-1,'limit'=>'15',
								    'conditions' => $conditions);
								 	$this->set('businessuserreview',$this->paginate('Customer'));
								 	$this->set('searchText',$searchText);

	                 }
	            }
            }
            else
            {
	        	$this->redirect($this->Auth->logout());
	        }
}
	public function reEmailToCustomer($customerid = null)
	{
		$uid = $this->Session->read('Auth.User.id');
 	    $usertype = $this->Session->read('Auth.User.usertype');
	 		if($uid && $usertype == 'employee')
	        {
	        $customer_id = base64_decode($customerid);	
	        $this->loadModel('BusinessEmployee');
           	$this->loadModel('Customer');
           	$conditions = array('BusinessEmployee.id'=>$uid);
           	$businessEmployeeInfo = $this->BusinessEmployee->find('first',array('conditions'=>$conditions,'recursive'=>-1));
           	$todaydate = date("Y-m-d");
           	$customerEmail = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customer_id),'fields'=>array('Customer.email','Customer.firstname','Customer.lastname')));
           	$email = $customerEmail['Customer']['email'];
           	$name = $customerEmail['Customer']['firstname']. ' '.$customerEmail['Customer']['lastname'];
           	if(!empty($customerEmail))
           	{
           		$url=Router::url('/dashboard/postReview?id='.base64_encode($businessEmployeeInfo['BusinessEmployee']['user_id']).'&customer_id='.base64_encode($customer_id), true);
						$content="<table>
						           <tr>
						           <td>Dear $name,</td></tr>
						           <tr><td>Thank You for allowing to serve you.</td></tr>
	                    		   <tr><td>Wr are constantly strivig to deleiver an outstanding experience for our customers and would value your feedback about your recent experience </td></tr>
	                    		   <tr><td>Would you be willing to take 15 seconds to tell us about your experience ? if so,please click this link</td></tr>
	                    		   <tr><td><a href=$url>Click here to Complete your Review.</a></td></tr>
						           <tr><td>Thank You.</td></tr>
						           </table>";
				       $subject='Add Customer';	
				        $this->sendEmail($content,"support@repmgsys.com",$email,'ADD CUSTOMER');
	                   $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
				       $this->Session->setFlash('An Email Has been Sent to Customer successFully.','success');
					   $this->redirect(array('controller'=>'Employee','action'=>'notification')); 

           	}

	        }
	        else
	        {
	        	$this->redirect($this->Auth->logout());
	        }	

	}
public function addCustomer()
{
 $uid = $this->Session->read('Auth.User.id');
  
 $usertype=$this->Session->read('Auth.User.usertype');
 if($uid && $usertype == 'employee')
 { 
 	if($this->request->is('post'))
 	{
           	$this->loadModel('BusinessEmployee');
           	$this->loadModel('Customer');
           	$conditions = array('BusinessEmployee.user_id'=>$uid);
           	$businessEmployeeInfo = $this->BusinessEmployee->find('first',array('conditions'=>$conditions,'recursive'=>-1));
                
	        $this->request->data['Customer']['business_id'] = $businessEmployeeInfo['BusinessEmployee']['business_id'];
			$this->request->data['Customer']['user_id'] = $businessEmployeeInfo['BusinessEmployee']['user_id'];
			$this->request->data['Customer']['employee_id'] = $businessEmployeeInfo['BusinessEmployee']['id'];
	        if(@$this->request->data['Customer']['preview'] == 1)
            {
            	$this->request->data['Customer']['status'] = 'InFeedbackSequence';
            	$this->request->data['Customer']['emailstatuscounter'] = 1;

            }
            else
            {
                $this->request->data['Customer']['status'] = 'NotInFeedbackSequence';
            }
           // pr($this->request->data['Customer']);die;
			if($this->Customer->save($this->request->data['Customer']));
			{ 
				$todaydate = date("Y-m-d");
                $customer_id = $this->Customer->getLastInsertId();
                if($this->request->data['Customer']['preview'] == 1)
				{       
						$email = $this->request->data['Customer']['email'];
						$name = $this->request->data['Customer']['firstname']. ' '. $this->request->data['Customer']['lastname'];
						$url=Router::url('/Employee/postReview?id='.base64_encode($businessEmployeeInfo['BusinessEmployee']['user_id']).'&customer_id='.base64_encode($customer_id), true);
					$eTemplate=$this->getEmailcontent($businessEmployeeInfo['BusinessEmployee']['business_id'],1);
                    $replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$reviewurl'=>$url);
                    $sendername=@$eTemplate['sendername'];
					$sendemail=@$eTemplate['senderemail'];
					$content=$eTemplate['emailcontent'];	
					$subject=@$eTemplate['emailsubject'];
					$receiveremail=$email;
			        $this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
	                   $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
				       $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
					   $this->redirect(array('controller'=>'Employee','action'=>'index'));     
                 }
				else
				{
	                $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));	
					$this->Session->setFlash('Customer has been successfully Added','success');
					$this->redirect(array('controller'=>'Employee','action'=>'index'));
			   }
			}
     	}
	 	else
	 	{
	 		$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
            $us = $countries[1];
			unset($countries[1]);
			$countries[1] = $us;
	 	$this->set('countries',$countries); 
 	   }
  }
else
{
	$this->redirect($this->Auth->logout());
}	
}
 function checkEmail_user()
	{ 
	    $uid = $this->Session->read('Auth.User.id');
	    $this->loadModel('Customer');
        $email = trim($_REQUEST['data']['Customer']['email']);
        $this->autoRender = false;
		$count = $this->Customer->find('count',array('conditions'=>array('Customer.email'=>$email,'Customer.user_id'=>$uid,'Customer.is_delete'=>0)));
		if($count > 0)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
		

	}
public function export() 
{	
 $uid = $this->Session->read('Auth.User.id');
 $usertype=$this->Session->read('Auth.User.usertype');
 if($uid && $usertype == 'employee')
 {  
       	if($this->request->is('post')){
       		      $this->loadModel('BusinessEmployee');
       		      $empInfo = $this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$uid),'fields'=>array('BusinessEmployee.id')));
       		      $user_log_id = $empInfo['BusinessEmployee']['id'];	
       		      $this->layout = '';
		          $search_data = $this->data;
		          $conditions = array();
		           if(!empty($search_data['exportby']['all']) && $search_data['exportby']['all'] == 'allType')
		           {
		            $conditions = array('Customer.employee_id'=>$user_log_id,'Customer.is_delete'=>0); 
		            $search_data['exportby']['search'] = ''; 
		           }
		           if(is_numeric($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		           {
		             $conditions = array('Customer.ratingstar' => $search_data['exportby']['search'],'Customer.employee_id'=>$user_log_id,'Customer.is_delete'=>0);
		             $search_data['exportby']['search'] = '';
		           }
		           if(isset($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		           {
		           	$conditions = array('Customer.status' => $search_data['exportby']['search'],'Customer.employee_id'=>$user_log_id,'Customer.is_delete'=>0,'Customer.ratingstar'=>NULL);  
		           }
		        }
				$this->loadModel('Customer');
				$this->autoRender = false;
				$data = "Firstname,Lastname,Email,Phonenumber,Status,Addressline1,Addressline2,City,State,Country,ZipCode,Notes \n";
				ini_set("memory_limit",-1);
		        $result = $this->Customer->find('all',array('order' =>'Customer.id DESC','contain'=>array('Country'=>array('fields'=>array('country_name')),'State'=>array('fields'=>array('stateName'))),'conditions'=>$conditions,'fields'=>array('firstname','lastname','email','phonenumber','status','addressline1','addressline2','zip','notes','ratingstar','country_id','state_id','city_id')));
                if(count($result) > 0 && !empty( $conditions ))
		          {
				          foreach ($result as $rslt) {
                                                  if(in_array($rslt['Customer']['ratingstar'], array('1','2','3','4','5')))
                          {
                          	$rslt['Customer']['status'] = $rslt['Customer']['ratingstar'].'R';
                          }
				           	    $data .= $rslt['Customer']['firstname'].",";
				                 $data .= $rslt['Customer']['lastname'].",";
				                  $data .= $rslt['Customer']['email'].",";
				                   $data .= $rslt['Customer']['phonenumber'].",";
				                    $data .= $rslt['Customer']['status'].",";
				                     $data .= $rslt['Customer']['addressline1'].",";
				                      $data .= $rslt['Customer']['addressline2'].",";
				                       $data .= $rslt['Customer']['city_id'].",";
				                        $data .= $rslt['State']['stateName'].",";
				                         $data .= $rslt['Country']['country_name'].",";
                                          $data .= $rslt['Customer']['zip'].",";
				                           $data .= $rslt['Customer']['notes'].",";
				                            $data .="\n";
				             }                                  
				            header("Content-Type: application/csv");
				            header("Content-type: application/octet-stream");
				            $csv_filename = 'Employees_contact_list'."_".date('M').date('dy').".csv";
				            header("Content-Disposition:attachment;filename=$csv_filename");
				            $fd = fopen ($csv_filename, "w");
				            fputs($fd,$data);
				            fclose($fd);
				            echo $data;
				            die();
				            $this->Session->setFlash('CSV file record has been downloaded please check your browser or folder..','success');
			                $this->redirect($this->referer());
				            
				   }
				   else{
				   	     $this->Session->setFlash('No data found on this catagory..','error');
			             $this->redirect($this->referer());
				   }
			             
}
else
{
	$this->redirect($this->Auth->logout());
}

} 
		 public function importcsv()
		{
		$uid = $this->Session->read('Auth.User.id');
		$usertype=$this->Session->read('Auth.User.usertype');
		if($uid && $usertype == 'employee')
		{ 
		     $this->loadModel('Customer');
		  	 $this->loadModel('Buiseness');
		     $this->loadModel('BusinessReview');
		     $this->loadModel('Country');
		 	 $this->loadModel('State');
		     $this->layout = '';
		  	 $this->autoRender=false;
		  	 $sucess_result = 0;
		  	 if($this->request->is('post'))
			 { 
			 $this->loadModel('BusinessEmployee');	
			 $conditions = array('BusinessEmployee.user_id'=>$uid);
		   	 $businessEmployeeInfo = $this->BusinessEmployee->find('first',array('conditions'=>$conditions,'recursive'=>-1));	
		     $business_id = $businessEmployeeInfo['BusinessEmployee']['business_id'];
			        if ($_FILES['csv']['size'] > 0) 
		  			{      
		  				    $file = $_FILES['csv']['tmp_name'];
							$handle = fopen($file,"r");
							$data = fgetcsv($handle,1000,",","'");
							$c = 0;
					        while ($row = fgetcsv($handle, 1024)) 
					        {
					        $data[$c] = $row;
						     $c++;
						    }
					     unset($data[0]);
					     $data=array_values($data);
					    for($j=0;$j<=count($data);$j++)
			    		{
			    		if(!empty($data[$j]))
			    			{
			    		    if(@$data[$j][0] && @$data[$j][2] && @$data[$j][4]) 
			                { 		
			                    $this->Customer->create();
					    		$info['Customer']['firstname']=@$data[$j][0];
					    		$info['Customer']['lastname']=@$data[$j][1];
					    		$info['Customer']['email']=@$data[$j][2];
					    		$info['Customer']['phonenumber']=@$data[$j][3];
					    		$info['Customer']['status']=@$data[$j][4];
					    		$info['Customer']['addressline1']=@$data[$j][5];
					    		$info['Customer']['addressline2']=@$data[$j][6];
					    		$info['Customer']['city_id']=@$data[$j][7];
					    		$info['Customer']['state_id']=@$data[$j][8];
					    		if(!empty($info['Customer']['state_id']))
								{
						 				$conditions = array('State.stateName'=>$info['Customer']['state_id']);
				        			    $state_id = $this->State->find('first',array('conditions'=>$conditions,'recursive'=>-1));
							             if(empty($state_id))
							             {
							              $info['Customer']['state_id'] = '';	
							             }	
							             else
							             {	
							             $state_id = $state_id['State']['id'];
							             $info['Customer']['state_id'] = $state_id;
							             }  
								}
		                        $info['Customer']['country_id']=@$data[$j][9];
		                        if(!empty($info['Customer']['country_id']))
								{
				     					$conditions = array('Country.country_name'=>$info['Customer']['country_id']);
				         				$country_id = $this->Country->find('first',array('conditions'=>$conditions,'recursive'=>-1));
							             if(empty($country_id))
							             {
							             $info['Customer']['country_id'] = '';	
							             }	
							             else
							             {	
							             $country_id = $country_id['Country']['id'];
							             $info['Customer']['country_id'] = $country_id;
							             }   
					    		}  
					            $info['Customer']['zip']=@$data[$j][10];
					    		$info['Customer']['notes']=@$data[$j][11];
					    		$info['Customer']['user_id'] = $businessEmployeeInfo['BusinessEmployee']['user_id'];
					    		$info['Customer']['business_id'] = @$business_id;
			                    $info['Customer']['employee_id'] = @$businessEmployeeInfo['BusinessEmployee']['id']; 
			                    $customer_email_status = @$info['Customer']['status']; 
			                    if($this->Customer->save($info))
				    			{
			    					++$sucess_result;
			                        if(in_array($info['Customer']['status'], array('1R','2R','3R','4R','5R')))
					    			{
				                        $data1['BusinessReview']['customer_id'] = $this->Customer->getLastInsertId();
						    			$data1['BusinessReview']['business_id'] = @$business_id;
						    			$data1['BusinessReview']['user_id'] = $businessEmployeeInfo['BusinessEmployee']['user_id'];
						    		    $ratingstr = explode('R',$info['Customer']['status']);
				                        $data1['BusinessReview']['ratingstar'] = $ratingstr[0];
				                        $data1['BusinessReview']['authorization'] = 1;
				                        $data1['BusinessReview']['confirmation'] = 1;
				                        $data1['BusinessReview']['ratingdate'] = date("Y-m-d");
				                        $this->BusinessReview->create();
				                        $this->BusinessReview->save($data1);
			                        }
		                      	}
					    	   else
						    	 { 
					    	 	continue; 
						    	 }
							}else {
								 continue;
							}
						}
					}
		 		} 

		            if($sucess_result>0)
		             {

				 		$this->Session->setFlash('Contact uploaded successfully.','success');
				        $this->redirect($this->referer());
				 		
		             }else
		             {
		              $this->Session->setFlash('Invalid CSV format.','error');
		              $this->redirect($this->referer());
				 	}
		    	}
		    }
			else
			{
			$this->redirect($this->Auth->logout());
			}
		}
public function startfeedback()
   {
   	$uid = $this->Session->read('Auth.User.id');
   $usertype=$this->Session->read('Auth.User.usertype');
  if($uid && $usertype == 'employee')
  { 
   	 $this->autoRender=false;
   	 $todaydate = date("Y-m-d");
   	 $this->loadModel('Customer');
        if ($this->request->is('Ajax'))
        {   
        	$customerid = $this->data['id'];
            $emils = count($customerid);
        	$success_rate = 0;
        	$customerid = array_unique($customerid);
            $user_id = $this->Session->read('Auth.User.id');
            $this->loadModel('BusinessEmployee');	
		    $conditions = array('BusinessEmployee.user_id'=>$uid);
   	 	    $businessEmployeeInfo = $this->BusinessEmployee->find('first',array('conditions'=>$conditions,'recursive'=>-1));

            for($i = 0;$i < count($customerid);$i++)
        	{
        		 $customer_data = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customerid[$i],'Customer.status'=>'NotInFeedbackSequence'),'fields'=>array('Customer.email','Customer.firstname','Customer.lastname')));
        		  
        		  if(!empty($customer_data))

        		 {

        		 	$email = $customer_data['Customer']['email'];
                                     
					$name = $customer_data['Customer']['firstname']. ' '. $customer_data['Customer']['lastname'];
					$url=Router::url('/dashboard/postReview?id='.base64_encode($businessEmployeeInfo['BusinessEmployee']['user_id']).'&customer_id='.base64_encode($customerid[$i]),true);
				 
$content=$this->getEmailcontent($businessEmployeeInfo['BusinessEmployee']['business_id'],1);
						    $replace=array('{{cusotmername}}'=>$name,'{{reviewurl}}'=>$url);
							$content=strtr($content, $replace);	
					           $this->sendEmail($content,"support@repmgsys.com",$email,'REVIEWS LINKS');
					           ++$success_rate;
					           $this->Customer->updateAll(array('Customer.status' => '"InFeedbackSequence"','Customer.emailstatuscounter'=>'Customer.emailstatuscounter + 1','Customer.cronssentemaildate'=>"'$todaydate'",'Customer.permission_to_email'=>1,'Customer.preview'=>1),array('Customer.id' => $customerid[$i]));

					            
                  }
					  
                 else
        		 {
        		 	continue;
        		 }
            }
            if($success_rate > 0)
            {
            $this->Session->setFlash('Email has been successfully Deliverd','success');
            die;  
             } else
		      {
           	$this->Session->setFlash('Email Could not be sent Please check the Status of Customer.','error');
           	$this->Session->write('email',$emils);
            die; 
           } 
           }
   }
   else
   {
	$this->redirect($this->Auth->logout());
   }
}

 public function feedBackSeeMore(){
	     $uid = $this->Session->read('Auth.User.id');
         $usertype=$this->Session->read('Auth.User.usertype');
         if($uid && $usertype == 'employee'){
          $this->loadModel('BusinessReview');	
          $this->loadModel('Customer');
         
          $employee_id = $this->BusinessEmployee->find('first',array('conditions'=>array('BusinessEmployee.user_id'=>$uid),'fields'=>array('id')));
          $empID = $employee_id['BusinessEmployee']['id'];
          
           $this->paginate = array('limit'=>'15',
           							'contain'=>array('BusinessReview','Business'),	
								    'conditions'=>array('Customer.employee_id'=>$empID,'Customer.is_delete'=>0),
								    'order' =>'Customer.id DESC');
          // pr($this->paginate('Customer'));die;
		   $this->set('reviews',$this->paginate('Customer'));
      	}else{
			$this->redirect($this->Auth->logout());
     	}
   }

   function customerView($id=null){
    	if($this->Session->read('Auth.User.usertype')=="employee"){
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

  public function postReview()
    {   
   
        if( ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty (base64_decode (@$_GET['id'] ) ) ) || $this->request->is('post') )
        { 
				        $this->layout = 'micro';
				    	$this->loadModel('Business');
				    	$this->loadModel('BusinessReview');
				    	$this->loadModel('Customer');
				    	$this->loadModel('User');
				    	$this->loadModel('BusinessEmployee');
		    	if($this->request->is('post'))
		    	{
		    			$customer=$this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$this->request->data['BusinessReview']['customer_id'])));
				        $employee=$this->BusinessEmployee->find('first',array('contain'=>false,'conditions'=>array('BusinessEmployee.id'=>$customer['Customer']['employee_id']))); 
				    	$busiess_id = $this->Business->find('first',array('conditions'=>array('Business.id'=> $employee['BusinessEmployee']['business_id']),'fields'=>array('Business.id','Business.feedbackthreshold','Business.businessname'),'recursive'=>'-1')); 
				    	$threshold = $busiess_id['Business']['feedbackthreshold']; 
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
							 
				                   	$eTemplate=$this->getEmailcontent($business_id,3);
									$replace=array('$cusotmername'=>@$name,'$customeremail'=>@$email,'$business_name'=>@$business_name,'$business_email'=>@$admin_email);
									$sendername=@$eTemplate['sendername'];
									$sendemail=@$eTemplate['senderemail'];
									$content=$eTemplate['emailcontent'];	
									$subject=@$eTemplate['emailsubject'];
									$receiveremail=$email;
									if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):          
										$eTemplate=$this->getEmailcontent($business_id,5);
											$replace=array('$cusotmername'=>@$name,'$customeremail'=>@$email,'$business_name'=>@$business_name,'$business_email'=>@$admin_email);
											$sendername=@$eTemplate['sendername'];
											$sendemail=@$eTemplate['senderemail'];
											$content=$eTemplate['emailcontent'];	
											$subject=@$eTemplate['emailsubject'];
											$receiveremail=$admin_email;
											$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
											$this->Session->setFlash('Your reviews has been shared with us','success');
                      						$this->redirect(array('controller'=>'Employee','action'=>'thanksToCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id),'business_review_id'=>base64_encode($business_review_id))));
				                    endif;
							   			}else
				                       {
				                       
									 
				                    $eTemplate=$this->getEmailcontent($business_id,4);
									$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$admin_email);
									$sendername=@$eTemplate['sendername'];
									$sendemail=@$eTemplate['senderemail'];
									$content=$eTemplate['emailcontent'];	
									$subject=@$eTemplate['emailsubject'];
									$receiveremail=$email;
									if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
										$eTemplate=$this->getEmailcontent($business_id,6);
										$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$admin_email);
										$sendername=@$eTemplate['sendername'];
										$sendemail=@$eTemplate['senderemail'];
										$content=$eTemplate['emailcontent'];	
										$subject=@$eTemplate['emailsubject'];
										$receiveremail=$admin_email;
										$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);

						         	    		$this->redirect(array('controller'=>'Employee','action'=>'thanksToNegativeCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id)))); 
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
                  
                    $customer=$this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customer_id)));
				    $employee=$this->BusinessEmployee->find('first',array('contain'=>false,'conditions'=>array('BusinessEmployee.id'=>$customer['Customer']['employee_id'])));  
				              
			        $agency_logo = $this->Business->find('first',array('conditions'=>array('Business.id'=>$employee['BusinessEmployee']['business_id'])));
                               
                    $cnt = $this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>@$agency_logo['Business']['id'],'BusinessReview.customer_id'=>$customer_id)));

                    if($cnt > 0)
                    {
                    	 
                    	$this->Session->setFlash('You already gave the Reviews..','success');
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
    		    //$this->set('business_id',@$business_id);

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
