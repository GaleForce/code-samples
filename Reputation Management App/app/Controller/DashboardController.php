<?php
App::uses('AppController', 'Controller');
/**
 * Dashboard Controller
 *
 * @property Dashboard $Dashboard
 * @property PaginatorComponent $Paginator
 */
class DashboardController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Resize');
        
          function beforeFilter()
           {
            parent::beforeFilter();
			$this->Auth->allow('postReview','thanksToCustomer','thanksToNegativeCustomer'); 
           }
           public function pdf()
	{
        $uid=$this->routing();
        $this->autoRender=false;
		   if($uid)
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
		 else{
		 		$this->Session->setFlash('You are not authorized to access that location.','error');
				$this->redirect($this->referer());
		 }		

	}
}

/**
 * index method
 *
 * @return void
 */
	public function index() {
	
		if($this->Session->read('Auth.User.usertype')=='reseller'){
				if($this->Session->read('Auth.User')) {
		             $session = $this->Session->read('Auth.User');
		            if($session['usertype'] == 'subscriber')
		            { 
						$this->routing();
		            }
	   	        }
				$this->loadModel('Business');
				$this->Business->recursive = 0;
				$this->paginate = array('limit'=>'15','contain'=>'User','order'=>array('Business.id'=>'DESC'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0));
				$this->set('businesses',$this->paginate('Business'));
				$businessesdata=$this->Business->find('all',array('contain'=>'User','order'=>array('Business.id'=>'DESC'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0, 'Business.totalReviews !='=>0)));
				
		  
				$this->set('businessesdata',$businessesdata);
		}else{
			$this->Session->setFlash('You are not authorized user to access that location.','error');
			$this->redirect($this->referer());
		}
	}
    

     public function subscriber() 
    {
      if($this->Session->read('Auth.User')) 
                               {
                                 $session = $this->Session->read('Auth.User');
                                if($session['usertype'] == 'reseller')
                                 { 
				 $this->routing();
                                }
                        } 
      
     
		 

	}
	 
    
    private function fbSite($data){
    	if(!empty($data)){
    		// pr($data);die;
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			if(isset($curlResult->data[0]->reviewer->id)){
				// pr($curlResult->data[0]->reviewer->id);die;
				$status=true;
			}else{
				$status=false;
			}
			curl_close($ch);
			if(isset($curlResult->error) || !$curlResult || !$status){
				$data['Visibility']['status']='error';
			}else{
				// $check=$this->checkurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }else{
					$pageId=explode('/', $data['Visibility']['url']);
					$data['Visibility']['status']='visible';	
					$data['Visibility']['pageurl']='https://www.facebook.com/'.$pageId[0];
				// }
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
			
    	}else{
    		$this->Session->setFlash('Unable to add facebook url. Please try again.','error');
    	}
    }

    private function gplus($data){
    	if(!empty($data)){
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			//pr($curlResult->result->url);die;
			curl_close($ch);
			if(isset($curlResult->error_message) || !$curlResult || $curlResult->status!='OK'){
				$data['Visibility']['status']='error';
			}else{
				$check=$this->checkurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }else{
					$data['Visibility']['status']='visible';
					$data['Visibility']['pageurl']=@$curlResult->result->url;
					//pr($data);die;

				// }
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
			
    	}else{
    		$this->Session->setFlash('Unable to add Google Plus url. Please try again.','error');
    	}
    }  

    private function Fourelevencom($data){
    	if(!empty($data)){
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			
			curl_close($ch);
			if(isset($curlResult->results) && $curlResult ){
				$data['Visibility']['status']='visible';
				$check=$this->checkurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }
			}else{
					$data['Visibility']['status']='error';
			}
			//pr($data);die;
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
			
    	}else{
    		$this->Session->setFlash('Unable to add Google Plus url. Please try again.','error');
    	}
    } 

    private function Avvo($data){
    	if(!empty($data)){
			$url=$data['Visibility']['prefixurl'].rtrim($data['Visibility']['url'],'/').'/reviews.json';
			$ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, Avvo_User . ":" . Avvo_Pass);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$curlResult=json_decode(curl_exec($ch));
			// pr($curlResult);die;
			curl_close($ch);
			if(isset($curlResult[0]) && $curlResult && isset($curlResult[0]->id)){
				// $check=$this->checkurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }
				$data['Visibility']['status']='visible';
				$pageurl=explode('#', $curlResult[0]->url);
				$data['Visibility']['pageurl']=@$pageurl[0];
			}else{
				$data['Visibility']['status']='error';
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
			
    	}else{
    		$this->Session->setFlash('Unable to add Google Plus url. Please try again.','error');
    	}
    }

    public function checkurl($url){
    	$this->loadModel('Visibility');
    	$count=$this->Visibility->find('count',array('conditions'=>array('Visibility.url'=>$url,'Visibility.status'=>'visible')));
    	if($count>0){
    		return true;
    	}else{
    		return false;
    	}
    }
    public function checkinsiderurl($url){
    	$this->loadModel('Visibility');
    	$count=$this->Visibility->find('count',array('conditions'=>array('Visibility.url'=>$url,'Visibility.status'=>'visible','NOT'=>array('Visibility.social_media_id'=>array(5,7)))));
    	if($count>0){
    		return true;
    	}else{
    		return false;
    	}
    }
   public function checkcitysearchurl($url){
    	$this->loadModel('Visibility');
    	$count=$this->Visibility->find('count',array('conditions'=>array('Visibility.url'=>$url,'Visibility.status'=>'visible','NOT'=>array('Visibility.social_media_id'=>array(6,7)))));
    	if($count>0){
    		return true;
    	}else{
    		return false;
    	}
    }
   public function checkJudyurl($url){
    	$this->loadModel('Visibility');
    	$count=$this->Visibility->find('count',array('conditions'=>array('Visibility.url'=>$url,'Visibility.status'=>'visible','NOT'=>array('Visibility.social_media_id'=>array(5,6)))));
    	
    	if($count>0){
    		return true;
    	}else{
    		return false;
    	}
    }
  
  private function citysearch($data){
    	if(!empty($data)){
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
		//	pr($curlResult);die;
			$count=0;
			if(isset($curlResult->results->reviews) && !empty($curlResult->results->reviews)){
				foreach ($curlResult->results->reviews as $key => $value) {
					if($value->source=='CITYSEARCH' && $value->source_id=='131'){
						$count++;
					}else{
						continue;
					}
				}
			}
			// pr($count);die;
			curl_close($ch);
			if($count==0){
				$data['Visibility']['status']='error';
			}else{
				// $check=$this->checkcitysearchurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }else{
					$data['Visibility']['status']='visible';
				// }
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
    	}else{
    		$this->Session->setFlash('Unable to add Citysearch url. Please try again.','error');
    	}
    }  
  private function insiderpages($data){
    	if(!empty($data)){
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			$count=0;
			if(isset($curlResult->results->reviews) && !empty($curlResult->results->reviews)){
				foreach ($curlResult->results->reviews as $key => $value) {
					if($value->source=='INSIDERPAGES' && $value->source_id=='17'){
						$count++;
					}else{
						continue;
					}
				}
			}
			// pr($count);die;
			curl_close($ch);
			if($count==0){
				$data['Visibility']['status']='error';
			}else{
				// $check=$this->checkinsiderurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }else{
					$data['Visibility']['status']='visible';
				// }
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
    	}else{
    		$this->Session->setFlash('Unable to add Insider Pages url. Please try again.','error');
    	}
    }  
    private function judysbook($data){
    	if(!empty($data)){
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			$count=0;
			if(isset($curlResult->results->reviews) && !empty($curlResult->results->reviews)){
				foreach ($curlResult->results->reviews as $key => $value) {
					if(str_replace(' ', '', str_replace("'", '', $value->source))=="JudysBook" && $value->source_id=='13'){
						$count++;
					}else{
						continue;
					}
				}
			}
			// pr($count);die;
			curl_close($ch);
			if($count==0){
				$data['Visibility']['status']='error';
			}else{
				// $check=$this->checkJudyurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }else{
					$data['Visibility']['status']='visible';
				// }
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
    	}else{
    		$this->Session->setFlash('Unable to add Insider Pages url. Please try again.','error');
    	}
    }     
   public function validateYelp($yelpdata)
    {
    	if(!empty($yelpdata)){
    		require(APP . 'Vendor' . DS  . 'yelp' . DS . 'v2' . DS .'php' . DS .'lib' . DS . 'OAuth.php');
                    $count = 0;
                    $business_id = $yelpdata['Visibility']['business_id'];
			        $business_url = $yelpdata['Visibility']['url'];
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
						    $data = json_decode($data);//pr($data);die;
						    if(!empty($data->reviews[0]))
						    {
						    	$count++;
                            }
              if($count==0){
				$yelpdata['Visibility']['status']='error';
			}else{
				// $check=$this->checkYelpExist($yelpdata);
				// if($check){
				// 	return false;
				// }else{
					$yelpdata['Visibility']['status']='visible';
				// }
			}
			$this->loadModel('Visibility'); 
			$yelpdata['Visibility']['prefixurl'] = $yelpdata['Visibility']['url'];
			 
	        if($this->Visibility->save($yelpdata['Visibility'])){
				return true;
			}else{
				return false;
			}
    	}else{
    		$this->Session->setFlash('Unable to add Yelp url. Please try again.','error');
    	}

    } 
    public function checkYelpExist($yelpdata){
    	$this->loadModel('Visibility');
    	$count=$this->Visibility->find('count',array('conditions'=>array('Visibility.url'=>$yelpdata['Visibility']['url'],'Visibility.status'=>'visible','Visibility.business_id'=>$yelpdata['Visibility']['business_id'])));
    	if($count>0){
    		return true;
    	}else{
    		return false;
    	}
    }
    public function twitter($data){
    	if(!empty($data)){
    		$settings = array(
			    'oauth_access_token' => twitter_oauth_access_token,
			    'oauth_access_token_secret' => twitter_oauth_access_token_secret,
			    'consumer_key' => twitter_consumer_key,
			    'consumer_secret' => twitter_consumer_secret
			);
    		require(APP . 'Vendor' . DS  . 'twitter' . DS . 'TwitterAPIExchange.php');
    		$url=$data['Visibility']['prefixurl'];
    		$getfield = '?screen_name='.trim($data['Visibility']['url']).'&count=50';
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$result=json_decode($twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest());
			if(getType($result)!='object' && (empty($result) || isset($result[0]->id))){
				// $check=$this->checkurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }
				$data['Visibility']['status']='visible';
				if(isset($result[0]->user->screen_name)){
					$data['Visibility']['pageurl']=$result[0]->user->screen_name;
				}else{
					$data['Visibility']['pageurl']='';
				}
				
			}else{
					$data['Visibility']['status']='error';
			}
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
        }else{
        	$this->Session->setFlash('Unable to add Twitter url. Please try again.','error');
        }
    }  

    private function whitePages($data){
    	if(!empty($data)){
    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
			$url=$data['Visibility']['prefixurl'].$data['Visibility']['url'];
			curl_setopt($ch, CURLOPT_URL,$url);
			$curlResult = json_decode(curl_exec($ch));
			curl_close($ch);
			if(isset($curlResult->results[0]) && $curlResult->results[0]){
				$data['Visibility']['status']='visible';
				// $check=$this->checkurl($data['Visibility']['url']);
				// if($check){
				// 	return false;
				// }
			}else{
					$data['Visibility']['status']='error';
			}
			// pr($data);die;
			$this->loadModel('Visibility');
			if($this->Visibility->save($data['Visibility'])){
				return true;
			}else{
				return false;
			}
			
    	}else{
    		$this->Session->setFlash('Unable to add White Page url. Please try again.','error');
    	}
    } 
 
    public function visibilityAgency($action=null) 
	{	
		 if($this->Auth->user() && $this->Session->read('Auth.User.usertype')=='reseller'){
		   		$this->loadModel('Business');
		   		$businessUsers=$this->Business->find('list',array('conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0),'fields'=>array('Business.businessname')));
		   		
		   		// pr($businessUsers);die;
		   		$this->set('businessUsers',$businessUsers);
		   		$actionArray=array('choosebusiness','Facebook','GooglePlusLocal','Citysearch','411.com','JudysBook','Yelp','InsiderPages','Avvo','Twitter','WhitePages');
		   		if($this->Session->check('agncyBusId') && $this->Session->read('agncyBusId') && !$this->request->is('post')){
		   			$businessUser=$this->Business->find('first',array('contain'=>array('Visibility','User'),'conditions'=>array('Business.id'=>$this->Session->read('agncyBusId'))));
		   		}elseif($this->request->is('post') && in_array($action,$actionArray)){
		   			$businessUser=$this->Business->find('first',array('contain'=>array('Visibility','User'),'conditions'=>array('Business.id'=>$this->request->data['Business']['id'])));
		   			if($this->Session->check('agncyBusId'))
		   				$this->Session->delete('agncyBusId');
		   		}else{
		   			$businessUser=$this->Business->find('first',array('contain'=>array('Visibility','User'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'))));
		   			if($this->Session->check('agncyBusId'))
		   				$this->Session->delete('agncyBusId');
		   		}

            	if(!empty($businessUser)){
	            	$media=array();
	            	$mediaurl=array();
	            	foreach ($businessUser['Visibility'] as $key => $value) {
	            		//pr($businessUser);die;
	            		if($value['status']=='visible' || $value['status']=='error'){
	            			$media[$value['id']]=$value['socialmediaName'];
		            		$media[$value['socialmediaName']]=$value['url'];
		            		$media[$value['socialmediaName'].'status']=$value['status'];
		            		$media[$value['socialmediaName'].'checker']=$value['checkerType'];
	            		}else{
	            			continue;
	            		}
	            		
	            	}
	            	//pr($media);die;
	            	$this->loadModel('SocialMedia');
                
                $this->loadModel('BusinessSocialMedia');
                   $social_media_directory = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'visibilitychecker','SocialMedia.accounttype'=>'DirectoryListing','SocialMedia.status'=>1)));

              
                $social_site = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'SocialSite','SocialMedia.status'=>1)));
              	
              	$Review_site = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'ReviewSite','SocialMedia.status'=>1)));
              
                $SearchEngine = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'visibilitychecker','SocialMedia.accounttype'=>'SearchEngine','SocialMedia.status'=>1))); 
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
			//$missing=$countSm-$error-$accurate;
	            	$this->set(compact('percentage','accurate','error','missing'));
	            	$this->set('businessUser',$businessUser);
	            	$this->set('media',$media);
	            	if($this->request->is('post')){
	            			switch ($action) {
		            		case 'Facebook':
		            		    $this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=13;
		            			if($this->fbSite($this->request->data)){
		            				$this->Session->setFlash('Facebook url added successfully.','success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Facebook url is already exist. Please try with another url.','error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}	
		            			break;
		            		case 'GooglePlusLocal':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=2;
		            			if($this->gplus($this->request->data)){
		            				$this->Session->setFlash('Google Plus url added successfully.','success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Google Plus url is already exist. Please try with another url.','error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            		case 'Citysearch':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=5;
		            			if($this->citysearch($this->request->data)){
		            				$this->Session->setFlash('City Search url added successfully.','success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('City Search url is already exist. Please try with another url.','error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}
		            			break;
		            		case 'InsiderPages':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=6;
		            			if($this->insiderpages($this->request->data)){
		            				$this->Session->setFlash('Insider Pages url added successfully.','success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Insider Pages url is already exist. Please try with another url.','error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            		case 'JudysBook':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=7;
		            			if($this->judysbook($this->request->data)){
		            				$this->Session->setFlash("Judy's Book url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Judy's Book url is already exist. Please try with another url.",'error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            		case '411.com':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=17;
		            			if($this->Fourelevencom($this->request->data)){
		            				$this->Session->setFlash("411.com url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("411.com url url is already exist. Please try with another url.",'error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}
		            			break;
		            		case 'Yelp':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=12;
		            		    if($this->validateYelp($this->request->data)){
		            				$this->Session->setFlash("Yelp url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Yelp url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;
		            		case 'Avvo':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=4;
		            		    if($this->Avvo($this->request->data)){
		            				$this->Session->setFlash("Avvo url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Avvo url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            		case 'Twitter':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=16;
		            		    if($this->twitter($this->request->data)){
		            				$this->Session->setFlash("Twitter url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Twitter url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;		
		            		case 'WhitePages':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=31;
		            		    if($this->whitePages($this->request->data)){
		            				$this->Session->setFlash("Whitepages url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Whitepages url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;				
		            		default:
		            			break;
		            	}
	            	}
            }  	
		   }else{
		   	     $this->Session->setFlash('You are not authorized to access that location.','error');
		   		 $this->redirect($this->referer());	
		   }
	
	}

    public function find_business()
    { 
    	$this->loadModel('Business');
    	$this->loadModel('User');
        $business_id = @trim($_REQUEST['data']['Business']['agency_id']);
        
       	$user_data = $this->Business->find('first',array('conditions'=>array('Business.id'=>$business_id)));
       	//pr($user_data);die;
        $this->set('user_data',$user_data);
        $businessesdata=$this->Business->find('all',array('contain'=>false,'order'=>array('Business.id'=>'DESC'),'fields'=>array('Business.id','Business.businessname','Business.totalReviews','Business.lastReviewdate','Business.averageRating'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0)));
		
		$this->set('businessesdata',$businessesdata);	
         

    }

	public function contactManager()
	{
		   $uid=$this->routing();
		   if($uid){
		   	$this->Session->write('ajax_business_id',$uid);
		   	$this->loadModel('BusinessReview');
	     	$this->loadModel('Business');
	     	$this->loadModel('Customer');
                $this->loadModel('BusinessEmployee');
	     	$business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id','businessname'),'recursive'=>0));
 	        $emps=$this->BusinessEmployee->find('all',array('conditions'=>array('User.usertype'=>'employee','User.status'=>1,'BusinessEmployee.business_id'=>$business_id['Business']['id'])));
 	        $this->set('emps',$emps);    
	     	$b_id = $this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$uid),'fields'=>array('Business.id','Business.businessname')));

	     	 $user_id = $uid;
	      $this->paginate = array('limit'=>'15','conditions' => array('Customer.business_id'=>$b_id['Business']['id'],'Customer.is_delete'=>0),'order' =>'Customer.id DESC');
             
			$this->set('businessuserreview',$this->paginate('Customer'));
			$this->set('business_name',$b_id['Business']['businessname']);
	        if($this->request->is('post'))
		   	{
		   		$name = @$this->data['searchby']['text'];
			        if($name != '')
			        {  
			        				$this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'Customer.business_id'=>$b_id['Business']['id'],'Customer.is_delete'=>0,'OR'=>array('Customer.firstname LIKE' => "%$name%",'Customer.lastname LIKE' => "%$name%",'Customer.email LIKE' => "%$name%")));	
								    $this->set('businessuserreview',$this->paginate('Customer'));
			      					$this->set('business_name',$b_id['Business']['businessname']);
                                                                $this->set('searchText',$name);
					}
					if(@$this->data['searchbystar'] != '')
					{
						foreach ($this->data['searchbystar'] as $key => $value) {
						 $rating = $value;
						}
									$this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'Customer.business_id'=>$b_id['Business']['id'],'Customer.ratingstar'=>$rating,'Customer.is_delete'=>0));	
								    $this->set('businessuserreview',$this->paginate('Customer'));
			      					$this->set('business_name',$b_id['Business']['businessname']);
			      					$this->set('rating',$rating);
					}
					if(@$this->data['advancesearch'] != '')
					{
						foreach (@$this->data['advancesearch'] as $key => $value) {
									 $ratingStatus = $value;
						 			 $this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'Customer.business_id'=>$b_id['Business']['id'],'Customer.status'=>$ratingStatus,'Customer.is_delete'=>0,'Customer.ratingstar'=>NULL)); 
			      					
$this->set('businessuserreview',$this->paginate('Customer'));
			      					$this->set('business_name',$b_id['Business']['businessname']);
			      					$this->set('ratingStatus',$ratingStatus);
						}

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
	/*public function addCustomer(){

 	$uid = $this->routing();
 	$this->loadModel('Business');
    	$this->loadModel('BusinessEmployee');
   	$business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id','businessname'),'recursive'=>0));
 	$emps=$this->BusinessEmployee->find('all',array('conditions'=>array('User.usertype'=>'employee','User.status'=>1,'BusinessEmployee.business_id'=>$business_id['Business']['id'])));
 	
 	$this->set('emps',$emps);
     	if($uid){		
         
			$this->loadModel('Customer');
			if($this->request->is('post')){
			$this->request->data['Customer']['business_id'] = $business_id['Business']['id'];
			$this->request->data['Customer']['user_id'] = $uid;
			$business_name = $business_id['Business']['businessname'];
			$business_email = $this->Session->read('Auth.User.email');
			
            $user_id = base64_encode($uid);
             
            if(@$this->request->data['Customer']['preview'] == 1){
            	$this->request->data['Customer']['status'] = 'InFeedbackSequence';
            	$this->request->data['Customer']['emailstatuscounter'] = 1;

            }
            else{
                    $this->request->data['Customer']['status'] = 'NotInFeedbackSequence';
            }

			if($this->Customer->save($this->request->data['Customer']));
			{ $todaydate = date("Y-m-d");
                               $customer_id = $this->Customer->getLastInsertId();
                                if(@$this->request->data['Customer']['preview'] == 1)
				{       
					$email = $this->request->data['Customer']['email'];
					$name = $this->request->data['Customer']['firstname']. ' '. $this->request->data['Customer']['lastname'];
					$url=Router::url('/dashboard/postReview?id='.$user_id.'&customer_id='.base64_encode($customer_id), true);
					
                                      
					$eTemplate=$this->getEmailcontent($business_id['Business']['id'],1);
					$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
					$sendername=@$eTemplate['sendername'];
					$sendemail=@$eTemplate['senderemail'];
					$content=$eTemplate['emailcontent'];	
					$subject=@$eTemplate['emailsubject'];
					$receiveremail=$email;
					if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
						  $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
			        	  $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
					else:
						 $this->Session->setFlash('not healty email id','error');
					endif;
				           if(isset($this->request->query['bussiness'])){
                           $qury='?bussiness='.$this->request->query['bussiness'];
                          }else{
                           $qury='';
                           }
                          $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));     


				}
				else
				{
 				$this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));	
				$this->Session->setFlash('Customer has been successfully Added','success');
				if(isset($this->request->query['bussiness'])){
                           $qury='?bussiness='.$this->request->query['bussiness'];
                          }else{
                           $qury='';
                           }
                          $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
			   }
			}
			}
			$this->loadModel('BusinessEmployee');
			$employee = $this->BusinessEmployee->find('list',array('conditions'=>array('BusinessEmployee.user_id'=>$this->Session->read('Auth.User.id')),'fields'=>array('id','emp_name')));
			$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
            $us = $countries[1];
			unset($countries[1]);
			$countries[1] = $us;
	     	$this->set(compact('employee', 'countries'));  
    }
    else
      {
            $this->Session->setFlash('You are not authorized to access that location.','error');
            if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));	
     }
    } */
public function addCustomer()
 {
	    $uid = $this->routing();
	 	$this->loadModel('Business');
		$this->loadModel('BusinessEmployee');
	   	$business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id','businessname'),'recursive'=>0));
	 	$emps=$this->BusinessEmployee->find('all',array('conditions'=>array('User.usertype'=>'employee','User.status'=>1,'BusinessEmployee.business_id'=>$business_id['Business']['id'])));
	 	$this->set('emps',$emps);
	     	if($uid)
	     	{		
	            $this->loadModel('Customer');
				if($this->request->is('post'))
				{  
				$this->request->data['Customer']['business_id'] = $business_id['Business']['id'];
				$this->request->data['Customer']['user_id'] = $uid;
				$business_name = $business_id['Business']['businessname'];
				$business_email = $this->Session->read('Auth.User.email');
				$user_id = base64_encode($uid);
	            if((@$this->request->data['Customer']['preview'] == 1) && (@$this->request->data['Customer']['permission_to_email'] =='on'))
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
						$email = $this->request->data['Customer']['email'];
						$name = $this->request->data['Customer']['firstname']. ' '. $this->request->data['Customer']['lastname'];
						$url=Router::url('/dashboard/postReview?id='.$user_id.'&customer_id='.base64_encode($customer_id), true);
						$eTemplate=$this->getEmailcontent($business_id['Business']['id'],1);
						$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
						$sendername=@$eTemplate['sendername'];
						$sendemail=@$eTemplate['senderemail'];
						$content=$eTemplate['emailcontent'];	
						$subject=@$eTemplate['emailsubject'];
						$receiveremail=$email;
						if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
							  $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
				        	  $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
						else:
							 $this->Session->setFlash('not healty email id','error');
						endif;
					           if(isset($this->request->query['bussiness']))
					           {
	                           $qury='?bussiness='.$this->request->query['bussiness'];
	                          }
	                          else
	                          {
	                           $qury='';
	                           }
	                          $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));     
	               }
				else
				{
	 				$this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));	
					$this->Session->setFlash('Customer has been successfully Added','success');
					if(isset($this->request->query['bussiness']))
					{
	                           $qury='?bussiness='.$this->request->query['bussiness'];
	                          }
	                          else
	                          {
	                           $qury='';
	                           }
	                  $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
				   }
				}
				}
				$this->loadModel('BusinessEmployee');
				$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
	            $us = $countries[1];
				unset($countries[1]);
				$countries[1] = $us;
		     	$this->set(compact('employee', 'countries'));  
	    }
	    else
        {
	            $this->Session->setFlash('You are not authorized to access that location.','error');
	            if(isset($this->request->query['bussiness']))
	            {
	            $qury='?bussiness='.$this->request->query['bussiness'];
	            }
	            else
	            {
	                $qury='';
	            } 
			    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));	
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
											$this->Session->setFlash('Your reviews has been shared with us','success');
										  
											$this->redirect(array('controller'=>'dashboard','action'=>'thanksToCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id),'business_review_id'=>base64_encode($business_review_id))));
				                     
									endif;
                                             

                      									
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
													
													$this->redirect(array('controller'=>'dashboard','action'=>'thanksToNegativeCustomer',"?" => array("customer_id" => base64_encode($customer_id),"business_id" => base64_encode($business_id)))); 
				                                     $this->Session->setFlash('Your reviews has been shared with us','success');
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
		    	/*$sites=$this->Visibility->find('all',array('conditions'=>array('Visibility.business_id'=>$business_id,'Visibility.status'=>'visible','Visibility.pageurl !='=>'')));
		    	$this->set('sites',$sites);*/
		    	$this->loadModel('BusinessSitePromotion');
		    	$sites=$this->BusinessSitePromotion->find('all',array('conditions'=>array('BusinessSitePromotion.status'=>1,'BusinessSitePromotion.business_id'=>$business_id)));
		    	$this->set('sites',$sites);
		    	//pr($sites);die;	
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
public function startfeedback()
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
            $user_id = base64_encode($this->Session->read('ajax_business_id'));
            for($i = 0;$i < count($customerid);$i++)
        	{
	    		      $customer_data = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$customerid[$i],'Customer.status'=>'NotInFeedbackSequence'),'fields'=>array('Customer.email','Customer.firstname','Customer.lastname','Customer.business_id')));
	        		  if(!empty($customer_data))
	                   {
							$business_name = $this->Business->find('first',array('fields'=>array('id','businessname','feedbackthreshold'),'conditions'=>array('Business.id'=>$customer_data['Customer']['business_id'])));
						 	$business_name = $business_name['Business']['businessname'];
						 	$business_email = $this->Session->read('Auth.User.email');
		    		 		$email = $customer_data['Customer']['email'];
		    		 		$name = $customer_data['Customer']['firstname']. ' '. $customer_data['Customer']['lastname'];
							$url=Router::url('/dashboard/postReview?id='.$user_id.'&customer_id='.base64_encode($customerid[$i]),true);
							$eTemplate=$this->getEmailcontent($customer_data['Customer']['business_id'],1);
						   	$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_email'=>$business_email,'$business_name'=>$business_name,'$reviewurl'=>$url);
		                    $sendername=@$eTemplate['sendername'];
						    $sendemail=@$eTemplate['senderemail'];
						    $content=$eTemplate['emailcontent'];	
						    $subject=@$eTemplate['emailsubject'];
						    $receiveremail=$email;
		                    $this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace);	
			                ++$success_rate;
				             $this->Customer->updateAll(array('Customer.status' => '"InFeedbackSequence"','Customer.emailstatuscounter'=>'Customer.emailstatuscounter + 1','Customer.cronssentemaildate'=>"'$todaydate'",'Customer.preview'=>1,'Customer.preview'=>1,'Customer.permission_to_email'=>1),array('Customer.id' => $customerid[$i]));
	                        
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
             } 
             else
		      {
	           	$this->Session->setFlash('Emial Not Sent Please Check Status "NotInFeedbackSequence"','error');
	           	$this->Session->write('email',$emils);
	            die; 
       		  } 
       }
   }
 public function onlineReviewSite()
  {
  	$this->loadModel('Business'); 
  	$uid=$this->routing();
   if($uid)
   {
   	if($this->request->is('post'))
   	{
      if($this->Business->save($this->data));
       $this->Session->setFlash('Thresholds And Others has been updated.','success');
        if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'businesSetup/'.$qury));
   	}
   	else
   	{
   		
   		$businfo = $this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.user_Id'=>$uid),'fields'=>array('Business.id','Business.feedbackthreshold','Business.automatedenailattempts','Business.emailfrequency','Business.automatedpostfeedbackenailattempts','Business.postfeedbackemailfrequency')));
        //pr($businfo);die;
        $this->set('data',$businfo);


   	}
      

   }
   else
		   {
		   	$this->Session->setFlash('You are not authorized to access that location.','error');
            if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'businesSetup/'.$qury));	
		   }

  





  }



 
 
