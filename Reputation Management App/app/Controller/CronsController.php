<?php
App::uses('AppController', 'Controller');
class CronsController extends AppController 
{
    
       public function index(){
       	  echo phpinfo();die;
       }
   
	function beforeFilter(){
   		parent::beforeFilter();
   		$this->Auth->allow('getMediaUrl','notifyBusiness','emailNotificationToUser','automatedEmail','yelp','emailSentNormal','emailPostFeedback','getFbMediaUrl','getCityMediaUrl','getJuddyMediaUrl','getInsiderMediaUrl','getGooglePlusReviews','SaveReview');

		}


	public function automatedEmail()
	{   
			$this->loadModel('Business');
			$this->loadModel('Customer');
			$allCustomer = array();
			$alreadysentEmailCustomer = array();
			$notsentEmailCustomer =array();
			$allBusiness = $this->Business->find('all',array('contain'=>false,'conditions'=>array('Business.agency_id >'=>0)));
          
	        foreach ($allBusiness as $key => $value) 
	        {
	        $allCustomer[] = $this->Customer->find('all',array('contain'=>array('Business'),'conditions'=>array('Customer.business_id'=>$value['Business']['id'],'Customer.is_delete'=>0)));
	        }
         
	  	foreach ($allCustomer as $key => $value) 
	  		{
	  			foreach ($value as $val) 
	  			{ 
	              if(empty($val))
					{ 
						continue; 
					}
					else
					{  
						if(($val['Customer']['status'] == 'InFeedbackSequence' || $val['Customer']['status'] == 'NoFeedbackLeft' || $val['Customer']['status'] == 'Opt-Out') && ($val['Customer']['emailstatuscounter'] > 0))
						{
	                      $alreadysentEmailCustomer['Customer']['email'][] = $val['Customer']['email'];
	                      $alreadysentEmailCustomer['Customer']['id'][]= $val['Customer']['id'];
						}
						if($val['Customer']['status'] == 'NotInFeedbackSequence')
						{ 
	                      $notsentEmailCustomer['Customer']['email'][] = $val['Customer']['email'];
	                      $notsentEmailCustomer['Customer']['id'][] = $val['Customer']['id'];
						}
	            	 }
	        	 }
			}
                  // pr($alreadysentEmailCustomer);die;
		   if(!empty($notsentEmailCustomer) && count($notsentEmailCustomer) > 0)
		   {        	 
		   $this->emailSentNormal($notsentEmailCustomer);	
		   }
		   if(!empty($alreadysentEmailCustomer) && count($alreadysentEmailCustomer) > 0)
		   {        	 
		   $this->emailPostFeedback($alreadysentEmailCustomer);	
		   }
           echo "Email has been Sent to respective Customers";die;
           
  }
	public function emailSentNormal($data=null)
		{
		  $this->loadModel('Business');
	      $this->loadModel('Customer');

	      for($i = 0; $i < count(@$data['Customer']['email']); $i++)
	      {
	           	$business_id = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$data['Customer']['id'][$i]),'fields'=>array('Customer.business_id','Customer.cronssentemaildate','Customer.emailstatuscounter','Customer.firstname','Customer.lastname')));
	          	 
	          	$emailstatuscounter = $business_id['Customer']['emailstatuscounter'];
	          	$emailfrequecy = $this->Business->find('first',array('contain'=>'User','conditions'=>array('Business.id'=>$business_id['Customer']['business_id']),'fields'=>array('Business.emailfrequency','Business.automatedenailattempts','Business.user_Id','Business.businessname','User.email')));
                $user_id = $emailfrequecy['Business']['user_Id'];
	          	$automatedenailattempts = $emailfrequecy['Business']['automatedenailattempts'];
	            $sentdate = $business_id['Customer']['cronssentemaildate'];
                $frequency = $emailfrequecy['Business']['emailfrequency'];
	            $emailSentdate = strtotime("+".$frequency." days", strtotime($sentdate));
	            $emailToBeSentdate = date("Y-m-d", $emailSentdate);
	            $todaydate = date("Y-m-d");

	            if($emailToBeSentdate == $todaydate && $emailstatuscounter < $automatedenailattempts)
	            {	
	             
            $email = $data['Customer']['email'][$i];
	    	$business_name = $emailfrequecy['Business']['businessname'];
            $business_email = $this->Session->read('Auth.User.email');
            $name = $business_id['Customer']['firstname']. ' '. $business_id['Customer']['lastname'];
		    $url=Router::url('/dashboard/postReview?id='.base64_encode($user_id).'&customer_id='.base64_encode($data['Customer']['id'][$i]), true);
			$eTemplate=$this->getEmailcontent($business_id['Customer']['business_id'],1);
			$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
			$sendername=@$eTemplate['sendername'];
			$sendemail=@$eTemplate['senderemail'];
			$content=$eTemplate['emailcontent'];	
			$subject=@$eTemplate['emailsubject'];
			$receiveremail=$email;
			$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
			$this->Customer->updateAll(array('Customer.status' =>"'NotInFeedbackSequence'",'Customer.cronssentemaildate'=>"'$todaydate'",'Customer.emailstatuscounter' => 'Customer.emailstatuscounter + 1'), array('Customer.id' => $data['Customer']['id'][$i]));
			  }
	           else
    	    	{
	    		continue;
	         	}
	    	}
        }  
 
		public function emailPostFeedback($data = null)
		{
        $this->loadModel('Business');
		$this->loadModel('Customer');
	    for($i = 0; $i<count($data['Customer']['email']); $i++)
	      {
	      	$business_id = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$data['Customer']['id'][$i]),'fields'=>array('Customer.business_id','Customer.cronssentemaildate','Customer.emailstatuscounter','Customer.firstname','Customer.lastname')));
	      	$noOfTimesSentEmail = $business_id['Customer']['emailstatuscounter']; 
	      	$emailSentDate =  $business_id['Customer']['cronssentemaildate']; 

	      	
	      	$BusinessRuleEmailSentStatus = $this->Business->find('first',array('contain'=>'User','conditions'=>array('Business.id'=>$business_id['Customer']['business_id']),'fields'=>array('Business.postfeedbackemailfrequency','Business.automatedpostfeedbackenailattempts','Business.user_Id','Business.businessname','User.email')));
	      	$user_id = $BusinessRuleEmailSentStatus['Business']['user_Id'];
	      	$automatedpostfeedbackenailattempts = $BusinessRuleEmailSentStatus['Business']['automatedpostfeedbackenailattempts'];
	      	$postFeedbackemailfrequecy = $BusinessRuleEmailSentStatus['Business']['postfeedbackemailfrequency'];
	        $EmailSentDate = strtotime("+".$postFeedbackemailfrequecy." days", strtotime($emailSentDate));
	        $emailToBeSentdate = date("Y-m-d", $EmailSentDate);
	        $todaydate = date("Y-m-d"); 
	        $customerFeedbackStatus = $business_id['Customer']['emailstatuscounter'];
	        $emailSentStatusCounter = $BusinessRuleEmailSentStatus['Business']['automatedpostfeedbackenailattempts'];
                
            if($customerFeedbackStatus > $emailSentStatusCounter)
            {    
            	$this->Customer->updateAll(array('Customer.status' => "'Opt-Out'"), array('Customer.id' => $data['Customer']['id'][$i]));
            }
           if($noOfTimesSentEmail <= $automatedpostfeedbackenailattempts && $emailToBeSentdate == $todaydate)
	       { 
	       	$customerFeedbackStatus = $business_id['Customer']['emailstatuscounter'];
	        $emailSentStatusCounter = $BusinessRuleEmailSentStatus['Business']['automatedpostfeedbackenailattempts'];
	        $email = $data['Customer']['email'][$i];
	        $business_name = $BusinessRuleEmailSentStatus['Business']['businessname'];
	        $business_email = $this->Session->read('Auth.User.email');
	        $name = $business_id['Customer']['firstname']. ' '. $business_id['Customer']['lastname'];

		    $url=Router::url('/dashboard/postReview?id='.base64_encode($user_id).'&customer_id='.base64_encode($data['Customer']['id'][$i]), true);
            
			$eTemplate=$this->getEmailcontent($business_id['Customer']['business_id'],1);
            $replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$BusinessRuleEmailSentStatus['User']['email'],'$reviewurl'=>$url);
            $sendername=@$eTemplate['sendername'];
			$sendemail=@$eTemplate['senderemail'];
			$content=$eTemplate['emailcontent'];	
			$subject=@$eTemplate['emailsubject'];
			$receiveremail=$email;
			$this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);
            $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'",'Customer.emailstatuscounter' => 'Customer.emailstatuscounter + 1'), array('Customer.id' => $data['Customer']['id'][$i]));
            if($customerFeedbackStatus == $emailSentStatusCounter)
            {
            	$this->Customer->updateAll(array('Customer.status' => "'NoFeedbackLeft'"), array('Customer.id' => $data['Customer']['id'][$i]));
            }
             
		    }
	    	else
	    	{
	    		continue;
	    	}
		}
	}

    public function getFbMediaUrl(){
		$this->loadModel('Visibility');
		$urls=$this->Visibility->find('all',array('contain'=>false,'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Facebook')));
		//pr($urls);die;
		$ch = curl_init();
		//pr($urls);die;
		foreach ($urls as $key => $value) {
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
				$url=$value['Visibility']['prefixurl'].$value['Visibility']['url'];
				curl_setopt($ch, CURLOPT_URL,$url);
				$curlResult = json_decode(curl_exec($ch));
				if(isset($curlResult->data[0]->reviewer->id)){
					$status=true;
				}else{
					$status=false;
				}
				if(isset($curlResult->error) || !$curlResult || !$status){
					$value['Visibility']['status']='error';
				}else{
					$value['Visibility']['status']='visible';	
				}
			$this->Visibility->save($value['Visibility']);
		}
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Facebook')));
		$this->loadModel('Onlinereview');
		foreach ($urls as $key => $value) {
			$url=trim($value['Visibility']['prefixurl'].$value['Visibility']['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			if(isset($curlResult->data[0]->reviewer->id)){
				$reviewData=array();
				foreach ($curlResult->data as $indx => $rev) {
					$reviewData['Onlinereview']['business_id']=$value['Visibility']['business_id'];
					$reviewData['Onlinereview']['social_media_id']=$value['Visibility']['social_media_id'];
					$reviewData['Onlinereview']['ratingstar']=$rev->rating;
					$reviewData['Onlinereview']['ratingdescription']=@$rev->review_text;
					$reviewData['Onlinereview']['CustomerFullName']=$rev->reviewer->name;
					$reviewData['Onlinereview']['online_review_id']=$rev->created_time;
					$chk=$this->Onlinereview->find('first',array('contain'=>false,'fields'=>array('Onlinereview.id'),'conditions'=>array('Onlinereview.online_review_id'=>$rev->created_time)));
					if(count($chk)>0){
						$reviewData['Onlinereview']['id']=$chk['Onlinereview']['id'];
					}
					$this->Onlinereview->create();
					if(!$this->Onlinereview->save($reviewData)){
						continue;
					}
				}
			}else{
				continue;
			}
		}
		curl_close($ch);
		
	}


	 public function getCityMediaUrl(){
		$this->loadModel('Visibility');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Citysearch')));
		$ch = curl_init();
		foreach ($urls as $key => $value) {
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
				$url=$value['Visibility']['prefixurl'].$value['Visibility']['url'];
				curl_setopt($ch, CURLOPT_URL,$url);
				$curlResult = json_decode(curl_exec($ch));
				// pr($curlResult);die;
				if(isset($curlResult->results->reviews) && !empty($curlResult->results->reviews)){
					foreach ($curlResult->results->reviews as $key => $value1) {
						if($value1->source=='CITYSEARCH' && $value1->source_id=='131'){
							$reviewData=array();
							$reviewData['Onlinereview']['business_id']=$value['Visibility']['business_id'];
							$reviewData['Onlinereview']['social_media_id']=$value['Visibility']['social_media_id'];
							if($value1->review_rating>5){
								$rating=5;
							}else{
								$rating=$value1->review_rating;
							}
							if($rating==null){
								$rating=0;
							}
							$reviewData['Onlinereview']['ratingstar']=$rating;
							$reviewData['Onlinereview']['ratingdescription']=$value1->review_text;
							$reviewData['Onlinereview']['CustomerFullName']=$value1->business_name;
							$reviewData['Onlinereview']['online_review_id']=$value1->review_id;
							$chk=$this->Onlinereview->find('first',array('contain'=>false,'fields'=>array('Onlinereview.id'),'conditions'=>array('Onlinereview.online_review_id'=>$value1->review_id)));
							if(count($chk)>0){
								$reviewData['Onlinereview']['id']=$chk['Onlinereview']['id'];
							}
							$this->Onlinereview->create();
							if(!$this->Onlinereview->save($reviewData)){
								continue;
							}
						
						}else{
							continue;
						}
					}
				}
		}
		
		
		curl_close($ch);
		
	}

	 public function getJuddyMediaUrl(){
		$this->loadModel('Visibility');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>"Judy's Book")));
		$ch = curl_init();
		foreach ($urls as $key => $value) {
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
				$url=$value['Visibility']['prefixurl'].$value['Visibility']['url'];
				curl_setopt($ch, CURLOPT_URL,$url);
				$curlResult = json_decode(curl_exec($ch));
				if(isset($curlResult->results->reviews) && !empty($curlResult->results->reviews)){
					foreach ($curlResult->results->reviews as $key => $value1) {
						if(str_replace(' ', '', str_replace("'", '', $value1->source))=="JudysBook" && $value1->source_id=='13'){
							$reviewData=array();
							$reviewData['Onlinereview']['business_id']=$value['Visibility']['business_id'];
							$reviewData['Onlinereview']['social_media_id']=$value['Visibility']['social_media_id'];
							if($value1->review_rating>5){
								$rating=5;
							}else{
								$rating=$value1->review_rating;
							}
							if($rating==null){
								$rating=0;
							}
							$reviewData['Onlinereview']['ratingstar']=$rating;
							$reviewData['Onlinereview']['ratingdescription']=$value1->review_text;
							$reviewData['Onlinereview']['CustomerFullName']=$value1->business_name;
							$reviewData['Onlinereview']['online_review_id']=$value1->review_id;
							$chk=$this->Onlinereview->find('first',array('contain'=>false,'fields'=>array('Onlinereview.id'),'conditions'=>array('Onlinereview.online_review_id'=>$value1->review_id)));
							if(count($chk)>0){
								$reviewData['Onlinereview']['id']=$chk['Onlinereview']['id'];
							}
							// pr($reviewData);die;
							$this->Onlinereview->create();

							if(!$this->Onlinereview->save($reviewData)){
								continue;
							}
						
						}else{
							continue;
						}
					}
				}
		}
		
		
		curl_close($ch);
		
	}

	public function getInsiderMediaUrl(){
		$this->loadModel('Visibility');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>"Insider Pages")));
		$ch = curl_init();
		foreach ($urls as $key => $value) {
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
				$url=$value['Visibility']['prefixurl'].$value['Visibility']['url'];
				curl_setopt($ch, CURLOPT_URL,$url);
				$curlResult = json_decode(curl_exec($ch));
				if(isset($curlResult->results->reviews) && !empty($curlResult->results->reviews)){
					foreach ($curlResult->results->reviews as $key => $value1) {
						if($value1->source=="INSIDERPAGES" && $value1->source_id=='17'){
							$reviewData=array();
							$reviewData['Onlinereview']['business_id']=$value['Visibility']['business_id'];
							$reviewData['Onlinereview']['social_media_id']=$value['Visibility']['social_media_id'];
							if($value1->review_rating>5){
								$rating=5;
							}else{
								$rating=$value1->review_rating;
							}
							if($rating==null){
								$rating=0;
							}
							$reviewData['Onlinereview']['ratingstar']=$rating;
							$reviewData['Onlinereview']['ratingdescription']=$value1->review_text;
							$reviewData['Onlinereview']['CustomerFullName']=$value1->business_name;
							$reviewData['Onlinereview']['online_review_id']=$value1->review_id;
							$chk=$this->Onlinereview->find('first',array('contain'=>false,'fields'=>array('Onlinereview.id'),'conditions'=>array('Onlinereview.online_review_id'=>$value1->review_id)));
							if(count($chk)>0){
								$reviewData['Onlinereview']['id']=$chk['Onlinereview']['id'];
							}
							// pr($reviewData);die;
							$this->Onlinereview->create();

							if(!$this->Onlinereview->save($reviewData)){
								continue;
							}
						
						}else{
							continue;
						}
					}
				}
		}
		
		
		curl_close($ch);
	}

	public function getGooglePlusReviews(){
        $this->loadModel('Visibility');
		$this->loadModel('Onlinereview');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>"Google Plus Local")));
		foreach ($urls as $key => $value) {   
			$business_id = $value['Visibility']['business_id'];
			$url=trim($value['Visibility']['prefixurl'].$value['Visibility']['url']);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			 
			if($curlResult->status=='OK' && isset($curlResult->result->reviews) && $curlResult->result->reviews){
				$data = $curlResult->result->reviews;
                                 
				foreach ($data as $key1=>$value1){     
	                    $customer_name = @$value1->author_name;
		                $rating = $value1->rating;
	                        if($rating > 5){
	                               $rating = 5;
	                             }
		              	$datetime = $value1->time;
		              	$rating_description = $value1->text;
		              	$data1 = array();
		              	$data1['Onlinereview']['social_media_id'] = 2;
		              	$data1['Onlinereview']['business_id'] = $business_id;
		              	$data1['Onlinereview']['ratingstar'] = $rating;
		              	$data1['Onlinereview']['ratingdescription'] = $rating_description;
		              	$data1['Onlinereview']['CustomerFullName'] = $customer_name;
		              	$data1['Onlinereview']['online_review_id'] = $datetime;
	                    $reviwes = $this->Onlinereview->find('first',array('contain'=>false,'conditions'=>array('Onlinereview.business_id'=>$business_id,'Onlinereview.online_review_id'=>$datetime),'fields'=>array('Onlinereview.online_review_id','Onlinereview.business_id','Onlinereview.id')));
	                    if(!empty($reviwes['Onlinereview']['id']) && count($reviwes['Onlinereview']['id']) > 0){
		                       $data1['Onlinereview']['id'] = $reviwes['Onlinereview']['id'];
		                        if(!($this->Onlinereview->save($data1)))
		                        {
		                        	continue;
		                        }
	                    } else{ 
		                    	$this->Onlinereview->create();
		                    	if(!($this->Onlinereview->save($data1))){
		                    		 continue;
		                    	}
	                    }
	          	}
			}else{
				continue;
			}
		      curl_close($ch);
		     
 		}
 	}
   public function yelp()
	{ 
		require(APP . 'Vendor' . DS  . 'yelp' . DS . 'v2' . DS .'php' . DS .'lib' . DS . 'OAuth.php');
        $this->loadModel('Visibility');
		$this->loadModel('Onlinereview');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>"Yelp")));
       foreach ($urls as $key => $value) 
       {
			        $business_id = $value['Visibility']['business_id'];
			        $business_url = $value['Visibility']['url'];
			        $default_term = 'amtech';
					$default_location = 'Kingston, NJ';
					$search_limit = 3;
					$search_path = '/v2/business/';
					$api_host = 'http://api.yelp.com';
					$token = "srTc6fMg9sIYuMqLgkXkVS3ql0ncsgha";
					$token_secret = "y4ztc56nft-fYPC3YBJtijPFGD4";
					$CONSUMER_KEY = "0SvTmxIVvSdoHupqtaty1g";
			        $CONSUMER_SECRET = "tumO5-EFnDWxvHIEpbXg5MExAN0"; 
			        
			                $unsigned_url = "http://api.yelp.com/v2/business/$business_url";
						    $token = new OAuthToken($token, $token_secret);
						    $consumer = new OAuthConsumer($CONSUMER_KEY, $CONSUMER_SECRET);
						    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
						    $oauthrequest = OAuthRequest::from_consumer_and_token(
						        $consumer, 
						        $token, 
						        'GET', 
						        $unsigned_url
						    );
						    $oauthrequest->sign_request($signature_method, $consumer, $token);
						    $signed_url = $oauthrequest->to_url();
						    $ch = curl_init($signed_url);
						    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						    curl_setopt($ch, CURLOPT_HEADER, 0);
						    $data = curl_exec($ch);
						    $data = json_decode($data);
						      
						    if(!empty($data->reviews[0]))
						    {
                              $rating = $data->reviews[0]->rating;
	                        if($rating > 5){
	                               $rating = 5;
	                             }
		              	$datetime = $data->reviews[0]->time_created;
		              	$rating_description = $data->reviews[0]->excerpt;
		              	$data1 = array();
		              	$data1['Onlinereview']['social_media_id'] = 12;
		              	$data1['Onlinereview']['business_id'] = $business_id;
		              	$data1['Onlinereview']['ratingstar'] = $rating;
		              	$data1['Onlinereview']['ratingdescription'] = $rating_description;
		              	$data1['Onlinereview']['CustomerFullName'] = $data->reviews[0]->user->name;;
		              	$data1['Onlinereview']['online_review_id'] = $datetime;
                        $reviwes = $this->Onlinereview->find('first',array('contain'=>false,'conditions'=>array('Onlinereview.business_id'=>$business_id,'Onlinereview.online_review_id'=>$datetime),'fields'=>array('Onlinereview.online_review_id','Onlinereview.business_id','Onlinereview.id')));
	                          if(!empty($reviwes['Onlinereview']['id']) && count($reviwes['Onlinereview']['id']) > 0)
	                          {
		                       $data1['Onlinereview']['id'] = $reviwes['Onlinereview']['id'];
		                        if(!($this->Onlinereview->save($data1)))
		                        { 
		                        	continue;
		                        }
	                    		} 
	                    		else
	                    		{ 
		                    	$this->Onlinereview->create();
		                    	if(!($this->Onlinereview->save($data1))){  
		                    		 continue;
		                    	}
	                    	}
 						} else {
 							return;
 						}
						    curl_close($ch);
				}			    
		}	

    public function getAvvoUrl(){
		$this->loadModel('Visibility');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Avvo')));
		// pr($urls);die;
		$ch = curl_init();
		foreach ($urls as $key => $value) {
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
				$url=$value['Visibility']['prefixurl'].rtrim($value['Visibility']['url'],'/').'/reviews.json';
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, Avvo_User . ":" . Avvo_Pass);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$curlResult = json_decode(curl_exec($ch));
				if(isset($curlResult[0]) && $curlResult && isset($curlResult[0]->id)){
					$status=true;
				}else{
					$status=false;
				}
				if(!$status){
					$value['Visibility']['status']='error';
				}else{
					$value['Visibility']['status']='visible';	
				}
			$this->Visibility->save($value['Visibility']);
		}
		$urls=$this->Visibility->find('all',array('contain'=>false,'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Avvo')));
		$this->loadModel('Onlinereview');
		foreach ($urls as $key => $value) {
			$url=trim($value['Visibility']['prefixurl'].rtrim($value['Visibility']['url'],'/').'/reviews.json');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, Avvo_User . ":" . Avvo_Pass);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$curlResult = json_decode(curl_exec($ch));
			if(isset($curlResult[0]) && $curlResult && isset($curlResult[0]->id)){
				$reviewData=array();
				foreach ($curlResult as $indx => $rev) {
					$reviewData['Onlinereview']['business_id']=$value['Visibility']['business_id'];
					$reviewData['Onlinereview']['social_media_id']=$value['Visibility']['social_media_id'];
					$reviewData['Onlinereview']['ratingstar']=$rev->overall_rating;
					$reviewData['Onlinereview']['ratingdescription']=@$rev->body;
					$reviewData['Onlinereview']['CustomerFullName']=$rev->posted_by;
					$reviewData['Onlinereview']['online_review_id']=$rev->updated_at;
					$chk=$this->Onlinereview->find('first',array('contain'=>false,'fields'=>array('Onlinereview.id'),'conditions'=>array('Onlinereview.online_review_id'=>$rev->updated_at)));
					if(count($chk)>0){
						$reviewData['Onlinereview']['id']=$chk['Onlinereview']['id'];
					}
					$this->Onlinereview->create();
					if(!$this->Onlinereview->save($reviewData)){
						continue;
					}
				}
			}else{
				continue;
			}
		}
		curl_close($ch);
		
	}	

	/*public function getTwitterUrl(){
		$settings = array(
			    'oauth_access_token' => twitter_oauth_access_token,
			    'oauth_access_token_secret' => twitter_oauth_access_token_secret,
			    'consumer_key' => twitter_consumer_key,
			    'consumer_secret' => twitter_consumer_secret
			);
		require(APP . 'Vendor' . DS  . 'twitter' . DS . 'TwitterAPIExchange.php');
		$this->loadModel('Visibility');
		$urls=$this->Visibility->find('all',array('contain'=>false,'fields'=>array('Visibility.id','Visibility.prefixurl','Visibility.url','Visibility.business_id','Visibility.social_media_id'),'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Twitter')));
		//pr($urls);die;
		foreach ($urls as $key => $value) {
				$url=$value['Visibility']['prefixurl'];
	    		$getfield = '?screen_name='.trim($value['Visibility']['url']).'&count=300';
				$requestMethod = 'GET';
				$twitter = new TwitterAPIExchange($settings);
				$result=json_decode($twitter->setGetfield($getfield)
				             ->buildOauth($url, $requestMethod)
				             ->performRequest());

				if(getType($result)!='object' && (empty($result) || isset($result[0]->id))){
					$status=true;
				}else{
					$status=false;
				}
				if(!$status){
					$value['Visibility']['status']='error';
				}else{
					$value['Visibility']['status']='visible';	
				}
			$this->Visibility->save($value['Visibility']);
		}
		$urls=$this->Visibility->find('all',array('contain'=>false,'conditions'=>array('Visibility.status'=>'visible','Visibility.socialmediaName'=>'Twitter')));
		$this->loadModel('Onlinereview');
		foreach ($urls as $key => $value) {
			$url=$value['Visibility']['prefixurl'];
    		$getfield = '?screen_name='.trim($value['Visibility']['url']).'&count=300';
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$result=json_decode($twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest());
			if(getType($result)!='object' && (empty($result) || isset($result[0]->id))){
				$reviewData=array();
				foreach ($result as $indx => $rev) {
					$reviewData['Onlinereview']['business_id']=$value['Visibility']['business_id'];
					$reviewData['Onlinereview']['social_media_id']=$value['Visibility']['social_media_id'];
					$reviewData['Onlinereview']['ratingstar']='';
					$reviewData['Onlinereview']['ratingdescription']=@$rev->text;
					$reviewData['Onlinereview']['CustomerFullName']=@$rev->user->name;
					$reviewData['Onlinereview']['online_review_id']=@$rev->created_at;
					$reviewData['Onlinereview']['review_id']=@$rev->user->screen_name;
					$chk=$this->Onlinereview->find('first',array('contain'=>false,'fields'=>array('Onlinereview.id'),'conditions'=>array('Onlinereview.online_review_id'=>$rev->created_at,'Onlinereview.review_id'=>$rev->user->screen_name)));
					if(count($chk)>0){
						$reviewData['Onlinereview']['id']=$chk['Onlinereview']['id'];
					}
					$this->Onlinereview->create();
					if(!$this->Onlinereview->save($reviewData)){
						continue;
					}
				}
			}else{
				continue;
			}
		}
		
	}		*/
 	
 	public function SaveReview(){
 		// pr($this->getTwitterUrl());die;
 		$this->getFbMediaUrl();
 		$this->getCityMediaUrl();
 		$this->getJuddyMediaUrl();
 		$this->getInsiderMediaUrl();
 		$this->getGooglePlusReviews();
        $this->yelp(); 
        $this->getAvvoUrl();
 		die("All Site Review Has been Saved.");

 	}	

 	####SEnding reminder email
 	public function emailNotificationToUser()
	{
	   
	    $this->loadModel('Business');
		$todaydate = strtotime(date("Y-m-d"));
		$dayDiffrence = 7;
		#All Agency
		$businesses=$this->Business->find('all',array('contain'=>array('BusinessEmployee','User')));		
		foreach ($businesses as $key => $_business) {
			$needtoemail=false;
			#check for last login of business
			     $logindate=$_business['User']['lastlogin'];
			     # if business have not login last 7 days then go to check employess
			     if(isset($logindate)&&$this->checklastlogin($logindate)){			     
			     	
			     	if(count($_business['BusinessEmployee'])>0):
			     			foreach ($_business['BusinessEmployee'] as $key => $employee) {
			     				# code...
			     				
			     				if(isset($employee['lastlogin'])&&$this->checklastlogin($employee['lastlogin'])):
			     						$needtoemail=true;
			     				else:
			     					$needtoemail=false;
			     					break;
			     				endif;	
			     			}
			     	else:
			     		$needtoemail=true;
			        endif;		     	
			    	echo "<hr>";
			     }
			  $error=array();
			     if($needtoemail): #send email to Agency to notify
			      	 $agencyemail=$_business['Business']['agencyemail'];
			         $businessemail=$_business['User']['email'];
			        $error[][$key]=$this->notifytoAgency($agencyemail,$businessemail);
			     	#pr($_business['Business']);
			     	#$this->notifytoAgency($agencyemail,$businessname,$employeename);
			     endif;
		}# endforeach;

		pr($error);
		die;
	}

	public function notifytoAgency($agencyemail,$businessemail)
	{
			# format content and send email to Agency
		#echo $agencyemail;
		if($agencyemail!=''&& $businessemail!=''):
			$content ="<table><tr><tr><td>Dear < $agencyemail>, Business < $businessemail> nor any employee of this business have not login their account from last 7 days.
	                             Thanks</td></tr>
	                   </table>";			
			 	$subject= $businessemail.'  not logged In.';
			    try{
			    		#email function call
			    	$this->sendEmail($content,$businessemail,$agencyemail,$subject);
			    }
			    catch (Exception $e){
			    		# if any exception then continue and log
			    }
		endif;
		    return true;
	}
	public function checklastlogin($logindate)
	{
		         $now = time(); // or your date as well
			     $your_date = strtotime($logindate);
			     $datediff = $now - $your_date;
			      $days=floor($datediff/(60*60*24));
			    if($days > 7)return true;
			    return false;
	}
}
?>