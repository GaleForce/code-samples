<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
       <?php echo $this->Session->flash(); ?>  
      <h3 class="page-title">
      <?php echo $this->element('welcome')?>
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Home</a>
            
          </li>
          
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
		
        <div class="row">
          <div class="col-lg-10 col-md-9 col-sm-8">
			<div id="content-wrapper">
				<?php App::import('Controller', 'Dashboard');
                  $dashboard = new DashboardController; ?>
						<!-- load dashboard controller to call get reatings method -->
				  <?php echo $this->element('topbar_business')?>
				
				       <!-- BEGIN PORTLET-->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-bullhorn"></i> Recent Feedback
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
							</a>
							<a href="" class="fullscreen" data-original-title="" title="">
							</a>
							<a href="javascript:;" class="reload" data-original-title="" title="">
							</a>
						  </div>
						</div>
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body grey">
						
						
						  <!-- TOOLBAR (PORT) -->
						  <div class="table-toolbar">
						  
							<div class="row">
							
							  
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="table-scrollable">
										
									
										<table class="recent-feedback" cellpadding="0" cellspacing="0" border="0" style="width:100%;">
											<tbody>
										   <?php $i=1;$j=1;
										  if(count($businessuserreview) > 0)
												{  
										  foreach($businessuserreview as $key=>$value)
											{ 
								//pr($businessuserreview);die;
											 
													$ratingstar = $value['BusinessReview']['ratingstar'];
												 ?>	
													 <tr>
																	<td class="recent-feedback-img"><img src="<?php echo HTTP_ROOT?>app/webroot/img/generic-avatar.png"></td>
																	<td class="recent-feedback-info">
																	<p class="rf-name"><?php echo @$value['BusinessReview']['firstName'].' '. @$value['BusinessReview']['lastName'] ?></p>
																	<p id='abc<?php echo $i; ?>' class="rf-subject"><?php echo $this->Text->truncate(
																			$value['BusinessReview']['ratingdescription'],
																			128,
																			array(
																				'ending' =>'...',
																				'exact' => false 
																				)
																			);
																	?></p>
																	<p class="<?php echo $j; ?>" style="display:none; font-size: 1.1em;font-weight: normal;margin: -3px 0 0;"><?php echo $value['BusinessReview']['ratingdescription'] ;?></p>
																	<?php if(strlen($value['BusinessReview']['ratingdescription']) >127){ ?>
																	<a href="javascript:void();" id="<?php echo $i; ?>" class="show"><span  class="pqr<?php echo $i; ?>"></span><lable class='pqr<?php echo $i; ?>' >Read More</lable></a>
																	<?php } ?>
																	<p class="rf-date"><?php echo date("m/d/Y", strtotime($value['BusinessReview']['ratingdate']));?></p>
																	</td>
																	<?php if($ratingstar == 5) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></td><?php } ?>
																	<?php if($ratingstar == 4) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></td><?php } ?>
																	<?php if($ratingstar == 3) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></td><?php } ?>
																	<?php if($ratingstar == 2) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></td><?php } ?>
																	<?php if($ratingstar == 1) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"></td><?php } ?>

																   <td class="or-actions">
																		<span title="Share" style="cursor:pointer" class='share-review' id="share<?php echo $value['Customer']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/share/'.$value['Customer']['id'].'/'.$value['Business']['id']?>">
																			  <img src="<?php echo $this->webroot; ?>img/action-share.png">
																		</span>
																		<span title="History" style="cursor:pointer" class='cust-history' id="history<?php echo $value['Customer']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/history/'.$value['Customer']['id']?>">
																			  <img src="<?php echo $this->webroot; ?>img/action-history.png">
																		 </span>


																		<?php $target = array(0=>1,1=>0); ?>
																		<?php if($value['BusinessReview']['approved'] == 1) {?>
																		   
																			  <span title="Active" style="cursor:pointer" class='statuschange' id="change<?php echo $value['BusinessReview']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/approveReview/'.base64_encode($value['BusinessReview']['id']).'/'.$target[$value['BusinessReview']['approved']]?>">
																			  <img id="imge<?php echo $value['BusinessReview']['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress.png"></span>
																		   
																			<?php }else{ ?>
																		  
																			  <span title="Inactive" style="cursor:pointer" class='statuschange' id="change<?php echo $value['BusinessReview']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/approveReview/'.base64_encode($value['BusinessReview']['id']).'/'.$target[$value['BusinessReview']['approved']]?>">
																			  <img id="imge<?php echo $value['BusinessReview']['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress.png"></span>
																		
																		<?php  }?>

																		<div style="display:none" type="button" id="alert" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
																		</div>

																		<!-- Modal -->
																		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																		  <div class="modal-dialog">
																			<div class="modal-content">
																			  <div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																			 
																			  </div>
																			  <div class="modal-body" style="text-align:center;" id="bdycontent">
																				
																			  </div>
																			  
																			</div>
																		  </div>
																		</div>


																	</td> 
										 
																		</tr>

																	<?php 
																	 
															
															$i++;$j++;	} 
															 
															?>
															 


														<?php 
													 
												}
														else
														{


													?>
													 <tr><td class="or-img"><?php echo "No Review Yet...";?></td></tr>
													<?php } ?>
														 
												 </tbody></table>
												 <?php if(count($businessuserreview)>3){?>
												 <a style="margin-right:34px; float:right; cursor:pointer; font-size:12px; position:relative; bottom:11px;" href="<?php echo HTTP_ROOT ?>dashboard/feedBackSeeMore/<?php echo $busid ?>" target="_blank">SEE MORE REVIEWS</a>
												 <?php } ?>
									
										
									</div>
									<!-- END MAIN -->
								</div>
							</div>
						</div>
						<!-- END BODY -->
					</div>
					<!-- END PORTLET -->
				
				
					 <!-- BEGIN PORTLET-->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-globe"></i> Online Ratings Breakdown
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
							</a>
							<a href="" class="fullscreen" data-original-title="" title="">
							</a>
							<a href="javascript:;" class="reload" data-original-title="" title="">
							</a>
						  </div>
						</div>
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body grey">
						
						
						  <!-- TOOLBAR (PORT) -->
						  <div class="table-toolbar">
						  
							<div class="row">
							
							  
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="table-scrollable">
										
										<table cellspacing="0" cellpadding="0" border="0" class="ratings-breakdown" style="width:100%;">
										  <tbody>
												<?php
												// pr($Onlinereview);die;
												if(isset($Onlinereview))
												{
													foreach ($Onlinereview as $key => $value) {
																if($value['socialMedia']['status']==1){
																	$rating_image = $value[0]['AverageRating'];
																	?>
																	<tr> 
																	<td class="rb-icon">
																		<img src="<?php echo HTTP_ROOT?>img/social-icons/<?php echo $value['socialMedia']['mediasitename'];?>.png" alt="">
																	</td>
																	<td class="rb-score"><?php echo number_format((float)$value[0]['AverageRating'],2, '.', '')?></td>
																   
																	
															 <?php 
															   if($rating_image>0)
															   { 
																?>
															  <td class="rb-stars">
															   <?php
																 $imgst = 0;
																 for($i=1;$i<=5;$i++)
																 { 
																 ?>    
																  <?php 
																  if($i<=$rating_image)
																  {
																  $imgst++;
																  $cnt = 0; 
																  ?>
																  <img src="<?php echo HTTP_ROOT?>/img/star.png">
																  <?php  
																  } 
																  else if((round($rating_image) >= $imgst) && ($rating_image > $imgst) && $cnt == 0)
																  {
																	$cnt++;
																   ?>
																	<img src="<?php echo HTTP_ROOT?>/img/half_star1.png">
																  <?php 
																	}
																   else 
																	{
																	?>
																	 <img src="<?php echo HTTP_ROOT?>img/small.png">
																  <?php 
															  }
															}
														 }else{ ?>
															<td class="rb-icon">
																		
															</td>
														<?php }
													  ?> 
														</td>
																
																	
																	<td class="rb-volume"><?php echo $value[0]['totalcount'] ?><label>&nbsp;&nbsp;Reviews</label></td>
																	 
																  </tr>
																						   <?php 
																		if($key==6){
																				//break;
																			} ?>
											  <?php
												}
											}
										}
												else
												{
												?>
											  <tr><td class="or-img"><?php echo "No Online Review Yet...";?></td></tr>

												<?php
											} ?>
										</tbody></table>
										<?php if(count($Onlinereview)>0) {?>
													 
										<?php } ?>
										
									</div>
									<!-- END MAIN -->
								</div>
							</div>
						</div>
						<!-- END BODY -->
					</div>
					<!-- END PORTLET -->
					
					
					<!-- BEGIN PORTLET-->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-star-half-o"></i> Recent Online Reviews
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
							</a>
							<a href="" class="fullscreen" data-original-title="" title="">
							</a>
							<a href="javascript:;" class="reload" data-original-title="" title="">
							</a>
						  </div>
						</div>
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body grey">
						
						
						  <!-- TOOLBAR (PORT) -->
						  <div class="table-toolbar">
						  
							<div class="row">
							
							  
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="table-scrollable">
										
														<table cellspacing="0" cellpadding="0" border="0" class="online-reviews" style="width:100%;">
														  <tbody>
													<?php $i=1;$j=1;
													if(count($onlineRevs)>0) {?>	  
													<?php foreach ($onlineRevs as $key => $value) { ?>
															
														  <tr>
															<td class="or-img"><img alt="Avatar" src="<?php echo $this->webroot; ?>img/generic-avatar.png"></td>
															<td class="or-info">
																<p class="or-name"><?php echo $value['Onlinereview']['CustomerFullName']?></p>
																<p class="or-subject">Subject</p>
													  
													  <p id='abc1<?php echo $i; ?>' class="rf-subject"><?php echo $this->Text->truncate(
																		$value['Onlinereview']['ratingdescription'],
																		128,
																		array(
																			'ending' =>'...',
																			'exact' => false 
																			)
																		);
																?></p> 
																<p class="<?php echo $j; ?>" style="display:none; font-size: 1.1em;margin: -3px 0 0;"><?php echo $value['Onlinereview']['ratingdescription'] ;?></p>
																<?php if(strlen($value['Onlinereview']['ratingdescription']) >127){ ?>
																<a href="javascript:void();" id="<?php echo $i; ?>" class="show"><span  class="pqr1<?php echo $i; ?>"></span><lable class='pqr<?php echo $i; ?>' >Read More</lable></a>
																<?php } ?>

								 
																<p class="or-date">Date of Review <?php echo @$value['Onlinereview']['updated'];?></p>
															</td>
															
														<?php if($value['Onlinereview']['ratingstar'] >= 5) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></td><?php } ?>
														<?php if($value['Onlinereview']['ratingstar'] == 4) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></td><?php } ?>
														<?php if($value['Onlinereview']['ratingstar'] == 3) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></td><?php } ?>
														<?php if($value['Onlinereview']['ratingstar'] == 2) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></td><?php } ?>
														<?php if($value['Onlinereview']['ratingstar'] == 1) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"></td><?php } ?>
														<?php /*	 
														 <td class="or-actions">
																<img src="<?php echo $this->webroot; ?>img/action-share.png">
																<img src="<?php echo $this->webroot; ?>img/action-history.png">
															
															<?php $target = array(0=>1,1=>0); ?>
																	<?php if($value['Onlinereview']['confirmation'] == 1) {?>
																	   
																		  <span title="Active" style="cursor:pointer" class='statuschange1' id="change1<?php echo $value['Onlinereview']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/onlinereviewsstatus/'.base64_encode($value['Onlinereview']['id']).'/'.$target[$value['Onlinereview']['confirmation']]?>">
																		  <img id="imge1<?php echo $value['Onlinereview']['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress-1.png"></span>
																	   
																		<?php }else{ ?>
																	  
																		  <span title="Inactive" style="cursor:pointer" class='statuschange1' id="change1<?php echo $value['Onlinereview']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/onlinereviewsstatus/'.base64_encode($value['Onlinereview']['id']).'/'.$target[$value['Onlinereview']['confirmation']]?>">
																		  <img id="imge1<?php echo $value['Onlinereview']['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress.png"></span>
																	
																	<?php  }?>
															</td>
															*/ ?>		
														</tr>

													<?php 
														if($key==4){
															break;
														}
														$i++;
														$j++;
														} 
													?>	
													<?php } else {?> 
														 <tr><td class="or-img"><?php echo "No Online Review Yet...";?></td></tr>
													<?php } ?>
														 </tbody></table>
										<?php if(count($onlineRevs)>0) {?>
													<a style="margin-right:34px; float:right; cursor:pointer; font-size:12px; position:relative; bottom:11px;" href="<?php echo HTTP_ROOT ?>dashboard/onlineFeedBackMoreReview/<?php echo $busid ?>">SEE MORE REVIEWS</a>
										<?php } ?>
										
									</div>
									<!-- END MAIN -->
								</div>
							</div>
						</div>
						<!-- END BODY -->
						
					</div>
					<!-- END PORTLET -->
			
			</div>
		  </div>
		  
		  		<?php echo $this->element('reviews_business_user')?>
		<?php echo $this->element('history')?>
		<?php echo $this->element('share')?>
		</div>
		
	