/*public function editCustomer($customerid = null)
{
 $uid = $this->routing(); 
  if( $uid )
	{    
			    $this->loadModel('Customer');
			    $this->loadModel('State');
			    $this->loadModel('Country');
               		    $this->loadModel('City');  
			    $this->loadModel('Business');
				if($this->request->is('post')) 
				{
	              if(@$this->request->data['Customer']['preview'] == 1){
	            	$this->request->data['Customer']['status'] = 'InFeedbackSequence';
	            	$this->request->data['Customer']['emailstatuscounter'] = 1;

	            }
	            else{
	                    $this->request->data['Customer']['status'] = 'NotInFeedbackSequence';
	            }		
	 

				if($this->Customer->save($this->request->data['Customer']))
				{ 
                     $todaydate = date("Y-m-d");

                    $customer_id = $this->data['Customer']['id'];
                    if($this->request->data['Customer']['preview'] == 1)
					{       $user_id = base64_encode($uid);
						$email = $this->request->data['Customer']['email'];
						$name = $this->request->data['Customer']['firstname']. ' '. $this->request->data['Customer']['lastname'];
						$url=Router::url('/dashboard/postReview?id='.$user_id.'&customer_id='.base64_encode($customer_id), true);
						$bus = $this->Business->find('first',array('fields'=>array('id','businessname'),'conditions'=>array('Business.id'=>$this->data['Customer']['business_id'])));
						$business_name = $bus['Business']['businessname'];
						$business_email = $this->Session->read('Auth.User.email');

					 
							$eTemplate=$this->getEmailcontent($bus['Business']['id'],1);
							$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
							$sendername=@$eTemplate['sendername'];
							$sendemail=@$eTemplate['senderemail'];
							$content=$eTemplate['emailcontent'];	
							$subject=@$eTemplate['emailsubject'];
							$receiveremail=$email;
							if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
								  $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
					        	  $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
							else:
								 $this->Session->setFlash('not saved email id','error');
							endif;         

				
				   if(isset($this->request->query['bussiness'])){
	                           $qury='?bussiness='.$this->request->query['bussiness'];
	                          }else{
	                           $qury='';
	                           }
	                          $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));     
                }
                else
                {
                  $this->Session->setFlash('Customer has been Updated successfully','success');
						if(isset($this->request->query['bussiness'])){
	                    $qury='?bussiness='.$this->request->query['bussiness'];
	                    }else{
	                        $qury='';
	                    } 
			             $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
					}
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
			   $this->loadModel('BusinessEmployee');
			   $this->loadModel('Business');
			   $business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>0));
			   $employee=$this->BusinessEmployee->find('all',array('contain'=>array('User'),'conditions'=>array('User.usertype'=>'employee','User.status'=>1,'BusinessEmployee.business_id'=>$business_id['Business']['id'])));
			   
			   $this->set('employee',$employee);	 
			 	
	 }
	 else
	 {
	$this->Session->setFlash('You are not authorized to access that location.','error');
	if(isset($this->request->query['bussiness'])){
	$qury='?bussiness='.$this->request->query['bussiness'];
	        }else{
	            $qury='';
	        } 
	$this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));

			 }

}*/
public function editCustomer($customerid = null)
{
 $uid = $this->routing(); 
  if( $uid )
	{    
			    $this->loadModel('Customer');
			    $this->loadModel('State');
			    $this->loadModel('Country');
                $this->loadModel('City');  
			    $this->loadModel('Business');
				if($this->request->is('post')) 
				{  
	              if((@$this->request->data['Customer']['preview'] == 1) && (@$this->request->data['Customer']['permission_to_email'] == 'on'))
	              {
                    $this->request->data['Customer']['status'] = 'InFeedbackSequence';
	            	$this->request->data['Customer']['emailstatuscounter'] = 1;
	            	$this->request->data['Customer']['permission_to_email'] = 1;
                   }
                   else if(!(isset($this->request->data['Customer']['preview'])) && (!isset($this->request->data['Customer']['permission_to_email'])))
	              {
                    
	            	$this->request->data['Customer']['status'] = 'InFeedbackSequence';
	            	$this->request->data['Customer']['emailstatuscounter'] = 1;
	            	$this->request->data['Customer']['permission_to_email'] = 1;
                   }
                   else
	                {
                     $this->request->data['Customer']['status'] = 'NotInFeedbackSequence';
       			 	}		
	 

				if($this->Customer->save($this->request->data['Customer']))
				{ 
                     $todaydate = date("Y-m-d");

                    $customer_id = $this->data['Customer']['id'];
                   if((@$this->request->data['Customer']['preview'] == 1) && (@$this->request->data['Customer']['permission_to_email'] == 1))
					{   $user_id = base64_encode($uid);
						$email = $this->request->data['Customer']['email'];
						$name = $this->request->data['Customer']['firstname']. ' '. $this->request->data['Customer']['lastname'];
						$url=Router::url('/dashboard/postReview?id='.$user_id.'&customer_id='.base64_encode($customer_id), true);
						$bus = $this->Business->find('first',array('fields'=>array('id','businessname'),'conditions'=>array('Business.id'=>$this->data['Customer']['business_id'])));
						$business_name = $bus['Business']['businessname'];
						$business_email = $this->Session->read('Auth.User.email');
                        $eTemplate=$this->getEmailcontent($bus['Business']['id'],1);
						$replace=array('$cusotmername'=>$name,'$customeremail'=>$email,'$business_name'=>$business_name,'$business_email'=>$business_email,'$reviewurl'=>$url);
						$sendername=@$eTemplate['sendername'];
						$sendemail=@$eTemplate['senderemail'];
						$content=$eTemplate['emailcontent'];	
						$subject=@$eTemplate['emailsubject'];
						$receiveremail=$email;
						if($this->_sendingEmail($sendername,$senderemail=0,$receiveremail,$subject,$content,$replace)):
					    $this->Customer->updateAll(array('Customer.cronssentemaildate'=>"'$todaydate'"), array('Customer.id' => $customer_id));
		        	    $this->Session->setFlash('Customer has been successfully Added and also Sent A initialy feedback sequence','success');
						else:
					    $this->Session->setFlash('not saved email id','error');
						endif;         
                        if(isset($this->request->query['bussiness']))
                        {
	                           $qury='?bussiness='.$this->request->query['bussiness'];
	                          }
	                          else
	                          {
	                           $qury='';
	                           }
                      $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));     
            	}
                else
                {
                  $this->Session->setFlash('Customer has been Updated successfully','success');
						if(isset($this->request->query['bussiness']))
						{
	                    $qury='?bussiness='.$this->request->query['bussiness'];
	                    }
	                    else
	                    {
	                        $qury='';
	                    } 
			             $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
					}
	              }
				}
		      $c_id = base64_decode($customerid);
		      $info = $this->Customer->find('first',array('conditions'=>array('Customer.id'=>$c_id),'contain'=>array('Country','State','City')));
		      //pr($info);die;
		      $this->set('info',$info);
		       $countries = $this->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
		       $states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
                        $cities= $this->City->find('list',array('fields'=>array('id','city_name'),'conditions'=>array('City.state_id'=>$info['State']['id']),'order'=>array('city_name ASC')));
                           $this->set('cities',array_unique($cities));
			   $this->set('countries',$countries); 
			   $this->set('states',$states); 
			   $this->loadModel('BusinessEmployee');
			   $this->loadModel('Business');
			   $business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>0));
			   $employee=$this->BusinessEmployee->find('all',array('contain'=>array('User'),'conditions'=>array('User.usertype'=>'employee','User.status'=>1,'BusinessEmployee.business_id'=>$business_id['Business']['id'])));
			   
			   $this->set('employee',$employee);	 
			 	
	 }
	 else
	 {
	$this->Session->setFlash('You are not authorized to access that location.','error');
	if(isset($this->request->query['bussiness'])){
	$qury='?bussiness='.$this->request->query['bussiness'];
	        }else{
	            $qury='';
	        } 
	$this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));

			 }

}
	public function deleteCustomer($customerid = null)
	{    $uid = $this->routing();
		if( $uid )
		{   
		     $c_id = base64_decode($customerid);
		    // pr($c_id);die;
			 $this->loadModel('Customer');
			 $this->loadModel('BusinessReview');
			 $customer_business_id = $this->Customer->find('first',array('contain'=>false,'conditions'=>array('Customer.id'=>$c_id),'fields'=>array('Customer.business_id')));
			 $customers_businesss_id = $customer_business_id['Customer']['business_id'];
	         if($this->Customer->updateAll(array('Customer.is_delete' => 1),array('Customer.id'=>$c_id)))
			 {   
                    $this->BusinessReview->deleteAll(array('BusinessReview.customer_id' => $c_id,'BusinessReview.business_id'=>$customers_businesss_id), false);
			 		$this->Session->setFlash('Customer has been successfully Deleted','success');
					if(isset($this->request->query['bussiness'])){
                   $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
			 }
	   }
	   else{
	   	   $this->Session->setFlash('You are not authorized to access that location.','error');
            if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));

	   }		 
     }
    

  public function feedback()
	{ 
		
		$uid=$this->routing();
        if($uid){ 
            
			$this->loadModel('Business');
			$this->loadModel('BusinessReview');
			$this->loadModel('Onlinereview');
			
	        $this->recursive=2;
	        $business_id = $this->Business->find('first',array('contain'=>array('BusinessSocialMedia'),'conditions'=>array('Business.user_id'=>$uid)));
	     
	        $bussites=array();
	        foreach ($business_id['BusinessSocialMedia'] as $key => $value) {
	          	$bussites[]= $value['social_media_id'];
	          }  
	       
           	$businessuserreview = $this->BusinessReview->find('all',array('conditions'=>array('BusinessReview.business_id'=>$business_id['Business']['id']),'order' =>'BusinessReview.id DESC','limit'=>4));

             
            $Onlinereview = $this->Onlinereview->find('all',array('conditions'=>array('Onlinereview.business_id'=>$business_id['Business']['id'],'Onlinereview.social_media_id'=>$bussites),'order'=>'Onlinereview.id DESC'));

             
          $social_media_ids=array();
          foreach(@$Onlinereview as $key=>$value)
          {
            $social_media_ids[]=$value['Onlinereview']['social_media_id'];
   
          }
          $remainingsitesIds=array_diff($bussites,array_values(array_unique($social_media_ids)));
          $this->loadModel('SocialMedia');
          $remainingsites=$this->SocialMedia->find('all',array('contain'=>false,'conditions'=>array('SocialMedia.id'=>$remainingsitesIds)));
          //pr($remainingsites);die;
           $rsites=array();         
		 foreach ($remainingsites as $key => $value) {
		 			$rsites[$key][0]=array('totalrating'=>0,'totalcount'=>0,'AverageRating'=>0);
		          	$rsites[$key]['Onlinereview']=array('social_media_id'=>$value['SocialMedia']['id']);
		          	$rsites[$key]['socialMedia']=$value['SocialMedia'];
		   }         
 
		  //$Onlinereview=array_merge($Onlinereview,$rsites);
          
          $total_id = array();
          $total_rating=array();
          for($i = 0;$i < count(@$social_media_ids); $i++)
          {
          	if (in_array($social_media_ids[$i], $total_id, true)) {
                 continue;
                 }
            else{
            	$total_id[] = $social_media_ids[$i]; 
            }
          }
          for($i = 0;$i<count($total_id);$i++)
          {
          	$social_id = $total_id[$i];
            $total_rating[] = $this->Onlinereview->find('first',array('contain'=>array('socialMedia.mediasitename','socialMedia.status'),'fields'=>array('SUM(Onlinereview.ratingstar) AS totalrating','count(Onlinereview.ratingstar) AS totalcount','AVG(Onlinereview.ratingstar) AS AverageRating','Onlinereview.social_media_id'),'conditions'=>array('Onlinereview.social_media_id'=>$social_id,'Onlinereview.business_id'=>$business_id['Business']['id'])));		
          }
		  $this->loadModel('Onlinereview');
	      $this->set('onlineRevs',$Onlinereview);
	      $total_rating=array_merge($total_rating,$rsites);
	      //  pr($total_rating);die;
	      $this->set('Onlinereview',@$total_rating);
	      $this->set('businessuserreview',$businessuserreview);
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
public function onlineFeedBackMoreReview()
{

		$uid=$this->routing();
        if($uid){
            
			$this->loadModel('Business');
			$this->loadModel('BusinessReview');
			$this->loadModel('Onlinereview');
	        $this->recursive=2;
	        $business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>0));
	        $this->paginate = array('limit'=>'10',
								    'conditions' => array(
								    'Onlinereview.business_id'=>$business_id['Business']['id']),'order' =>'Onlinereview.id DESC');
								   	$this->set('businessuserreview',$this->paginate('Onlinereview'));
                 }
           else{
			$this->Session->setFlash('You are not authorized to access that location.','error');
            if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
		}

	}



