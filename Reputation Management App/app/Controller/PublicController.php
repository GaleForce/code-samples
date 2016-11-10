<?php 
App::uses('AppController', 'Controller');

class PublicController extends AppController {
		
		function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->allow('micro_page','review','external_visibility','external_review','onlineReviewPlugin');

		}
		public function micro_page($id=NULL){
			if(!empty($id)){
				$this->layout = 'micro';
				$this->loadModel('Business');
				$this->loadModel('BusinessReview');
				$business_rec =$this->Business->find('all',array('contain'=>'User','order'=>array('Business.id'=>'DESC'),'fields'=>array('User.email','id','user_Id','businessname','addressline1','addressline2','phone','companywebaddress','business_logo','business_description','businessname','business_description','business_hours'),'conditions'=>array('Business.id'=>$id)));
				$client_rev = $this->BusinessReview->find('all',array('contain'=>'Customer','conditions'=>array('BusinessReview.business_id'=>$id,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'BusinessReview.approved'=>1),'fields'=>array('Customer.firstname','id','ratingstar','ratingdescription','ratingdate','approved'),'order'=>array('BusinessReview.id DESC')));
				$this->loadModel('Business');
				$busstr=$this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.id'=>$id)));
				$this->set('ratstar',$busstr);
				$this->set(compact('business_rec','client_rev'));
			}else{
				$this->redirect(array('controller'=>'dashboard','action'=>'index'));
			}
		}



		public function review($id=NULL,$user_Id=NULL){
			$id=base64_decode($id);
			$user_id = base64_decode($user_Id);

			$this->layout="micro";
			$this->loadModel('Business');
			$this->loadModel('Customer');
			$this->loadModel('BusinessReview');
			$bus_logo = $this->Business->find('first',array('fields'=>array('id','user_Id','business_logo','addressline1'),'conditions'=>array('Business.id'=>$id),'recursive'=>-1));
			$this->set(compact('bus_logo','user_id'));
			$this->set('business_id',$id);
			
			if(!empty($this->data)){
			$data = $this->data; 
		  	$data['Customer']['status'] = $data['BusinessReview']['ratingstar'].'R';
		    if($this->Customer->save($data)){ 
				    $customer_id=$this->Customer->getLastInsertID();
				    $data['BusinessReview']['customer_id'] = $customer_id;
					$data['BusinessReview']['business_id'] = $data['Customer']['business_id'];
					$data['BusinessReview']['user_id'] = $data['Customer']['user_id'];
					$data['BusinessReview']['ratingdate']=Date('Y-m-d');
					$data['BusinessReview']['confirmation'] = 1;
		    		$data['BusinessReview']['authorization'] = 1;
					if($this->BusinessReview->save($data)){
						$business_review_id=$this->BusinessReview->getLastInsertID();
						$this->loadModel('User');
						$user_email = $this->User->find('first',array('contain'=>false,'conditions'=>array('User.id'=>$data['BusinessReview']['user_id']),'fields'=>array('User.email'))); 
			       		$admin_email = $user_email['User']['email'];
			        	$email = $data['Customer']['email'];
			       		$name = $data['Customer']['firstname']. ' '. $data['Customer']['lastname'];
						$google = 'www.google.com';
						$threshold = $data['feedbackthreshold'];
						$business_email_template_id = $data['BusinessReview']['business_id'];
						if($this->request->data['BusinessReview']['ratingstar'] > $threshold){
							 $content=$this->getEmailcontent($business_email_template_id,3);
							 $replace=array('$customername'=>$name,'{{google}}'=>$google);
							 $content=strtr($content, $replace);
							 $this->sendEmail($content,"support@repmgsys.com",$email,'GET REVIEWS RESPONSE');
							 $content="<table>
									  <tr><td>You recieved a Business Review please check.!</td></tr>
								   </table>";
							 $this->sendEmail($content,"support@repmgsys.com",$admin_email,'GET REVIEWS RESPONSE');
							 $this->redirect(array('controller'=>'dashboard','action'=>'thanksToCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($data['Customer']['business_id']),'business_review_id'=>base64_encode($business_review_id))));
						
						}else{
							$content=$this->getEmailcontent($business_email_template_id,4);
				            		$replace=array('$customername'=>$name);
				           		$content=strtr($content, $replace);

				               $this->sendEmail($content,"support@repmgsys.com",$email,'GET REVIEWS RESPONSE');
				               $this->Session->setFlash('Your Review has been shared with us please check email.');
			                       $content="<table>
					          
	                           			 <tr><td>You recieved a Business Review please check.!</td></tr>
				            
				          	      </table>";
				               $this->sendEmail($content,"support@repmgsys.com",$admin_email,'GET REVIEWS RESPONSE');
				               $this->redirect(array('controller'=>'dashboard','action'=>'thanksToNegativeCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($data['Customer']['business_id'])))); 
						}
						
					}
				}else{
					$this->Session->setFlash(__('Review could not be saved. Please, try again.'));
					$this->redirect($this->referer());
				}
			}
		}		

	public function external_visibility($uid=null){
		   		//$uid=$this->Session->read('Auth.User.id');
		   		$this->layout="micro";
		  		$this->loadModel('Business');
            	$businessUser=$this->Business->find('first',array('contain'=>array('Visibility'),'conditions'=>array('Business.id'=>$uid)));
            	$media=array();
            	$mediaurl=array();
            	foreach ($businessUser['Visibility'] as $key => $value) {
            		$media[$value['id']]=$value['socialmediaName'];
            		$media[$value['socialmediaName']]=$value['url'];
            		$media[$value['socialmediaName'].'status']=$value['status'];
            		$media[$value['socialmediaName'].'checker']=$value['checkerType'];
            	}
            	 $this->loadModel('SocialMedia');
            	 $this->loadModel('BusinessSocialMedia');
                 $social_media_directory = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'visibilitychecker','SocialMedia.accounttype'=>'DirectoryListing')));
                
                $social_site = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'SocialSite')));
              	
              	$Review_site = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'ReviewSite')));
              	
                $SearchEngine = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'visibilitychecker','SocialMedia.accounttype'=>'SearchEngine')));
                $this->set('SearchEngine',$SearchEngine);
                $this->set('reviewsite',$Review_site);
                $this->set('directory_listing',$social_media_directory);
                $this->set('socialsite',$social_site);
            	$countSm=$this->SocialMedia->find('count');
            	$this->loadModel('Visibility');
            	$countVisibility=$this->Visibility->find('count',array('conditions'=>array('Visibility.business_id'=>$businessUser['Business']['id'])));
            	$percentage=number_format((float)(($countVisibility/$countSm)*100), 2, '.', '');
            	$accurate=$this->Visibility->find('count',array('conditions'=>array('Visibility.business_id'=>$businessUser['Business']['id'],'Visibility.status'=>'visible')));
            	$error=$this->Visibility->find('count',array('conditions'=>array('Visibility.business_id'=>$businessUser['Business']['id'],'Visibility.status'=>'error')));
            	$missing = count($social_media_directory)+count($social_site)+count($Review_site)+count($SearchEngine);
            	
		    	$this->set(compact('percentage','accurate','error','missing'));
            	$this->set('businessUser',$businessUser);
            	$this->set('media',$media);
            	if($this->request->is('post')){
            			switch ($action) {
	            		case 'Facebook':
	            		    $this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
	            		    $this->request->data['Visibility']['social_media_id']=13;
	            			if($this->fbSite($this->request->data)){
	            				$this->Session->setFlash('Facebook url added successfully.');
	            				$this->redirect($this->referer());
	            			}else{
	            				$this->Session->setFlash('Facebook url is already exist. Please try with another url.');
	            				$this->redirect($this->referer());
	            			}
	            			
	            			break;
	            		case 'GooglePlusLocal':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=2;
		            			if($this->gplus($this->request->data)){
		            				$this->Session->setFlash('Google Plus url added successfully.');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Google Plus url is already exist. Please try with another url.');
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            	case 'Citysearch':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=5;
		            			if($this->citysearch($this->request->data)){
		            				$this->Session->setFlash('City Search url added successfully.');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('City Search url is already exist. Please try with another url.');
		            				$this->redirect($this->referer());
		            			}
		            			break;		
		            	case 'InsiderPages':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=6;
		            			if($this->insiderpages($this->request->data)){
		            				$this->Session->setFlash('Insider Pages url added successfully.');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Insider Pages url is already exist. Please try with another url.');
		            				$this->redirect($this->referer());
		            			}
		            			break;
		            	case 'JudysBook':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=7;
		            			if($this->judysbook($this->request->data)){
		            				$this->Session->setFlash("Judy's Book url added successfully.");
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Judy's Book url is already exist. Please try with another url.");
		            				$this->redirect($this->referer());
		            			}
		            			break;					
		            	default:
	            			break;
	            	}
            	}
	      
	}

	public function external_review($id=NULL){
			$this->layout="micro";
			$this->loadModel('Business');
			$this->loadModel('Customer');
			$this->loadModel('BusinessReview');
			
			$bus_logo = $this->Business->find('first',array('fields'=>array('id','user_Id','business_logo','feedbackthreshold','addressline1'),'conditions'=>array('Business.id'=>$id),'recursive'=>-1));
			$this->set(compact('bus_logo'));
			$this->set('business_id',$id);
			$this->loadModel('FeedbackSetting');
			$feedbacksetting=$this->FeedbackSetting->find('first',array('conditions'=>array('FeedbackSetting.business_id'=>$bus_logo['Business']['id']),'recursive'=>-1));
			$this->set('feedbacksetting',$feedbacksetting);

		


			if(!empty($this->data)){
			$data = $this->data;
			$data['Customer']['status'] = $data['BusinessReview']['ratingstar'].'R';
			if($this->Customer->save($data)){ 
				        $customer_id=$this->Customer->getLastInsertID();
				        $data['BusinessReview']['customer_id'] = $customer_id;
					$data['BusinessReview']['business_id'] = $data['Customer']['business_id'];
					$data['BusinessReview']['user_id'] = $data['Customer']['user_id'];
					$data['BusinessReview']['ratingdate']=Date('Y-m-d');
					$data['BusinessReview']['confirmation'] = 1;
		    		        $data['BusinessReview']['authorization'] = 1;
		    		
					if($this->BusinessReview->save($data)){
						$business_review_id=$this->BusinessReview->getLastInsertID();
						$this->loadModel('User');
						$user_email = $this->User->find('first',array('contain'=>false,'conditions'=>array('User.id'=>$data['BusinessReview']['user_id']),'fields'=>array('User.email'))); 
				       		$admin_email = $user_email['User']['email'];
				        	$email = $data['Customer']['email'];
				       		$name = $data['Customer']['firstname']. ' '. $data['Customer']['lastname'];
						$google = 'www.google.com';
						$threshold = $data['feedbackthreshold'];
						$business_email_template_id = $data['BusinessReview']['business_id'];
						if($this->request->data['BusinessReview']['ratingstar'] > $threshold){
							 $content=$this->getEmailcontent($business_email_template_id,3);
							 $replace=array('$customername'=>$name,'{{google}}'=>$google);
							 $content=strtr($content, $replace);
							 $this->sendEmail($content,"support@repmgsys.com",$email,'GET REVIEWS RESPONSE');
							 $content="<table>
									  <tr><td>You recieved a Business Review please check.!</td></tr>
								   </table>";
							 $this->sendEmail($content,"support@repmgsys.com",$admin_email,'GET REVIEWS RESPONSE');
							 $this->redirect(array('controller'=>'dashboard','action'=>'thanksToCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($data['Customer']['business_id']),'business_review_id'=>base64_encode($business_review_id))));
						
						}else{
							$content=$this->getEmailcontent($business_email_template_id,4);
				            		$replace=array('$customername'=>$name);
				           		$content=strtr($content, $replace);

				               $this->sendEmail($content,"support@repmgsys.com",$email,'GET REVIEWS RESPONSE');
				               $this->Session->setFlash('Your Review has been shared with us please check email.');
			                       $content="<table>
					          
	                           			 <tr><td>You recieved a Business Review please check.!</td></tr>
				            
				          	      </table>";
				               $this->sendEmail($content,"support@repmgsys.com",$admin_email,'GET REVIEWS RESPONSE');
				               $this->redirect(array('controller'=>'dashboard','action'=>'thanksToNegativeCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($data['Customer']['business_id'])))); 
						}
						
						
					}
				}else{
					      $this->Session->setFlash(__('Review could not be saved. Please, try again.'));
					      $this->redirect($this->referer());
				}
			}

	}

	function validEmail($busid=NULL){
		
		$this->autoRender = false;
		$email = trim($_REQUEST['data']['Customer']['email']);
		$this->loadModel('Customer');
		$count = $this->Customer->find('count',array('conditions'=>array('Customer.email'=>$email,'Customer.business_id'=>$busid)));
		
		if($count>1)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
	}

	public function onlineReviewPlugin($businessid=null,$pageno = null)
	{

		      $busid = $businessid;
		      $reviews=array();
              $this->loadModel('onlineReviewPlugin');
              $this->loadModel('onlineReview');
              $onlineReviews = $this->onlineReviewPlugin->find('all',array('conditions'=>array('onlineReviewPlugin.business_id'=>$businessid)));

              $onlinereviews = array();

              foreach ($onlineReviews as $key => $value) 
              {

              $onlinereviews[] = $this->onlineReview->find('all',array('conditions'=>array(
              	'onlineReview.business_id'=>$busid,'onlineReview.social_media_id'=>$value['onlineReviewPlugin']['social_media_id']),'order'=>'onlineReview.id DESC'));  
              }  
              

              $returnReviews = array();

              foreach ($onlinereviews as $key=>$value) {
                       foreach ($value as $val) {
                        $returnReviews[] = $val;
                       }
               }
               if($pageno ){
               		$result['page']=$pageno;
               	    $maxlimit=$pageno * 10;
               	    $minlimit = (($pageno - 1)*10);
               }else{
                $pageno = 1;		$result['page']=1;
               	$maxlimit=$pageno * 10;
           	    $minlimit = (($pageno - 1)*10);
               }
               $result=array();
               # Format Review and return

               foreach ($returnReviews as $key => $value) 
               {
               	if($key <= $maxlimit && $key >= $minlimit)
               	{	
               		#print_r($value);
                     $reviews[$key]['cname']=$value['onlineReview']['CustomerFullName'];
                     $reviews[$key]['ratingdescription']=$value['onlineReview']['ratingdescription'];
                     $reviews[$key]['ratingstar']=HTTP_ROOT.'/img/'.$value['onlineReview']['ratingstar'].'stars.png';
                     $reviews[$key]['date']=$value['onlineReview']['updated'];
                     $reviews[$key]['img']=HTTP_ROOT.'/img/social-icons/'.$value['socialMedia']['mediasitename'].'.png';
                }
               else
               {
                 continue;
               }
              }
               $this->loadModel('Business');
               $businessInfo=$this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.id'=>$busid)));
               
           

               ##  $result['business']=$businessInfo['Business'];
               #####
            	$result['business']=array(
            		'name'=>$businessInfo['Business']['businessname'],
            		'logo'=>$businessInfo['Business']['business_logo'],
            		'description'=>$businessInfo['Business']['business_description'].'Today will come safkdslkfjldskjflksjflkjdsafjldsakjf',
					'address'=>$businessInfo['Business']['addressline1'].''.$businessInfo['Business']['addressline2'],
            	);



            	
            	$result['reviews']=$reviews;
            	header("Access-Control-Allow-Origin: *");
               echo json_encode($result);die;
    }
																																													
}

?>
