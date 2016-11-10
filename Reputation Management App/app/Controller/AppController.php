<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
	//echo Inflector::pluralize('business');die;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
		public $components = array('Session','Email','Cookie',
	    'Auth' => array(
		'authenticate' => array(
		    'Form' => array(
		        'fields' => array('username' => 'email'),
		        'scope' => array('User.status' => 1)
		    )
		)
	    )
	);
	
	var $helpers = array('Html', 'Form', 'Session','SubString');
	function beforeFilter() {
	

		 	$userRole = $this->Session->read('Auth.User.usertype'); 	
		      if($userRole == 'reseller' || $userRole == 'subscriber' || $userRole == 'employee')
		      {
			$this->loadModel('User');
			$cnd = array('User.id'=>$this->Session->read('Auth.User.id'));
		      	$loginUserStatus = $this->User->find('first',array('conditions'=>$cnd,'fields'=>array('User.status'),'recursive'=> -1));

		      	if($loginUserStatus['User']['status'] == 0)
		      	{
		      	$this->Session->setFlash('Your status has been disabled by Admin Please Contact your Admin.');
		      	return $this->redirect($this->Auth->logout());
			}
		      }

      	if($this->Session->read('Auth.User.usertype')=="employee" && $this->params['controller']!="Employee"){
              	if($this->params['controller']!='admin' && $this->params['action']!='postReview' && $this->params['action']!='thanksToCustomer' && $this->params['action']!='thanksToNegativeCustomer'){
					$this->redirect(array('controller'=>'Employee','action'=>'employeeFeedback'));
              	}
		}
		if($this->Session->read('Auth.User.usertype')=="admin" && $this->params['controller']!="admin"){
			if($this->params['controller']!='Employee' && $this->params['action']!='postReview' && $this->params['action']!='thanksToCustomer' && $this->params['action']!='thanksToNegativeCustomer'){
				$this->redirect(array('controller'=>'admin','action'=>'index'));
			}
		}
		$this->loadModel('Business');
                $this->loadModel('Onlinereview');
                 $this->loadModel('AgencysiteSetting');
		$flag=false;
		if($this->Session->read('Auth.User.usertype')=='reseller'){
                $this->loadModel('AgencysiteSetting');
                $agency_name = $this->AgencysiteSetting->find('first',array('fields'=>array('AgencysiteSetting.agencyname'),'conditions'=>array('AgencysiteSetting.user_id'=>$this->Session->read('Auth.User.id')),'recursive'=>-1));
            $this->set('agency_name',@$agency_name['AgencysiteSetting']['agencyname']);
             

			if(isset($this->request->query['bussiness']) && $this->request->query['bussiness']){
				//pr($this->request->query['bussiness']);die;
				$busId=base64_decode($this->request->query['bussiness']);
				$qrystr='?bussiness='.$this->request->query['bussiness'];
				$this->set('busid',$qrystr);
				//check existence of business
				$buscount=$this->Business->find('count',array('conditions'=>array('Business.id'=>$busId)));
				if($buscount>0){
					$businessesdata=$this->Business->find('first',array('contain'=>false,'fields'=>array('Business.id','Business.user_Id','Business.businessname','Business.agency_id','Business.totalReviews','Business.averageRating','Business.onestarCount','Business.twostarCount','Business.threestarCount','Business.fourstarCount','Business.fivestarCount'),'conditions'=>array('Business.id'=>$busId)));
					$this->set('businessesdata',$businessesdata);	
					$flag=true;
				}else{
					$this->Session->setFlash('Business does not exist.');
					$this->redirect($this->referer());
				}
			}

			if(!$flag){
				$businessesdata=$this->Business->find('all',array('contain'=>array('User'),'order'=>array('Business.id'=>'DESC'),'fields'=>array('Business.id','Business.businessname','Business.totalReviews','Business.lastReviewdate','Business.averageRating'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0, 'Business.totalReviews !='=>0)));
				$this->set('businessesdata',$businessesdata);	
			}
			$siteSetting = $this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>$this->Session->read('Auth.User.id'))));
          $this->set('design',$siteSetting);
			
		}else{
			$busid="";
			$this->set('busid',$busid);
		}
		if($this->Session->read('Auth.User.usertype')=='subscriber'){
			$businessesdata=$this->Business->find('first',array('contain'=>array('User'),'fields'=>array('Business.id','Business.user_Id','Business.businessname','Business.agency_id','Business.totalReviews','Business.averageRating','Business.onestarCount','Business.twostarCount','Business.threestarCount','Business.fourstarCount','Business.fivestarCount'),'conditions'=>array('Business.user_Id'=>$this->Session->read('Auth.User.id'))));
			$this->set('businessesdata',$businessesdata);	
			$siteSetting = $this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>$businessesdata['Business']['agency_id'])));
            //pr($siteSetting);die;
            $this->set('agency_name',@$siteSetting['AgencysiteSetting']['agencyname']); 
            $this->set('design',$siteSetting);     
        
		}
	
        $usertype = $this->Session->read('Auth.User.usertype');
        $controller=$this->params['controller'];
		$action=$this->params['action'];
        if($this->Session->read('Auth.User.usertype')=='employee')
		{
			$employee_session_id = $this->Session->read('Auth.User.id');
                          $employeeName = $this->Session->read('Auth.User.firstname').','.$this->Session->read('Auth.User.lastname');
			$this->set('EmployeeName',@$employeeName); 
		    $this->loadModel('BusinessEmployee');
			$this->loadModel('Business');
			$this->loadModel('AgencysiteSetting');
			$conditions = array('BusinessEmployee.user_id'=>$employee_session_id);
			$employees_business_id = $this->BusinessEmployee->find('first',array('contain'=>false,'conditions'=>$conditions,'fields'=>array('BusinessEmployee.business_id')));
			$conditions = array('Business.id'=>@$employees_business_id['BusinessEmployee']['business_id']);
			$employee_business_agency_id = $this->Business->find('first',array('contain'=>false,'conditions'=>$conditions,'fields'=>array('Business.agency_id')));
			$siteSetting = $this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>@$employee_business_agency_id['Business']['agency_id'])));
            $this->set('agency_name',@$siteSetting['AgencysiteSetting']['agencyname']); 
            $this->set('design',@$siteSetting); 

         }
		if( $controller === 'users' && $action === 'businessUserLogin' )
        {
             
			$this->Auth->loginAction = array('controller' => 'users', 'action' => 'businessUserLogin');
		}
		else
		{
			 
			$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		}
		//echo $usertype;die; 
		$this->Session->delete('User');
        if( $usertype == 'subscriber')
        {
           $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'businessUserLogin');
           $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'feedback');
        }elseif ($usertype == 'admin') {
        	$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'admin');
        	$this->Auth->loginRedirect = array('controller' => 'admin', 'action' => 'index');
        }elseif ($usertype == 'employee') {
        	$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'employee');
        	$this->Auth->loginRedirect = array('controller' => 'Employee', 'action' => 'index');
        }
        else
        {
			$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
			$this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
		}
        $total_ratings = $this->Onlinereview->find('first',array('fields'=>array('SUM(Onlinereview.ratingstar) AS totalrating','count(Onlinereview.ratingstar) AS totalcount','AVG(Onlinereview.ratingstar) AS AverageRating'),'conditions'=>array('Onlinereview.business_id'=>@$businessesdata['Business']['id'])));
		$this->set('online_average_rating',$total_ratings);

		$agency_logo = $this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.id'=>@$businessesdata['Business']['id']),'fields'=>array('Business.agency_id')));

            $this->loadModel('AgencysiteSetting');
			$conditions = array('AgencysiteSetting.user_id'=>@$agency_logo['Business']['agency_id']);
			$logo = $this->AgencysiteSetting->find('first',array('contain'=>false,'fields'=>array('AgencysiteSetting.agencylogo'),'conditions'=>$conditions));
			 
			$this->set('logo',@$logo['AgencysiteSetting']['agencylogo']);

			$bactions=array('feedback','businesSetup','visibility','contactManager','notification','reporting','businessUserTraining','addCustomer');
			if(!$this->Auth->user() && ($this->params['controller']=='admin') && $this->params['action']!='postReview' && $this->params['action']!='thanksToCustomer' && $this->params['action']!='thanksToNegativeCustomer'){
				$this->redirect(array('controller'=>'users','action'=>'admin'));
			}elseif (!$this->Auth->user() && ($this->params['controller']=='Employee') && $this->params['action']!='postReview' && $this->params['action']!='thanksToCustomer' && $this->params['action']!='thanksToNegativeCustomer') {
				$this->redirect(array('controller'=>'users','action'=>'employee'));
			}elseif (!$this->Auth->user() && ($this->params['controller']=='dashboard') && in_array($this->params['action'], $bactions)) {
				$this->redirect(array('controller'=>'users','action'=>'businessUserLogin'));
			}
 
	} 


	public function routing(){
			$usertype=$this->Session->read('Auth.User.usertype');
			if($usertype=='subscriber'){
				return $this->Session->read('Auth.User.id');
			}elseif($usertype=='reseller'){
				$this->loadModel('Business');
				if(isset($this->request->query['bussiness'])){
					$qry=base64_decode($this->request->query['bussiness']);
					$uid=$this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.id'=>$qry,'Business.agency_id'=>$this->Session->read('Auth.User.id')),'fields'=>array('Business.user_Id')));
					if(empty($uid)){
						return false;
					}else{
						return $uid['Business']['user_Id'];
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
			
		}
	function RandomStringGenerator($length = 8)
	{
	  $string = "";	  
	  $pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		for($i=0; $i<$length; $i++)
		{
			$string .= $pattern{rand(0,61)};
		}
		
		return $string;
	}

	/**
*Function to send mail
*Author:MSS
*/
function sendEmail($email_template=null,$from=null,$to=null,$subject=null)
	{
		$template_info = $email_template;
CakeLog::write(LOG_ERR, 'Something horrible happened'.$email_template);
		$to = trim($to);	
		$this->set('data',$template_info);
		$this->Email->to = $to;
		$this->Email->subject = $subject;
		$this->Email->from ="Khaleel@amtechgcc.com";
		$this->Email->template = 'default';
		$this->Email->sendAs = 'both'; 
		$this->Email->smtpOptions = array(
		      'port'=>'465',
		     //'timeout'=>'30',
		     'host' => 'ssl://email-smtp.us-west-2.amazonaws.com',
		     'username'=>'AKIAJANE4LCAEEPVJGZQ',
		     'password'=>'Ar7GYMtU2xlxh9BKsq91kYLfdBszEQrfTqRwrN+ior7W'
		);
 		$this->Email->delivery = 'smtp';
 		CakeLog::write('email', strip_tags($template_info));
		$this->Email->send($template_info);

	}
/**
*Function to generate unique key.
*Author:MSS
*/	
function generateUniqueKey() {
        return md5(uniqid(rand(), true));
    }
    	
/**
*Function to check email
*Author:MSS
*/    
function checkEmail($email, $model){
	//die($model);
	$this->loadModel($model);
	$result = $this->$model->find('first',array('conditions'=>array('email'=>$email)));
	return $result;
}
public function beforeRender() {
     $this->response->disableCache();

}
function upload_image($dest,$file,$oldfile=NULL)
	{		
		$dest = realpath($dest);
		$name = str_replace(' ','_',$file['name']);
		$name = explode('.',$name);
		$name[0] = $name[0].'-'.time();
		$name = $name['0'].'.'.end($name);
		$location = $dest.'/'.$name;
		if(copy($file['tmp_name'],$location))
		{
			if($oldfile)
			{
				unlink($dest.'/'.$oldfile);
			}
			return $name;
		}
	}
	function firstDayOf($period, DateTime $date = null)
		{
		  
		    $period = strtolower($period);
		    $validPeriods = array('year', 'quarter', 'month', 'week','half');
		 
		    if ( ! in_array($period, $validPeriods))
		        throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
		 
		    $newDate = ($date === null) ? new DateTime() : $date;
		 
		    switch ($period) {
		        case 'year':
		            $newDate->modify('first day of january ' . $newDate->format('Y'));
		            break;
		        case 'quarter':
		            $month = $newDate->format('n') ;
		            if ($month < 4) {
		                $newDate->modify('first day of january ' . $newDate->format('Y'));
		            } elseif ($month > 3 && $month < 7) {
		                $newDate->modify('first day of april ' . $newDate->format('Y'));
		            } elseif ($month > 6 && $month < 10) {
		                $newDate->modify('first day of july ' . $newDate->format('Y'));
		            } elseif ($month > 9) {
		                $newDate->modify('first day of october ' . $newDate->format('Y'));
		            }
		            break;
	          case 'half':
	            $month = $newDate->format('n') ;
	            if ($month < 7) {
	                $newDate->modify('first day of january ' . $newDate->format('Y'));
	            } elseif ($month > 6 ) {
	                $newDate->modify('first day of july ' . $newDate->format('Y'));
	            } 
	            break;    
		        case 'month':
		            $newDate->modify('first day of this month');
		            break;
		        case 'week':
		            $newDate->modify(($newDate->format('w') === '0') ? 'monday last week' : 'monday this week');
		            break;
		    }
		 
		    return $newDate;
		}

		function lastDayOf($period, DateTime $date = null)
		{
		    $period = strtolower($period);
		    $validPeriods = array('year', 'quarter', 'month', 'week','half');
		 
		    if ( ! in_array($period, $validPeriods))
		        throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
		 
		    $newDate = ($date === null) ? new DateTime() : clone $date;
		 
		    switch ($period)
		    {
		        case 'year':
		            $newDate->modify('last day of december ' . $newDate->format('Y'));
		            break;
		        case 'quarter':
		            $month = $newDate->format('n') ;
		 
		            if ($month < 4) {
		                $newDate->modify('last day of march ' . $newDate->format('Y'));
		            } elseif ($month > 3 && $month < 7) {
		                $newDate->modify('last day of june ' . $newDate->format('Y'));
		            } elseif ($month > 6 && $month < 10) {
		                $newDate->modify('last day of september ' . $newDate->format('Y'));
		            } elseif ($month > 9) {
		                $newDate->modify('last day of december ' . $newDate->format('Y'));
		            }
		            break;
		        case 'half':
	            $month = $newDate->format('n') ;
		            if ($month < 7) {
		                $newDate->modify('last day of june ' . $newDate->format('Y'));
		            } elseif ($month > 6 ) {
		                $newDate->modify('last day of december ' . $newDate->format('Y'));
		            } 
	            break;      
		        case 'month':
		            $newDate->modify('last day of this month');
		            break;
		        case 'week':
		            $newDate->modify(($newDate->format('w') === '0') ? 'now' : 'sunday this week');
		            break;
		    }
		 
		    return $newDate;
		}	
		
	function validUserEmail()
	{
		$email = trim($_REQUEST['data']['User']['email']);
		$this->autoRender = false;
		$this->loadModel('User');
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
	function checkUserEmail($param=null)
		{
			$email = trim($_REQUEST['data']['User']['email']);
			$this->autoRender = false;
			$this->loadModel('User');
			// pr($param);die;
			$count = $this->User->find('count',array('conditions'=>array('User.email'=>$email,'User.id !='=>$param)));
			if($count>0)
			{
				echo "false";die;
			}
			else
			{
				echo "true";die;
			}	
		}

#Format Email
	/*public function getEmailcontent($businessid,$emailtype)
	{
		
		$this->loadModel('EmailTemplate');
		$emailTemplates=array(1=>'initial_feedback',
									 2=>'feedback_reminder',
									 3=>'positive_feedback',
									 4=>'negative_feedback',
									 5=>'positive_email',
									 6=>'negative_email'
									 );
		if(isset($businessid)&&isset($emailtype)){

			 $email_sign = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$businessid ,'EmailTemplate.type'=>$emailtype),'recursive'=>-1));
			 if(isset($email_sign)&&count($email_sign)>0){

			 	return $email_sign['EmailTemplate']['emailcontent'];
			 }
			 else{
			 		# default emailTemplate
			 	  $dest = '../webroot/emailTemplate/'.$emailTemplates[$emailtype].'.txt';
				  return  $content=file_get_contents($dest ,true);	
				   # $replace=array('{{cusotmername}}'=>'yogendra');
				   # return  strtr($content, $replace);


			 }

		}
	}*/

	public function getEmailcontent($businessid,$emailtype)
	{
		
		$this->loadModel('EmailTemplate');
		$emailTemplates=$this->getemailTemplates();
		if(isset($businessid)&&isset($emailtype)){

			# check for the special or custom emails
			$specialemails = $this->EmailTemplate->find('all',array('conditions'=>array('EmailTemplate.business_id'=>$businessid ,'EmailTemplate.type'=>$emailtype,'default'=>1,'status'=>1),'recursive'=>-1));
			$todaydate = date("Y-m-d");
			if(count($specialemails)>0):
				foreach ($specialemails as $key => $_specialemail) {
					 $start_date = $_specialemail['EmailTemplate']['startdate'];
				    	$end_date =  $_specialemail['EmailTemplate']['enddate'];
						if($this->check_in_range($start_date, $end_date, $todaydate))
						{
							return $_specialemail['EmailTemplate'];
						}
				}
			endif;

			 # check the default templates customized under the setup tab

			 $email_sign = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$businessid ,'EmailTemplate.type'=>$emailtype,'default'=>0,'status'=>1),'recursive'=>-1));
			 if(isset($email_sign)&&count($email_sign)>0){

			 	return $email_sign['EmailTemplate'];
			 }
			 else{
			 		# default emailTemplate
			 	  $dest = '../webroot/emailTemplate/'.$emailTemplates[$emailtype].'.txt';
				  $content=file_get_contents($dest ,true);	
				 return Array
						(
						    'business_id' => $businessid,
						    'emailtemplatename'=> $emailTemplates[$emailtype],
						    'emailsubject' => $emailTemplates[$emailtype],
						    'sendername'=> 'YOGKJGLJ',
						    'senderemail' => 'yogendrakumar125@gmail.com',
						    'emailcontent' => $content						   						   
						    
						);



			 }
		}
	}	

	public function _sendingEmail($sendername=null,$senderemail=null,$receiveremail,$subject,$content,$replace=array())
	{
		  $content=strtr($content, $replace);

		try {
			   $this->sendEmail($content,$senderemail,$receiveremail,$subject);
			   return true;
			} catch (Exception $e) {

				return false;
			}		
	}
	## default emailTemplates collection
	public function getemailTemplates(){

		return array(1=>'initial_feedback',
									 2=>'feedback_reminder',
									 3=>'positive_feedback',
									 4=>'negative_feedback',
									 5=>'positive_email',
									 6=>'negative_email'
									 );

	}
	public function check_in_range($start_date, $end_date, $date_from_user)
	{
	  // Convert to timestamp
	  $start_ts = strtotime($start_date);
	  $end_ts = strtotime($end_date);
	  $user_ts = strtotime($date_from_user);

	  // Check that user date is between start & end
	  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}

public function approveReview($rid=null,$status=null){
  	$st=$status;
  	$id=base64_decode($rid);
  	$data=array();
  	if($id){
       $data['BusinessReview']['id']=$id;
       $data['BusinessReview']['approved']=$status;
       $this->loadModel('BusinessReview');
       if($this->BusinessReview->save($data)){
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
       }else{
       		$response[]='error';
            echo json_encode($response);die;
       }
  	}else{
  		$response[]='error';
        echo json_encode($response);die;
  	}
  }

  public function onlinereviewsstatus($rid=null,$status=null){
  	$st=$status;
  	$id=base64_decode($rid);
  	$data=array();
  	if($id){
       $data['Onlinereview']['id']=$id;
       $data['Onlinereview']['confirmation']=$status;
       $this->loadModel('Onlinereview');
       if($this->Onlinereview->save($data)){
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
       }else{
       		$response[]='error';
            echo json_encode($response);die;
       }
  	}else{
  		$response[]='error';
        echo json_encode($response);die;
  	}
  }	

  public function history($id=null){
  	if($id){
  		$response=array();
  		$this->loadModel('Customer');
  		$email=$this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$id),'fields'=>array('Customer.email','Customer.firstName','Customer.lastName')));
  		$name=$email['Customer']['firstName'].' '.$email['Customer']['lastName'];
  		if(!empty($email)){
  			$email=trim($email['Customer']['email']);
  			if($email){
  				
  				$data=$this->Customer->find('all',array('contain'=>array('BusinessReview','Business.businessname'),'conditions'=>array('Customer.email'=>$email),'fields'=>array('Customer.id'),'order'=>array('Customer.id DESC')));
  				// pr($data);die;
  				$html="";
  				foreach ($data as $key => $value) {
  					if(!empty($value['BusinessReview'])){
  						// pr($value['BusinessReview'][0]['firstName']);die;	
  						$html.= "<tr><td class='recent-feedback-img'>
	                              <img src='http://localhost/repmgsys/app/webroot/img/generic-avatar.png'></td>
	                              <td class='recent-feedback-info'>
	                              <p class='rf-name'>";
		                $html.=@$value['BusinessReview'][0]['firstName'].' '.@$value['BusinessReview'][0]['lastName'];
		                $html.="</p><b>Email:</b>".$email."</br>";
		                $html.="<b>Business:</b>".$value['Business']['businessname'];
		                $html.="</p><b>Description:</b>";
		                $html.="<p class='rf-subject' id='abc1'>";
		                $html.=substr(@$value['BusinessReview'][0]['ratingdescription'],0,127) ;
		               if(strlen(@$value['BusinessReview'][0]['ratingdescription']) >127){ 
						$html.=	"</br><a style='cursor:pointer;' class='showtxt'>Read More</a>";
						} 
		                $html.="</p><p style='display:none; font-size: 1.1em;font-weight: normal;margin: -3px 0 0;' class='1'>";
		                $html.=@$value['BusinessReview'][0]['ratingdescription'];
		                $html.="</p><p class='rf-date'>";
		                $html.=date('d/m/y',strtotime(@$value['BusinessReview'][0]['ratingdate']));
		                $html.="</p></td><td><img src='http://localhost/repmgsys/app/webroot/img/";
		                $html.=@$value['BusinessReview'][0]['ratingstar'];
		                $html.="stars.png'></td></tr>";
  					}else{
  						continue;
  					}
  				}
  				
  				$response['0']='success';
  				$response['1']=$html;
  				$response['3']='Reviewed By '.$name;
  				echo json_encode($response);die;
  				
  			}else{
  				$response['0']='error';
  				$response['1']='Invalid Email Id';
  				echo json_encode($response);die;
  			}
  		}else{
  				$response['0']='error';
  				$response['1']='Customer email does not exist';
  				echo json_encode($response);die;
  		}
  	}else{
			$response['0']='error';
			$response['1']='Customer email does not exist';
			echo json_encode($response);die;
  	}
  }

  function share($id=null,$bid=null){
  	if($id && $bid){
  		$response=array();
  		$this->loadModel('Customer');
  		$this->loadModel('BusinessSitePromotion');
  		$customer=$this->Customer->find('first',array('contain'=>array('BusinessReview'),'conditions'=>array('Customer.id'=>$id),'fields'=>array('Customer.email','Customer.firstName','Customer.lastName')));
  		$sites=$this->BusinessSitePromotion->find('all',array('conditions'=>array('BusinessSitePromotion.status'=>1,'BusinessSitePromotion.business_id'=>$bid)));
  		// pr($customer);die;
  		if(!empty($customer['BusinessReview'])){
  			if($customer['BusinessReview'][0]['share_online']==1){
  				$html=$customer['BusinessReview'][0]['ratingdescription'];
  				$sitesHtml="";
  				foreach ($sites as $key => $value) {
  					$sitesHtml.="<div class='review-google'><a target='_blank' href='//";
			        $sitesHtml.=ltrim($value['BusinessSitePromotion']['url'],'https://').trim($value['BusinessSitePromotion']['review'])."'>
			                      <img alt='";
			        $sitesHtml.=str_replace("'", "", $value['BusinessSitePromotion']['mediasitename'])."'src='";
                  	$sitesHtml.=HTTP_ROOT."img/social-icons/".str_replace("'", "", $value['BusinessSitePromotion']['mediasitename']).".png'>
			                    </a>
			                  </div>";
  				}
  				$html.="\n<br/><b>Created By:".@$customer['BusinessReview'][0]['firstName'].' '.@$customer['BusinessReview'][0]['lastName']."<b>\n<br/>";
  				$html.="<b>Created At:".date('d/m/y',strtotime(@$customer['BusinessReview'][0]['ratingdate']))."</b>";
  				$response['0']='success';
  				$response['1']=$html;
  				$response['2']=$sitesHtml;
  				echo json_encode($response);die;
  			}else{
  				$response['0']='unauthorized';
				$response['1']='You are not authorized to post review online.';
				echo json_encode($response);die;
  			}
  		}else{
  			$response['0']='error';
			$response['1']='Customer email does not exist';
			echo json_encode($response);die;
  		}
  	}else{
		$response['0']='error';
		$response['1']='Customer email does not exist';
		echo json_encode($response);die;
  	}
  }	
}