public function feedBackSeeMore()
	{
		$uid=$this->routing();
        if($uid){
            
			$this->loadModel('Business');
			$this->loadModel('BusinessReview');
			$this->loadModel('Onlinereview');
	        $this->recursive=2;
	        $business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>0));
	       //pr($business_id);die;
              $this->paginate = array('limit'=>'15',
								    'conditions' => array(
								    'BusinessReview.business_id'=>$business_id['Business']['id']),'order' =>'BusinessReview.id DESC');
								   // pr($this->paginate('BusinessReview'));die;	
								    $this->set('businessuserreview',$this->paginate('BusinessReview'));
                 }
           else{
			$this->Session->setFlash('You are not authorized to access that location.','error');
            if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));
		}

	}

public function editVisibilityUrl()
{
	$uid=$this->routing();
	$success = array();
	if($uid)
	   		{
		   		$this->loadModel('Business');
	        	$businessUser=$this->Business->find('first',array('contain'=>array('Visibility'),'conditions'=>array('Business.user_Id'=>$uid))); 
				if($this->request->is('post'))
				{
					$data = $this->data;  
					$info['Visibility'] = array();
					for($i=0;$i<count($data['Visibility']);$i++)
					{  
		               $info['Visibility']['sitename'] = $data['Visibility'][$i];
		               $i++;
		               $info['Visibility']['id'] = $data['Visibility'][$i];
		               $i++;
		               $info['Visibility']['prefixurl'] = $data['Visibility'][$i];
		               $i++;
		               $info['Visibility']['url'] = $data['Visibility'][$i];
                      
		               		switch (trim($info['Visibility']['sitename'])) 
	              		    {
				               	   case 'Yelp':
						            			$info['Visibility']['business_id']=$businessUser['Business']['id'];
						            		    $info['Visibility']['social_media_id']=12;
						            		    if($this->validateYelp($info))
						            		    {
						            				 
						            			}
						            			else
						            			{
						            				 
						            			}
			            			break;	
			            			case 'Avvo':
						            			$info['Visibility']['business_id']=$businessUser['Business']['id'];
						            		    $info['Visibility']['social_media_id']=4;
		            		                    if($this->Avvo($info))
		            		                    {
		            							$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            							}
		            							else
		            							{
		            				
		            							}
		            			    break;	
				            		case 'Citysearch':
						            			$info['Visibility']['business_id']=$businessUser['Business']['id'];
						            		    $info['Visibility']['social_media_id']=5;
						            			if($this->citysearch($info))
						            			{
						            			 
						            			}
						            			else
						            			{
						            				 
						            			}
				        			break;		
					            	case 'Insider Pages':
					            	            $info['Visibility']['business_id']=$businessUser['Business']['id'];
						            		    $info['Visibility']['social_media_id']=6;
						            		    if($this->insiderpages($info))
						            			{
						            				 
						            			}
						            			else
						            			{
						            				 
						            			}
				        			 break;
					            	case 'Judy\'s Book':
						            			$info['Visibility']['business_id']=$businessUser['Business']['id'];
						            		    $info['Visibility']['social_media_id']=7;
						            			if($this->judysbook($info))
						            			{
						            				 
						            			}
						            			else
						            			{
						            				 
						            			}
								     break;
								     default:
			        				 break;
		            		}
		            	
					}
					$this->Session->setFlash('Urls hav been added Successfully','success');
					$this->redirect($this->referer());
				}
			}	
			else
		   {
		   	$this->Session->setFlash('You are not authorized to access that location.','error');
	        if(isset($this->request->query['bussiness']))
	        {
	        $qury='?bussiness='.$this->request->query['bussiness'];
	                }
	                else
	                {
	                    $qury='';
	                } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));	
	    }
}
public function onlineReviewPlugin()
{
		$uid=$this->routing();
		if($uid)
		{
		$this->loadModel('Business');
		$this->loadModel('onlineReviewPlugin');
		$sucess_result = 0;
    	$businessUser=$this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$uid),'fields'=>array('Business.id'),'recursive'=>-1));
    	$business_id = $businessUser['Business']['id'];
        if($this->request->is('post'))
           {
             if(!empty($this->data))
             {
             	$data = $this->data;
             	
             	if((isset($data['UncheckedSocialMedia']['id']) && count($data['UncheckedSocialMedia']['id']) > 0))
             { 		
             	for($i = 0;$i < count($data['UncheckedSocialMedia']['id']); $i++)
	     		{
	     			$socialId = @$data['UncheckedSocialMedia']['id'][$i];
	     			if(in_array(@$socialId,@$data['socialMedia']['id']))
	     			{
	     				continue;
	     				$sucess_result++;
	     			}
	     			else
	     			{
                       $this->onlineReviewPlugin->deleteAll(array('onlineReviewPlugin.social_media_id' => $socialId,'onlineReviewPlugin.business_id' => $business_id));
                       $sucess_result++;
	     			}
                   
	     		} 
             }
             if(isset($data['socialMedia']['id']) && count($data['socialMedia']['id']) > 0)
             {
             	for($i = 0;$i < count($data['socialMedia']['id']); $i++)
	     		{
	     			$social = $data['socialMedia']['id'][$i];
	     			if(in_array($social,$data['UncheckedSocialMedia']['id']))
	     			{
	     				continue;
	     				$sucess_result++;
	     			}
	     			else
	     			{
                        $info1['onlineReviewPlugin']['business_id'] = $business_id;
                        $info1['onlineReviewPlugin']['social_media_id'] = $social;
	             		$info1['onlineReviewPlugin']['status'] = 1;
	             		$this->onlineReviewPlugin->create();
	             		if($this->onlineReviewPlugin->save($info1['onlineReviewPlugin']))
	             		{
	             			$sucess_result++;
	             		}

                   }
                   
	     		} 
             }
                 
                 if($sucess_result > 0)
                 {
                   $this->Session->setFlash('Online Reviews Sites Urls have been added Successfully','success');
				   $this->redirect($this->referer());	
                 }else
                 {
                   $this->Session->setFlash('Online Reviews Sites Urls have been added Successfully','success');
				   $this->redirect($this->referer());	
                 }
             }else{
             	$this->Session->setFlash('Online Reviews Sites Urls have been added Successfully','success');
				$this->redirect($this->referer());	
             }
           }
		}
		else
		   {
		   	$this->Session->setFlash('You are not authorized to access that location.','error');
	        if(isset($this->request->query['bussiness']))
	        {
	        $qury='?bussiness='.$this->request->query['bussiness'];
	                }
	                else
	                {
	                    $qury='';
	                } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));	
		    }

	
}

 public function businesSetup()
	{
           $uid=$this->routing();
           if($uid){
		   	$this->loadModel('BusinessCategory');
		   		$bus_data = $this->Business->find('first',array('contain'=>'User','conditions'=>array('Business.user_Id'=>$uid),'recursive'=>-1));
				$this->loadModel('BusinessSocialMedia');
				
				
                /*-----------Plug IN Start----------------------------------------------------*/
                $this->loadModel('BusinessSocialMedia');
         	 	$this->loadModel('SocialMedia');
				$Reviewsitedata=$this->SocialMedia->find('all',array('conditions'=>array('SocialMedia.accounttype'=>'ReviewSite','SocialMedia.status'=>1),'recursive'=>-1));
				$this->set('Reviewsitedata',$Reviewsitedata);
	            $this->loadModel('onlineReviewPlugin');
                $reviewSite = array();
                $pluginReviews = $this->onlineReviewPlugin->find('all',array('conditions'=>array('onlineReviewPlugin.business_id'=>$bus_data['Business']['id'])));
	            	   
                 foreach ($pluginReviews as $key => $value) {
            		  $reviewSite[$value['onlineReviewPlugin']['social_media_id']]=$value['onlineReviewPlugin']['social_media_id'];
	            }
	           $this->set('businessid',$bus_data['Business']['id']);
			    $this->set('reviewSite',$reviewSite);

                /*-----------Plug IN End----------------------------------------------------*/
               /*---------------For Business Online Review Sites Start------------------------ */
				$this->loadModel('Business');
            	$businessUser=$this->Business->find('first',array('contain'=>array('Visibility'),'conditions'=>array('Business.user_Id'=>$uid)));
            	$media=array();
            	$mediaurl=array();
            	foreach ($businessUser['Visibility'] as $key => $value) {
            		
            			$media[$value['id']]=$value['socialmediaName'];
	            		$media[$value['socialmediaName']]=$value['url'];
	            		$media[$value['socialmediaName'].'status']=$value['status'];
	            		$media[$value['socialmediaName'].'checker']=$value['checkerType'];
            		
            		
            	}

              	$this->loadModel('BusinessSocialMedia');
				$business_review_sites = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$bus_data['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'ReviewSite','SocialMedia.status'=>1)));
				$this->set('online_review_sites',$business_review_sites);
				$this->set('media',$media);
				/*---------------For Business Online Review Sites End------------------------ */
               
				$review = $this->SocialMedia->find('all',array('contain'=>false,'conditions'=>array('SocialMedia.promotionSites'=>1)));
				$this->loadModel('BusinessSitePromotion');
				$Proreview = $this->BusinessSitePromotion->find('all',array('conditions'=>array('BusinessSitePromotion.business_id'=>$bus_data['Business']['id'])));
				
				if(!empty($Proreview)){
					foreach ($review as $key => $value) {
						foreach ($Proreview as $k => $v) {
							if($v['BusinessSitePromotion']['social_media_id']==$value['SocialMedia']['id']){
								$value['SocialMedia']['review']=$v['BusinessSitePromotion']['review'];
								$value['SocialMedia']['promotionId']=$v['BusinessSitePromotion']['id'];
								$value['SocialMedia']['promotionStatus']=$v['BusinessSitePromotion']['status'];
								$value['SocialMedia']['bid']=$v['BusinessSitePromotion']['business_id'];
								//$value['SocialMedia']['url']='http//:'.rtrim(ltrim($value['SocialMedia']['url'],'www.'),'/');
								$review[$key]=$value;
								break;
							}
						}
					}
				}
				$this->set('promotionsites',$review);
				//pr($review);die;
				//$this->set(compact('review','Proreview'));
				#adding business employee
				$this->loadModel('BusinessEmployee');
				$emp = $this->BusinessEmployee->find('list',array('limit'=>10,'fields'=>array('id','emp_name'),'conditions'=>array('BusinessEmployee.business_id'=>$bus_data['Business']['id'])));
				$this->set(compact('emp'));

				$this->set('currentbusinessid',$bus_data['Business']['id']);
				$this->loadModel('EmailTemplate');
				$email_sign = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id']),'recursive'=>-1));
				
				#pr($email_sign);



				$businessCategories = $this->BusinessCategory->find('list',array('fields'=>array('id','name'),'recursive'=>-1));
				$countries = $this->Business->Country->find('list',array('fields'=>array('id','country_name'),'order'=>array('country_name ASC')));
                                $us = $countries[1];
			        unset($countries[1]);
			        $countries[1] = $us;
				$this->set(compact('bus_data','businessCategories','countries','email_sign'));
				$this->loadModel('State');
				$states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
				$this->set('states',$states);
				$this->loadModel('City');
				$cities= $this->City->find('list',array('fields'=>array('id','city_name'),'order'=>array('city_name ASC')));
				$this->set('cities',array_unique($cities));
				#feedback setting
				$this->loadModel('FeedbackSetting');
				$feedbacksetting=$this->FeedbackSetting->find('first',array('conditions'=>array('FeedbackSetting.business_id'=>$bus_data['Business']['id']),'recursive'=>-1));
				$this->set('feedbacksetting',$feedbacksetting);
				#feedback emails
				$initialfeedback = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id'], 'EmailTemplate.type'=>1),'recursive'=>-1));
				$this->set('initialfeedback',$initialfeedback);
				$feedback_reminder = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id'], 'EmailTemplate.type'=>2),'recursive'=>-1));
				$this->set('feedback_reminder',$feedback_reminder);
				$positive_feedback = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id'], 'EmailTemplate.type'=>3),'recursive'=>-1));
				$this->set('positive_feedback',$positive_feedback);
				$negative_feedback = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id'], 'EmailTemplate.type'=>4),'recursive'=>-1));
				$this->set('negative_feedback',$negative_feedback);

				####
				$positive_email = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id'], 'EmailTemplate.type'=>5),'recursive'=>-1));
				$this->set('positive_email',$positive_email);
				$negative_email = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$bus_data['Business']['id'], 'EmailTemplate.type'=>6),'recursive'=>-1));
				$this->set('negative_email',$negative_email);


				#load template variables
				$dest = '../webroot/emailTemplate/emailvariables/variables.txt';
				$variables=explode(',', file_get_contents($dest ,true));
				$this->set('variables',$variables);
		   }
		   else
		   {
		   	$this->Session->setFlash('You are not authorized to access that location.','error');
            if(isset($this->request->query['bussiness'])){
            $qury='?bussiness='.$this->request->query['bussiness'];
                    }else{
                        $qury='';
                    } 
		    $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));	
		   }


		
	}

	
	public function business_info($id=NULL){
		$this->loadModel('User');
  		$this->loadModel('EmailTemplate');

  		$uid=$this->routing();
		if($uid){
			if(!empty($this->data)){
				$data = $this->data;
				$dest = '../webroot/img';
				if(!empty($_FILES['image']['name']))
				{
					$file = $_FILES['image'];
					$image = $this->upload_image($dest,$file,'');
					$data['Business']['business_logo']=$image;
				}else{
					$data['Business']['business_logo'] = $data['Business']['business_logo1'];
				}
				if($this->Business->save($data)){
					$data['User']['id'] = $data['Business']['user_Id'];
					if($this->User->save($data)){
						//$signature = $data['EmailTemplate']['signature'];
						//$this->EmailTemplate->updateAll(array('EmailTemplate.signature'=>"'$signature'"),array('EmailTemplate.business_id'=>$data['Business']['id']));
						$this->Session->setFlash('data Saved Successfully.','success');
						$this->redirect($this->referer());
					
					}else{
						$this->Session->setFlash('User data Saved unSuccessfully.','success');
						$this->redirect($this->referer());
					}
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



	public function visibility($action=null){
		   $uid=$this->routing();
		   if($uid)
		   {
		   		$this->loadModel('Business');
            	$businessUser=$this->Business->find('first',array('contain'=>array('Visibility'),'conditions'=>array('Business.user_Id'=>$uid)));
            	$media=array();
            	$mediaurl=array();
            	foreach ($businessUser['Visibility'] as $key => $value) {
            		if($value['status']=='visible' || $value['status']=='error'){
            			$media[$value['id']]=$value['socialmediaName'];
	            		$media[$value['socialmediaName']]=$value['url'];
	            		$media[$value['socialmediaName'].'status']=$value['status'];
	            		$media[$value['socialmediaName'].'checker']=$value['checkerType'];
            		}else{
            			continue;
            		}
            		
            	}
            	//pr($media);die;
            	$this->loadModel('SocialMedia');
            	 $this->loadModel('BusinessSocialMedia');
                $social_media_directory = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'visibilitychecker','SocialMedia.accounttype'=>'DirectoryListing','SocialMedia.status'=>1)));
                
                $social_site = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'SocialSite','SocialMedia.status'=>1)));
              	
              	$Review_site = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'socialchecker','SocialMedia.accounttype'=>'ReviewSite','SocialMedia.status'=>1)));
              	
                $SearchEngine = $this->BusinessSocialMedia->find('all',array('contain'=>array('SocialMedia','Business'=>array('Visibility')),'conditions'=>array('BusinessSocialMedia.business_id'=>$businessUser['Business']['id'] , 'BusinessSocialMedia.checker_type'=>'visibilitychecker','SocialMedia.accounttype'=>'SearchEngine','SocialMedia.status'=>1)));
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
	            				$this->Session->setFlash('Facebook url added successfully.','success');
	            				$this->redirect($this->referer());
	            			}else{
	            				$this->Session->setFlash('Facebook url is already exist. Please try with another url.','error');
	            				$this->redirect($this->referer());
	            			}
	            			
	            			break;
	            		case 'GooglePlusLocal':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=2;
		            			if($this->gplus($this->request->data)){
		            				$this->Session->setFlash('Google Plus url added successfully.','success');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Google Plus url is already exist. Please try with another url.','error');
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            	case 'Citysearch':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=5;
		            			if($this->citysearch($this->request->data)){
		            				$this->Session->setFlash('City Search url added successfully.','success');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('City Search url is already exist. Please try with another url.','error');
		            				$this->redirect($this->referer());
		            			}
		            			break;		
		            	case 'InsiderPages':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=6;
		            			if($this->insiderpages($this->request->data)){
		            				$this->Session->setFlash('Insider Pages url added successfully.','success');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash('Insider Pages url is already exist. Please try with another url.','error');
		            				$this->redirect($this->referer());
		            			}
		            			break;
		            	case 'JudysBook':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=7;
		            			if($this->judysbook($this->request->data)){
		            				$this->Session->setFlash("Judy's Book url added successfully.",'success');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Judy's Book url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;	
		            	case '411com':
		            	
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=17;
		            			if($this->Fourelevencom($this->request->data)){
		            				$this->Session->setFlash("411.com url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("411.com url url is already exist. Please try with another url.",'error');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}
		            	case 'Yelp':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=12;
		            		    if($this->validateYelp($this->request->data)){
		            				$this->Session->setFlash("Yelp url added successfully.",'success');
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Yelp url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;									
		            	case 'Avvo':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=4;
		            		    if($this->Avvo($this->request->data)){
		            				$this->Session->setFlash("Avvo url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Avvo url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;			
	            		case 'Twitter':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=16;
		            		    if($this->twitter($this->request->data)){
		            				$this->Session->setFlash("Twitter url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Twitter url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;
		            	case 'WhitePages':
		            			$this->request->data['Visibility']['business_id']=$businessUser['Business']['id'];
		            		    $this->request->data['Visibility']['social_media_id']=31;
		            		    if($this->whitePages($this->request->data)){
		            				$this->Session->setFlash("Whitepages url added successfully.",'success');
		            				$this->Session->write('agncyBusId',$businessUser['Business']['id']);
		            				$this->redirect($this->referer());
		            			}else{
		            				$this->Session->setFlash("Whitepages url is already exist. Please try with another url.",'error');
		            				$this->redirect($this->referer());
		            			}
		            			break;	
	            		default:
	            			break;
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

	public function insertDefaultTemplate($businessid)

	{  
        $this->loadModel('EmailTemplate');
		$this->loadModel('Business');
        $initialfeedback = $this->Business->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.business_id'=>$businessid, 'EmailTemplate.type'=>1,'default'=>0)));
        $conditions = array('Business.id'=>$businessid);
        $senderDetail = $this->Business->find('first',array('contain'=>array('User'),'conditions'=>$conditions,'fields'=>array('Business.businessname','User.email')));
       if(count($initialfeedback)<=0):

			#insert all the default Template

            foreach ($this->getemailTemplates() as $key => $value) {

            	# code...

                  $dest = '../webroot/emailTemplate/'.$value.'.txt';

				  $content=file_get_contents($dest ,true);

				  $data['EmailTemplate']['business_id']=$businessid;

				$data['EmailTemplate']['type']=$key;

				$data['EmailTemplate']['emailtemplatename']=$value;

				$data['EmailTemplate']['emailsubject']=$value;

				$data['EmailTemplate']['emailcontent']=$content;

				$data['EmailTemplate']['sendername']=$senderDetail['Business']['businessname'];

				$data['EmailTemplate']['senderemail']=$senderDetail['User']['email'];

					$data['EmailTemplate']['status']=1;

						$data['EmailTemplate']['default']=0;

						$this->EmailTemplate->create();

				   if ($this->EmailTemplate->save($data)) {


				    	$this->Session->setFlash(__('The email template has been saved.'));}

					else{

						$this->Session->setFlash(__('The email sfdsfafa template has been saved.'));



					}

            }

			endif;	

		return true;

	}

	public function notification()
	{	
		$uid = $this->Session->read('Auth.User.id');
		if(base64_decode(@$_GET['bussiness'])!= ''){
			$buss_id =$this->Business->find('first',array('conditions'=>array('Business.id'=>base64_decode($_GET['bussiness'])),'fields'=>array('id'),'recursive'=>-1));
		}else{
			$buss_id =$this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$uid),'fields'=>array('id'),'recursive'=>-1));
		}
		$this->insertDefaultTemplate($buss_id['Business']['id']);
		$this->set(compact('buss_id'));
		$uid = $this->routing();
		if($uid){		
			$this->loadModel('EmailTemplate');
			if(isset($this->request->data['searchForm']['search'])){
				if($this->request->is('post')){
					$data = $this->data;
					$search = $data['searchForm']['search'];
					$search = trim($search);
					$this->paginate = array('contain'=>false,
						    'conditions' => array(
						    'EmailTemplate.emailtemplatename LIKE'=>'%'.$search.'%'),'recursive'=>-1);	
				}
			$this->set('emailtemplate',$this->paginate('EmailTemplate'));
			}else{
			 $this->paginate = array('conditions'=>array('EmailTemplate.business_id'=>$buss_id['Business']['id']),'limit'=>15,'order'=>'EmailTemplate.id desc','recursive' => -1);
	         $this->set('emailtemplate',$this->paginate('EmailTemplate'));
	       	}
	    }
        else{
	      $this->Session->setFlash('You are not authorized to access that location.','error');
         if(isset($this->request->query['bussiness'])){
         $qury='?bussiness='.$this->request->query['bussiness'];
            }else{
                $qury='';
            } 
         $this->redirect(array('controller'=>'dashboard','action'=>'contactManager/'.$qury));	
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
     function checkEmail_user_edit()
		{ 
			$this->loadModel('Customer');
            $email = trim($_REQUEST['data']['Customer']['email']);
			$this->autoRender = false;
            $user_id = $this->Session->read('Auth.User.id');
			$count = $this->Customer->find('count',array('conditions'=>array('Customer.email'=>$email),'Customer.user_id'=>$user_id));
			if($count > 0)
			{
				//$another_email = $this->Customer->find('all',array('conditions'=>array('Customer.email <>' =>$email,'Customer.user_id'=>$user_id),'contain'=>false));
				//pr($another_email);die;
				echo "true";die;   
			}
			else{ echo "false";die; }

		}

 
	
     
	
		public function reporting(){
		    $ratarr=array('1R','2R','3R','4R','5R');
		    $uid=$this->routing();
		    if($uid){
		    	if($this->request->is('post') && ($this->request->data['Employee']['id']||$this->request->data['Employee']['time'])){
		    		$this->set('employee_report_id',$this->request->data['Employee']['id']);
		    		if($this->request->data['Employee']['time']){
		    			$period=$this->request->data['Employee']['time'];
		    			$startdate=$this->firstDayOf($period,new DateTime())->format('Y-m-d');
		    			$lastdate=$this->lastDayOf($period,new DateTime())->format('Y-m-d');
		    			$this->set('selectedtime',$period);
		    		}else{
		    			$period='';
		    			$startdate='';
		    			$lastdate='';
		    			$this->set('selectedtime',$period);
		    		}

		    		$emid=$this->request->data['Employee']['id'];
                                
		    		$bus=$this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$uid,'Business.is_deleted'=>0),'fields'=>array('Business.id')));
		    		$busIds=!empty($bus)?$bus['Business']['id']:''; 
		    		$this->set('selectedId',$this->request->data['Employee']['id']);
		    		$this->loadModel('Customer');
		    		if($emid){
		    			if($startdate && $lastdate){
		    				$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$busIds,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
		    			}else{
		    				$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$busIds,'Customer.employee_id'=>$this->request->data['Employee']['id'])));	
		    			}
		    			
		    		}else{
		    			if($startdate && $lastdate){
		    				$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$busIds,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
		    			}else{
		    				$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$busIds)));
		    			}	
		    			
		    		}
			    	
			    	
			    	$this->set('success',$successFeed);
			    	if($emid){
			    		if($startdate && $lastdate){
			    			$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$busIds,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
			    		}else{
			    			$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$busIds,'Customer.employee_id'=>$this->request->data['Employee']['id'])));
			    		}	
			    		
			    	}else{
			    		if($startdate && $lastdate){
			    			$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$busIds,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
			    		}else{
			    			$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$busIds)));

			    		}	
			    		
			    	}
			    	
			    	$this->set('notFeed',$notFeed);
			    	$this->loadModel('BusinessReview');
			    	if(isset($this->request->data['searchForm']['search']) && $this->request->data['searchForm']['search']){
			    		$searhval=$this->request->data['searchForm']['search'];
			    		if($emid){
			    			if($startdate && $lastdate){
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>$this->request->data['Employee']['id'],'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%",'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
			    			}else{
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>$this->request->data['Employee']['id'],'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));

			    			}
			    			
			    		}else{
			    			if($startdate && $lastdate){
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate,'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));
			    			}else{
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));

			    			}
			    			
			    		}
			    		
			    	}elseif(isset($this->request->data['BusinessReview']['starrating']) && $this->request->data['BusinessReview']['starrating']){
			    		if($emid){
			    			$rating=$this->request->data['BusinessReview']['starrating'];
			    			if($startdate && $lastdate){
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate));
			    			}else{
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>$this->request->data['Employee']['id']));

			    			}
			    		
			    			

			    		}else{
			    			$rating=$this->request->data['BusinessReview']['starrating'];
			    			if($startdate && $lastdate){
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate));
			    			}else{
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));

			    			}
			    		

			    		}

			    		
			    		$this->set('rating',$rating);
			    	}else{
			    		if($emid){
			    			if($startdate && $lastdate){
			    				$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate));
			    			}else{
			    				  $this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.employee_id'=>$this->request->data['Employee']['id']));
			    			}
			    		}else{
			    			 if($startdate && $lastdate){
			    			 	$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate));
			    			 }else{
			    			 	$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
			    			 }
			    			
			    		}
			    		
			    	}
			    	$this->set('customersReviews',$this->paginate('BusinessReview'));
			    	$this->loadModel('BusinessReview');
			    	if($emid){
			    		if($startdate && $lastdate){
			    			$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('onestar',$onestar);
				    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('twostar',$twostar);
				    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('threestar',$threestar);
				    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('fourstar',$fourstar);
				    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'],'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('fivestar',$fivestar);
			    		}else{
			    			$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'])));
				    	$this->set('onestar',$onestar);
				    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'])));
				    	$this->set('twostar',$twostar);
				    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'])));
				    	$this->set('threestar',$threestar);
				    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'])));
				    	$this->set('fourstar',$fourstar);
				    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.employee_id'=>$this->request->data['Employee']['id'])));
				    	$this->set('fivestar',$fivestar);
			    		}
			    		

			    	}else{
			    		if($startdate & $lastdate){
			    			$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('onestar',$onestar);
				    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('twostar',$twostar);
				    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('threestar',$threestar);
				    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('fourstar',$fourstar);
				    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.created >=' => $startdate,'Customer.created <=' => $lastdate)));
				    	$this->set('fivestar',$fivestar);
			    		}else{
			    			$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
				    	$this->set('onestar',$onestar);
				    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
				    	$this->set('twostar',$twostar);
				    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
				    	$this->set('threestar',$threestar);
				    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
				    	$this->set('fourstar',$fourstar);
				    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
				    	$this->set('fivestar',$fivestar);

			    		}
			    		

			    	}
			    	
			    	$allbusinessemp=$this->Business->find('first',array('contain'=>array('BusinessEmployee'),'conditions'=>array('Business.user_Id'=>$uid,'Business.is_deleted'=>0)));
			   
			    	$this->set('allbusinessemp',$allbusinessemp);
		    	}else{
		    		//pr($this->request->data);die;
		    		$this->loadModel('Business');
		    		$bus=$this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$uid,'Business.is_deleted'=>0),'fields'=>array('Business.id')));
		    		$busIds=!empty($bus)?$bus['Business']['id']:'';
		    		$this->set('selectedId',"");
		    		$this->set('selectedtime',"");
		    		$this->loadModel('Customer');
			    	$successFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>$ratarr,'Customer.business_id'=>$busIds)));
			    	$this->set('success',$successFeed);
			    	//pr($successFeed);die;
			    	$notFeed=$this->Customer->find('count',array('conditions'=>array('Customer.status'=>'InFeedbackSequence','Customer.business_id'=>$busIds)));
			    	$this->set('notFeed',$notFeed);
			    	$this->loadModel('BusinessReview');
			    	if(isset($this->request->data['searchForm']['search']) && $this->request->data['searchForm']['search']){
			    		$searhval=$this->request->data['searchForm']['search'];
			    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr,'OR'=>array('Customer.firstname LIKE'=>"%$searhval%",'Customer.lastname LIKE'=>"%$searhval%",'Business.businessname LIKE'=>"%$searhval%")));
			    	}elseif(isset($this->request->data['BusinessReview']['starrating']) && $this->request->data['BusinessReview']['starrating']){
			    		$rating=$this->request->data['BusinessReview']['starrating'];
			    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>$rating,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
			    		$this->set('rating',$rating);
			    	}else{
			    		$this->paginate=array('limit'=>'15','contain'=>array('Customer'=>array('fields'=>array('Customer.id','Customer.firstname','Customer.lastname','Customer.email','Customer.user_id','Customer.phonenumber','Customer.business_id','Customer.status','Customer.empname')),'Business'=>array('fields'=>array('Business.id,Business.user_Id','Business.is_deleted','Business.businessname'))),'conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1,'Customer.is_delete'=>0,'Business.is_deleted'=>0,'Customer.status'=>$ratarr));
			    	}
			    	$this->set('customersReviews',$this->paginate('BusinessReview'));
			    	$this->loadModel('BusinessReview');
			    	$onestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>1,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
			    	$this->set('onestar',$onestar);
			    	$twostar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>2,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
			    	$this->set('twostar',$twostar);
			    	$threestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>3,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
			    	$this->set('threestar',$threestar);
			    	$fourstar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>4,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
			    	$this->set('fourstar',$fourstar);
			    	$fivestar=$this->BusinessReview->find('count',array('conditions'=>array('BusinessReview.business_id'=>$busIds,'BusinessReview.ratingstar'=>5,'BusinessReview.authorization'=>1,'BusinessReview.confirmation'=>1)));
			    	$this->set('fivestar',$fivestar);

			    	$allbusinessemp=$this->Business->find('first',array('contain'=>array('BusinessEmployee'),'conditions'=>array('Business.user_Id'=>$uid,'Business.is_deleted'=>0)));
			   
			    	$this->set('allbusinessemp',$allbusinessemp);
		    	}	
	    	}else{
	    		$this->Session->setFlash('You are not authorized user to access that location.','error');
	    		$this->redirect($this->referer());
	    	}
	}