</div>
</div>



	
 
<script>
	$(document).ready(function(){
		$('.show').click(function(){
		var id=this.id;
		$('#abc'+id).hide();
		$('.'+id).show();
		$('.pqr'+id).hide();
		

	});
	})
</script>
<script>
	$(document).ready(function(){
		$('.show').click(function(){
		var id=this.id;
		$('#abc1'+id).hide();
		$('.'+id).show();
		$('.pqr1'+id).hide();

	});
	})
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.statuschange').on('click', function(){
       var url=$(this).attr('rel');
       $("#loading").show();
       $.ajax({                   
                url: url,
                type: 'POST',
                 cache: false,
                dataType: 'json',
                success: function (response) {
                  if(response[0]=='success'){
                     var newurl=ajax_url+'dashboard/approveReview/'+response[1]+'/'+response[2];
                       if(response[2]==0){
                          var newdots=ajax_url+'img/action-suppress-1.png';
                          var title='Active';
                       }else{
                         var newdots=ajax_url+'img/action-suppress.png';
                         var title='Inactive';
                       }
                       $('#change'+response[3]).attr('rel',newurl);
                       $('#change'+response[3]).attr('title',title);
                       $('#imge'+response[3]).attr('src',newdots);
                       $("#loading").hide();
	                   $('#bdycontent').html('Review has been updated Successfully.');                  
	                   $('#alert').click();
                  }else{
                    $("#loading").hide();
                    alert("!Oops there is something wrong with server.Please try again.");
                  }
                  
                  }
            })

    });
 	 $('.statuschange1').on('click', function(){
       var url=$(this).attr('rel');
       $("#loading").show();
       $.ajax({                   
                url: url,
                type: 'POST',
                 cache: false,
                dataType: 'json',
                success: function (response) {
                  if(response[0]=='success'){
                     var newurl=ajax_url+'dashboard/onlinereviewsstatus/'+response[1]+'/'+response[2];
                       if(response[2]==0){
                          var newdots=ajax_url+'img/action-suppress-1.png';
                          var title='Active';
                       }else{
                         var newdots=ajax_url+'img/action-suppress.png';
                         var title='Inactive';
                       }
                       $('#change1'+response[3]).attr('rel',newurl);
                       $('#change1'+response[3]).attr('title',title);
                       $('#imge1'+response[3]).attr('src',newdots);
                       $("#loading").hide();
	                   $('#bdycontent').html('Review has been updated Successfully.');                  
	                   $('#alert').click();
                  }else{
                    $("#loading").hide();
                    alert("!Oops there is something wrong with server.Please try again.");
                  }
                  
                  }
            })

    });
   
    });
</script>

<div id="loading" style="display:none">
  <img id="loading-image" src="<?php echo HTTP_ROOT?>img/ajax-loader.gif" alt="Loading..." />
</div>
<style type="text/css">
#loading {
  
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}

#loading-image {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 100;
}
.modal-header .close {
    margin-top: -11px;
}
</style>