public function businessUserTraining()
	{
		$uid=$this->routing();
		if($uid){
            $this->loadModel('Training');
			$data=$this->Training->find('all');
			$this->set('trainings',$data);
		}else{
			$this->Session->setFlash('You are not authorized user to access that location.','error');
			$this->redirect($this->referer());
		}
        
	}
/**
 * Get average ratings
 */

	public function averageRatings ($businessId){
		$this->loadModel('BusinessReview');
		//get one star ratings
		$oneStart = $this->BusinessReview->find('count', array(
				    'fields' => array('BusinessReview.ratingstar'),
				    'conditions' => array("BusinessReview.ratingstar" => '1' ,"BusinessReview.business_id" => $businessId) 
				)); 
		//get two star ratings
		$twoStart = $this->BusinessReview->find('count', array(
				    'fields' => array('BusinessReview.ratingstar'),
				    'conditions' => array("BusinessReview.ratingstar" => '2' ,"BusinessReview.business_id" => $businessId) 
				)); 
		//get three star ratings
		$threeStart = $this->BusinessReview->find('count', array(
				    'fields' => array('BusinessReview.ratingstar'),
				    'conditions' => array("BusinessReview.ratingstar" => '3' ,"BusinessReview.business_id" => $businessId) 
				)); 
		//get four star ratings
		$fourStart = $this->BusinessReview->find('count', array(
				    'fields' => array('BusinessReview.ratingstar'),
				    'conditions' => array("BusinessReview.ratingstar" => '4' ,"BusinessReview.business_id" => $businessId) 
				)); 
		//get five star ratings
		$fiveStart = $this->BusinessReview->find('count', array(
				    'fields' => array('BusinessReview.ratingstar'),
				    'conditions' => array("BusinessReview.ratingstar" => '5' ,"BusinessReview.business_id" => $businessId) 
				)); 
		//get total stars
		$totalStars = $this->BusinessReview->find('count', array(
		    'fields' => array('BusinessReview.ratingstar'),
		    'conditions' => array("BusinessReview.business_id" => $businessId) 
		)); 

		if($totalStars == 0){
			return 'No Ratings';	
		}
		$averageRatings = (5*$fiveStart + 4*$fourStart + 3*$threeStart + 2*$twoStart + 1*$oneStart) / $totalStars;
		
		return $averageRatings;
	} 

/**
 * Get last review date
 **/
	
	public function lastReviewDate($businessId) {
			$this->loadModel('BusinessReview');
			$reviewDate = $this->BusinessReview->find('all', array(
			    'fields' => array('BusinessReview.ratingdate'),
			    'conditions' => array("BusinessReview.business_id" => $businessId) ,
			    'order' => array('BusinessReview.ratingdate DESC') 
			)); 

			if(isset($reviewDate) && !empty($reviewDate)) 
				return $reviewDate[0]['BusinessReview']['ratingdate'];
			else
				return 'No Reviews';
	}
/**
 * Get total review
 **/
	
	public function totalReviews($businessId) {
			$this->loadModel('BusinessReview');
			$allReviews = $this->BusinessReview->find('count', array(
			    'fields' => array('BusinessReview.ratingdate'),
			    'conditions' => array("BusinessReview.business_id" => $businessId) 
			)); 

			return $allReviews;
	}

/**
 * Search business
 **/

	public function searchBusiness() { 
		//when press submit
		if($this->request->is('post')){
			$searchValue = $this->request->data['searchForm']['search'];
                        $searchValue = trim($searchValue);
			$this->loadModel('Business');
			$this->Business->recursive = 0;
			$this->paginate = array('contain'=>'User',
					    'conditions' => array(
					    'Business.agency_id'=>$this->Session->read('Auth.User.id'),	
					    'Business.businessname LIKE' => "%$searchValue%",'Business.is_deleted'=>0));
			$this->set('businesses',$this->paginate('Business'));
			//$this->set('selectedTab', 'feedback');
			$businessesdata=$this->Business->find('all',array('contain'=>false,'order'=>array('Business.id'=>'DESC'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0)));
			$this->set('businessesdata',$businessesdata);
                        $this->set('searchText',$searchValue);
			return $this -> render('index');
		//if get request redirect to index
		}else {
			$this->redirect( '/dashboard' );
		}
	}
/**
 * manage Buiseness User
 **/

	public function manageUser() { 
		if($this->Session->read('Auth.User.usertype')=='reseller'){
			if(isset($this->request->data['searchForm']['search'])){
				$searchValue=$this->request->data['searchForm']['search'];
				$searchValue = trim($searchValue);
				$this->loadModel('BusinessCategory');
				$bcat=$this->BusinessCategory->find('list',array('conditions'=>array('BusinessCategory.name LIKE' => "%$searchValue%"),'fields'=>array('BusinessCategory.id')));
				//pr($bcat);die;
				$this->loadModel('Business');
				$this->Business->recursive = 0;
				$this->paginate = array(
						    'conditions' => array(
						     'Business.is_deleted'=>0,	
						     'Business.agency_id'=>$this->Session->read('Auth.User.id'), 'OR'=>array('Business.business_category_id'=>$bcat,'Business.businessname LIKE' => "%$searchValue%")));

				//pr($this->paginate);die;
				$this->set('businesses',$this->paginate('Business'));
	                        $this->set('searchText',$searchValue);
				$businessesdata=$this->Business->find('all',array('contain'=>array('User'),'order'=>array('Business.id'=>'DESC'),'fields'=>array('Business.id','Business.businessname','Business.totalReviews','Business.lastReviewdate','Business.averageRating'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0,'Business.totalReviews !='=>0)));
				$this->set('businessesdata',$businessesdata);

			}else{
				$this->loadModel('Business');
				$this->Business->recursive = 0;
				$this->paginate = array('limit'=>'15','order'=>array('Business.id'=>'DESC'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0));
				$this->set('businesses',$this->paginate('Business'));	
				$businessesdata=$this->Business->find('all',array('contain'=>array('User'),'order'=>array('Business.id'=>'DESC'),'fields'=>array('Business.id','Business.businessname','Business.totalReviews','Business.lastReviewdate','Business.averageRating'),'conditions'=>array('Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0,'Business.totalReviews !='=>0)));
				$this->set('businessesdata',$businessesdata);		
			}
		}else{
			$this->Session->setFlash('You are not authorized user to access that location.','error');
			$this->redirect($this->referer());
		}	
	}

/**
 * Search business user
 **/

	public function searchBusinessUser() { 
		//when press submit
		if($this->request->is('post')){
			$searchValue = $this->request->data['searchFormUser']['search'];
			$this->loadModel('Business');
			$this->Business->recursive = 0;
			$this->paginate = array(
					    'conditions' => array(
					    'Business.businessname LIKE' => "%$searchValue%",'Business.agency_id'=>$this->Session->read('Auth.User.id'),'Business.is_deleted'=>0));
			$this->set('businesses',$this->paginate('Business'));
                        $this->set('searchText',$searchValue);
			$this->set('selectedTab', 'users');
			return $this -> render('index');
		//if get request redirect to index
		}else {
			$this->redirect( '/dashboard' );
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
	public function add() {
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		
	}


	public function admin($section=null) {
	if($this->Session->read('Auth.User.usertype')=='reseller'){
		if($this->request->is('post')){
			switch ($section) {
				case'emailtalk':
					$resp=$this->emailTalk($this->request->data);
					$this->Session->setFlash($resp['msg'],'success');
					$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
				break;
				case'changepass':
					$resp=$this->changePassword($this->request->data);
					$this->Session->setFlash($resp['msg'],'success');
					//$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
                    $this->redirect(array('controller'=>'users','action'=>'logout')); 
				break;
				case'regEmail':
					$resp=$this->registerEmail($this->request->data);
					$this->Session->setFlash($resp['msg'],'success');
					$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
				break;
				case 'uploadbanner':
					$resp=$this->adminuploadbanner($this->request->data);
					$this->Session->setFlash($resp['msg'],'success');
					$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
					break;
				default:
					if($this->request->data['AgencysiteSetting']['agencylogo']['name']){
							$dest = '../../app/webroot/img/agencylogo';
							$file = $this->request->data['AgencysiteSetting']['agencylogo'];
							$dimension=getimagesize($file['tmp_name']);pr($dimension);
							$allowed =  array('gif','png' ,'jpg','jpeg');
							$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
						    $width=$dimension[0];
						    $height=$dimension[1];
                                                   
						    if(in_array($ext, $allowed)){
							    if($width > 84 && $height > 15){
							    	$logo_image = $this->upload_image($dest,$file,'');
									$this->request->data['AgencysiteSetting']['agencylogo']=$logo_image;
									if(is_uploaded_file($file['tmp_name']))
										{
										    $n_width=85;
										    $n_height=16;
										    $dest1 = '../../app/webroot/img/agencylogo/medium';
											$result = $this->Resize->resize($file['tmp_name'], realpath($dest1).'/'.$logo_image,"as_define",$n_width,$n_height,0,0,0,0);
										}
							    }else{
							    	$this->Session->setFlash('Invalid Image Size. Image must be atleast 85X16.','error');
									$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
							    }
							}else{
								$this->Session->setFlash('Invalid Image format. Allowed Format(gif,png ,jpg,jpeg).','error');
								$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
							}    
										
						}else{
							if(isset($this->request->data['Agency']['logoname']) && $this->request->data['Agency']['logoname']){
								$this->request->data['AgencysiteSetting']['agencylogo']=$this->request->data['Agency']['logoname'];		
							}else{
								$this->request->data['AgencysiteSetting']['agencylogo']="default.jpg";		
							}
						}
						$udata['User']['id']=$this->Session->read('Auth.User.id');
						$udata['User']['firstname']=$this->request->data['User']['firstname'];
						$udata['User']['lastname']=$this->request->data['User']['lastname'];
						$udata['User']['email']=$this->request->data['User']['email'];
						$this->request->data['AgencysiteSetting']['user_id']=$this->Session->read('Auth.User.id');
						if($this->request->data['Agency']['id']){
							$this->request->data['AgencysiteSetting']['id']=$this->request->data['Agency']['id'];
						}
						$this->loadModel('User');
						if($this->User->save($udata)){
							$this->loadModel('AgencysiteSetting');
							if($this->AgencysiteSetting->save($this->request->data['AgencysiteSetting'])){
								$this->Session->setFlash('Admin has been saved','success');
								$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
							}else{
								$this->Session->setFlash('Unable to save Agency Data','error');
								$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
							}
							$this->Session->setFlash('User has been saved','success');
							$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
						}else{
							$this->Session->setFlash('Unable to save User Data','error');
							$this->redirect(array('controller'=>'dashboard','action'=>'admin'));
						}
					break;
			}

						
          
		}
		$this->loadModel('User');
		$user=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));
		$this->set('user',$user);
		$this->loadModel('AgencysiteSetting');
		$agency=$this->AgencysiteSetting->find('first',array('conditions'=>array('AgencysiteSetting.user_id'=>$this->Session->read('Auth.User.id'))));
		$this->set('agency',$agency);
		$this->loadModel("AgencyTemplate");
		$emailtemplate=$this->AgencyTemplate->find('first',array('conditions'=>array('AgencyTemplate.agency_id'=>$this->Session->read('Auth.User.id'))));
		$this->set('emailtemplate',$emailtemplate);
		$this->loadModel("DefaultTemplate");
		$defaultemplate=$this->DefaultTemplate->find('first',array('conditions'=>array('DefaultTemplate.identifier'=>'agencyTemplate')));
		$this->set('defaultemplate',$defaultemplate);
		$this->loadModel('Country');
		$countries=$this->Country->find('list',array('fields'=>array('Country.id','Country.country_name'),'order'=>array('country_name ASC')));
		$this->set('countries',$countries);
		$this->loadModel('State');
		$states= $this->State->find('list',array('fields'=>array('id','stateName'),'order'=>array('stateName ASC')));
		$this->set('states',$states);
		if(isset($agency['AgencysiteSetting']['state_id']) && $agency['AgencysiteSetting']['state_id']){
			//$this->loadModel('City');
			//$cities= $this->City->find('list',array('fields'=>array('id','city_name'),'order'=>array('city_name ASC'),'conditions'=>array('City.state_id'=>$agency['AgencysiteSetting']['state_id'])));
			//$this->set('cities',array_unique($cities));
		}else{
			//$cities="";
			//$this->set('cities',$cities);
		}
	    }else{
	   		$this->Session->setFlash('You are not authorized user to access that location.','error');
	   		$this->redirect($this->referer());
	   }	
		
	}

	public function adminuploadbanner($data=null){
		// die("Upload Banner");
		if($data){
          
           if($data['AgencysiteSetting']['banner']['name']){
				$dest = '../../app/webroot/img/banner';
				$file = $data['AgencysiteSetting']['banner'];
				$dimension=getimagesize($file['tmp_name']);
				$allowed =  array('gif','png' ,'jpg','jpeg');
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			    $width=$dimension[0];
			    $height=$dimension[1];

			    if(in_array($ext, $allowed)){
				    if($width>=240 && $height>=290){
				    	$banner_image = $this->upload_image($dest,$file,'');
						$data['AgencysiteSetting']['banner']=$banner_image;
						if(is_uploaded_file($file['tmp_name']))
							{
							    $n_width=240;
							    $n_height=400;
							    $dest1 = '../../app/webroot/img/banner/medium';
								$result = $this->Resize->resize($file['tmp_name'], realpath($dest1).'/'.$banner_image,"as_define",$n_width,$n_height,0,0,0,0);
							}
				    }else{
				    	
				    		$res['error']=1;
				    		$res['msg']='Invalid Image Size. Image must be atleast 240X290.';
				    		return $res;
				    		
				    }
				}else{

							$res['error']=1;
				    		$res['msg']='Invalid Image format. Allowed Format(gif,png ,jpg,jpeg).';
				    		return $res;
				}    
							
			}else{
				 
				if(isset($data['Agency']['banner']) && $data['Agency']['banner']){
					 $data['AgencysiteSetting']['banner']=$data['Agency']['banner'];
					 
				}else{
					$data['AgencysiteSetting']['banner']="";		
			    }

			}
			$data['AgencysiteSetting']['id']=$data['Agency']['id'];
            $this->loadModel('AgencysiteSetting');
            if($this->AgencysiteSetting->save($data)){
        		$res['error']=0;
	    		$res['msg']='Admin has been updated successfully.';
            }else{
            	$res['error']=1;
	    		$res['msg']='Unable to Save Data.';
            }
            return $res;
		}else{
			$res['error']=1;
	    	$res['msg']='Unable to Save Data.';
	    	return $res;
		}
		
	}

	public function emailTalk($data=null){
		//die("email talk");
		if($data){
			 if(isset($data['Agency']['id']) && $data['Agency']['id'] ){
			 	$data['AgencysiteSetting']['id']=$data['Agency']['id'];
			 }
             $data['AgencysiteSetting']['user_id']=$this->Session->read('Auth.User.id');
             $this->loadModel('AgencysiteSetting');

             if($this->AgencysiteSetting->save($data)){
             		$res['error']=0;
	    			$res['msg']='Admin has been updated successfully.';
	    			return $res;
             }else{
             	$res['error']=1;
	    		$res['msg']='Unable to Save Data.';
	    		return $res;
             }
		}else{
			$res['error']=1;
	    	$res['msg']='Unable to Save Data.';
	    	return $res;
		}

	}

	function changePassword($data=null){
		if($data){
			if(trim($data['User']['password'])!=trim($data['User']['cpassword'])){
               	$res['error']=1;
		    	$res['msg']='Password do not match. Please try again.';
		    	return $res;
			}
			$this->loadModel('User');
			$user=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id')),'fields'=>array('User.password'),'contain'=>false));
			$pass=AuthComponent::password($data['User']['oldpass']);
			if(trim($user['User']['password'])==$pass){
				$data['User']['id']=$this->Session->read('Auth.User.id');
				if($this->User->save($data)){
					$res['error']=1;
			    	$res['msg']='Password has been updated successfully.';
			    	return $res;
				}else{
					$res['error']=1;
			    	$res['msg']='Unable to Save New Password.';
			    	return $res;
				} 
			}else{
				$res['error']=1;
		    	$res['msg']='Invalid Current Password.';
		    	return $res;
			}
		}else{
			$res['error']=1;
	    	$res['msg']='Unable to Save New Password.';
	    	return $res;
		}

	}
public function businessUserChangePassword()
{
	 $uid = $this->routing();
	 if($uid)
	 {	
		 if($this->request->is('post'))
		 {	
		  $data = $this->data;
		  $this->autoRender=false;
		  $pass = trim($data['User']['password']);
		  $cpass = trim($data['User']['cpassword']);
		  $old = trim($data['User']['oldpass']);
		  
				if($pass != $cpass)
				{   
					$this->Session->setFlash('Password And confirm password do not match try again','error');
		   		     $this->redirect($this->referer());
			    }
			    $this->loadModel('User');
				$user = $this->User->find('first',array('conditions'=>array('User.id'=>$uid),'contain'=>false));
                $oldPass=AuthComponent::password($old);
				$orgpass = trim($user['User']['password']);
			   if($orgpass == $oldPass)
				{ 
					$data['User']['id']=$uid;
				    if($this->User->save($data))
					{
						$this->Session->setFlash('Password Has been updated Successfully','success');
		   		        //return $this->redirect($this->Auth->logout());
		   		        $this->redirect($this->referer());
					}
					else
					{
						$this->Session->setFlash('Password And confirm password does','error');
		   		        $this->redirect($this->referer());
					} 
				}
				else
				{
					    $this->Session->setFlash('Password And confirm password does not match try again','error');
		   		        $this->redirect($this->referer());
				}
			}
		 }
	  else
	  {
		  $this->Session->setFlash('You are not authorized to access that location.','error');
		  $this->redirect($this->referer());
	  }	 

}	

	function registerEmail($data=null){
      if($data){
      	if(isset($data['Template']['id']) && $data['Template']['id']){
      		$data['AgencyTemplate']['id']=$data['Template']['id'];
      	}
      	$data['AgencyTemplate']['emailtemplatename']=$data['Template']['name'];
      	$data['AgencyTemplate']['agency_id']=$this->Session->read('Auth.User.id');
      	//$data['AgencyTemplate']['default']='<p>Hello,</p><p>You are successfully registered your Business Account.</p><p>BUsiness Name:{business_name}</p><p>BUsiness Phone:{business_phone}</p><p>BUsiness Address:{business_web_address}</p><p>BUsiness Email:{business_email}</p>';
      	//$data['AgencyTemplate']['meargefields']='{business_name},{business_phone},{business_web_address},{business_email},{first_name},{last_name},{user_email}';
      	//$data['AgencyTemplate']['default_signature']='<p>{first_name}</p><p>{last_name}</p><p>{company_name}</p>';
      	// pr($data);die;
      	$this->loadModel('AgencyTemplate');
      	if($this->AgencyTemplate->save($data)){
      		$res['error']=0;
	    	$res['msg']='Email notification template has been updated successfully.';
	    	return $res;
      	}
      }else{
      		$res['error']=1;
	    	$res['msg']='Unable to update emial notification template.';
	    	return $res;
      }
	}
	function validEmail()
		{
			//die("hello");
			$email = trim($_REQUEST['data']['User']['email']);
			$this->autoRender = false;
			$this->loadModel('User');
			$count = $this->User->find('count',array('conditions'=>array('User.email'=>$email,'User.email !='=>$this->Session->read('Auth.User.email'))));
			if($count>0)
			{
				echo "false";die;
			}
			else
			{
				echo "true";die;
			}	
		}
		function addvalidEmail()
		{
			//die("hello");
			$email = trim($_REQUEST['data']['AgencysiteSetting']['additionalemailnotification']);
			$this->autoRender = false;
			$this->loadModel('User');
			$count = $this->User->find('count',array('conditions'=>array('User.email'=>$email,'User.email !='=>$this->Session->read('Auth.User.email'))));
			if($count>0)
			{
				echo "false";die;
			}
			else
			{
				echo "true";die;
			}	
		}
		function checkValidPass()
		{
			$pass = trim($_REQUEST['data']['User']['oldpass']);
			$this->autoRender = false;
			$this->loadModel('User');
			$user=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id')),'fields'=>array('User.password'),'contain'=>false));
			$pass=AuthComponent::password($pass);
			if($user['User']['password']==$pass){
				echo "true";die;
			}else{
				echo "false";die;
			}
		}

		public function training() { 
		        if($this->Auth->User() && $this->Session->read('Auth.User.usertype')=='reseller'){
			$this->loadModel('Training');
			$data=$this->Training->find('all');
			 $this->set('trainings',$data);	
                         }
                         else
{ 
    $this->redirect($this->referer());
}		
		
		}

public function exportReport($employee_id = NULL)
{  
	  $uid = $this->routing();
	  $this->loadModel('Customer');
	  if($uid)
	  {
	  	         if($this->request->is('post'))
  	         {
				  $this->layout = '';
		          $search_data = $this->data;
		          $conditions = array();
		          $bus=$this->Business->find('first',array('conditions'=>array('Business.user_Id'=>$uid,'Business.is_deleted'=>0),'fields'=>array('Business.id')));
		    		$busIds=!empty($bus)?$bus['Business']['id']:'';
		           if(!empty($search_data['exportby']['all']) && $search_data['exportby']['all'] == 'allType')
		           {
		           	if(isset($employee_id))
		           	 {
		           	$conditions = array('Customer.employee_id'=>$employee_id,'Customer.is_delete'=>0,'Business.is_deleted'=>0); 
		            $search_data['exportby']['search'] = ''; 	
		           	 }	
		           	 else
		           	 {	
		             $conditions = array('BusinessReview.business_id'=>$busIds,'Customer.is_delete'=>0,'Business.is_deleted'=>0); 
		             $search_data['exportby']['search'] = '';
		             } 
		             }
		            if(is_numeric($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		            {
                    if(isset($employee_id))
		           	 {
		           	$conditions = array('Customer.employee_id'=>$employee_id,'BusinessReview.ratingstar' => $search_data['exportby']['search'],'Customer.is_delete'=>0,'Business.is_deleted'=>0); 
		            $search_data['exportby']['search'] = ''; 	
		           	 }
		           	 else
		           	 {	
                     $conditions = array('BusinessReview.ratingstar' => $search_data['exportby']['search'],'BusinessReview.business_id'=>$busIds,'Customer.is_delete'=>0,'Business.is_deleted'=>0);
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
				            $csv_filename = 'Reporting_Status'."_".date('M').date('dy').".csv";
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
	  $this->Session->setFlash('You are not authorized to access that location.','error');
	  $this->redirect($this->referer());
	  }	

}
function validatZip()
		{
			$zip = trim($_REQUEST['data']['AgencysiteSetting']['zip']);
			$this->autoRender = false;
			$rexSafety = "/^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/";
            if (preg_match($rexSafety, $zip)) {
 			   echo "true";die;
			} else {
    		echo "false";die;
			}
		}
function Zip()
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

public function export() 
{
		$uid = $this->routing();
		if($uid)
		{	 
				if($this->request->is('post')){
                  $this->loadModel('Business');	
				  $business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>-1));
				  $user_log_id = $business_id['Business']['id'];
				  $this->layout = '';
		          $search_data = $this->data;
		          $conditions = array();
		           if(!empty($search_data['exportby']['all']) && $search_data['exportby']['all'] == 'allType')
		           {
		            $conditions = array('Customer.business_id'=>$user_log_id,'Customer.is_delete'=>0); 
		            $search_data['exportby']['search'] = ''; 
		           }
		           if(is_numeric($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		           {
		             $conditions = array('Customer.ratingstar' => $search_data['exportby']['search'],'Customer.business_id'=>$user_log_id,'Customer.is_delete'=>0);
		             $search_data['exportby']['search'] = '';
		           }
		           if(isset($search_data['exportby']['search']) && !empty($search_data['exportby']['search']))
		           {
		           	$conditions = array('Customer.status' => $search_data['exportby']['search'],'Customer.business_id'=>$user_log_id,'Customer.is_delete'=>0,'Customer.ratingstar'=>NULL);  
		           }
		        }
				$this->loadModel('Customer');
				$this->autoRender = false;
				$data = "Firstname,Lastname,EmployeeId,EmployeeName,Email,Phonenumber,Status,Addressline1,Addressline2,City,State,Country,ZipCode,Notes \n";
				ini_set("memory_limit",-1);
		        $result = $this->Customer->find('all',array('order' =>'Customer.id DESC','contain'=>array('Country'=>array('fields'=>array('country_name')),'State'=>array('fields'=>array('stateName')),'BusinessEmployee'=>array('fields'=>array('BusinessEmployee.id','BusinessEmployee.emp_name'))),'conditions'=>$conditions,'fields'=>array('firstname','lastname','email','phonenumber','status','addressline1','addressline2','zip','notes','ratingstar','country_id','state_id','city_id')));

				 	if(count($result) > 0 && !empty( $conditions ))
		           	{
				          foreach ($result as $rslt) {
                          if(in_array($rslt['Customer']['ratingstar'], array('1','2','3','4','5')))
                          {
                          	$rslt['Customer']['status'] = $rslt['Customer']['ratingstar'].'R';
                          }
				           	   $data .= $rslt['Customer']['firstname'].",";
				                $data .= $rslt['Customer']['lastname'].",";
				                 $data .= $rslt['BusinessEmployee']['id'].",";
				                  $data .= $rslt['BusinessEmployee']['emp_name'].",";
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
				            $csv_filename = 'Business_customer_list'."_".date('M').date('dy').".csv";
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
				$this->Session->setFlash('You are not authorized to access that location.','error');
				$this->redirect($this->referer());
			}	            
} 

public function importcsv()
{
  $uid = $this->routing();
  if($uid)
  {	
  	$this->loadModel('Customer');
    $this->loadModel('Buiseness');
    $this->loadModel('BusinessReview');
    $this->loadModel('Country');
 	$this->loadModel('State');
 	$this->layout = '';
	$this->autoRender=false;
	$check=false;
	$sucess_result = 0;
   if($this->request->is('post'))
 	{ 
	 $business_id = $this->Business->find('first',array('conditions'=>array('Business.user_id'=>$uid),'fields'=>array('Business.id'),'recursive'=>0));
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
	if(@$data[$j][0] && @$data[$j][2] && @$data[$j][4] && @$data[$j][10] && @$data[$j][9] && @$data[$j][11] && @$data[$j][12]) 
	{
	$this->Customer->create();
	$info['Customer']['firstname']=@$data[$j][0];
	$info['Customer']['lastname']=@$data[$j][1];
	$info['Customer']['employee_id']=@$data[$j][2];
	$info['Customer']['emp_name']=@$data[$j][3];
	$info['Customer']['email']=@$data[$j][4];
	$info['Customer']['phonenumber']=@$data[$j][5];
	$info['Customer']['status']=@$data[$j][6];
	$info['Customer']['addressline1']=@$data[$j][7];
	$info['Customer']['addressline2']=@$data[$j][8];
	$info['Customer']['city_id']=@$data[$j][9];
	$info['Customer']['state_id']=@$data[$j][10];
    $info['Customer']['country_id']=@$data[$j][11];
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
		$info['Customer']['zip']=@$data[$j][12];
		$info['Customer']['notes']=@$data[$j][13];
		$info['Customer']['user_id'] = $uid;
		$info['Customer']['business_id'] = @$business_id['Business']['id'];
		$customer_email_status = @$info['Customer']['status']; 
		                    
		if($this->Customer->save($info))
		{
			++$sucess_result;
	     	if(in_array($info['Customer']['status'], array('1R','2R','3R','4R','5R')))
			{
	        $data1['BusinessReview']['customer_id'] = $this->Customer->getLastInsertId();
			$data1['BusinessReview']['business_id'] = $business_id['Business']['id'];
			$data1['BusinessReview']['user_id'] = $uid;
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
		}else{
		continue;
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
else{
	   	     $this->Session->setFlash('You are not authorized to access that location.','error');
	   		 $this->redirect($this->referer());	
	  } 		 
	}
	}



	public function business_review_site_promotion(){
		$uid = $this->routing();
		//pr($uid);die;
		if($uid){
			// pr($this->request->data);die;
			  $this->loadModel('Business'); 
			  $bid=$this->Business->find('first',array('contain'=>false,'conditions'=>array('Business.user_Id'=>$uid),'fields'=>array('Business.id')));
			  // pr($bid);die;
			  $data=$this->request->data;
			//  pr($data);die;
			  $this->loadModel('BusinessSitePromotion');
			  $sites=array();
			  if(isset($bid['Business']['id']) && $bid['Business']['id']){
				  	foreach ($data['BusinessSitePromotion']['review'] as $key => $value) {
				  	  if(isset($data['BusinessSitePromotion']['promotionId'][$key]) && $data['BusinessSitePromotion']['promotionId'][$key]){
				  	  	 $sites['BusinessSitePromotion']['id']=$data['BusinessSitePromotion']['promotionId'][$key];
				  	  }
				  	  $sites['BusinessSitePromotion']['business_id']=$bid['Business']['id'];
				  	  $sites['BusinessSitePromotion']['social_media_id']=@$data['BusinessSitePromotion']['socialMediaId'][$key];
				      $sites['BusinessSitePromotion']['mediasitename']=@$data['BusinessSitePromotion']['socialMediaName'][$key];
				      $sites['BusinessSitePromotion']['url']=@$data['BusinessSitePromotion']['url'][$key];
				      $sites['BusinessSitePromotion']['review']=@$data['BusinessSitePromotion']['review'][$key];
				      if(isset($data['BusinessSitePromotion']['status'][$key])){
				      	$sites['BusinessSitePromotion']['status']=1;
				      }else{
				      	$sites['BusinessSitePromotion']['status']=0;
				      }
				     // pr($data);die;
				      $this->BusinessSitePromotion->create();
				      $this->BusinessSitePromotion->save($sites);
				      continue;
				  }
				  $this->redirect($this->referer());
			  }else{
			  		$this->Session->setFlash('Invalid Business Id. Please try with valid business.','error');
	   				$this->redirect($this->referer());	
			  }
			  
		}else{
			$this->Session->setFlash('You are not authorized to access that location.','error');
	   		$this->redirect($this->referer());	
		}
		
	}
	
  function dismissSite($id=null){
  	if($id){
  		$this->loadModel('Visibility');
  		$this->Visibility->delete($id);
  		$this->Session->setFlash('Site has been successfully removed.','success');
		$this->redirect($this->referer());	
  	}else{
  		 $this->Session->setFlash('Unable to remove site. Please contact your administrator.','error');
		 $this->redirect($this->referer());	
  	}
  }
	
  function saveNotes(){
  	if(!empty($this->data)){
  		$this->loadModel('BusinessSocialMedia');
  		$this->BusinessSocialMedia->save($this->data);
  		$this->Session->setFlash('Note has been successfully saved.','success');
		$this->redirect($this->referer());	
  	}else{
  		 $this->Session->setFlash('Unable to Save. Please contact your administrator.','error');
		 $this->redirect($this->referer());	
  	}
  }

  
}
?>
