<?php echo $this->Html->script(array('ckeditor/ckeditor.js'));?>
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
            <a href="<?php echo HTTP_ROOT?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="<?php echo HTTP_ROOT?>">Setup</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
		
        <div class="row">
          <div class="col-sm-12">
			<div id="content-wrapper">
			
				       <!-- BEGIN PORTLET-->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-briefcase"></i> Business Setup Options
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							
							<a href="" class="fullscreen" data-original-title="" title="">
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
									           <div class="wrapTab">
          
													<div class="bus_info">
													  
														<ul style="list-style-type: none;">
										<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="online_review_site">Online Review Sites</a></li>
																			   <li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="change_password">Change Password</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="info" >Business Information</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="micropage">Micro Page</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a href="<?php echo HTTP_ROOT ?>dashboard/onlineReviewSite/<?php echo $busid;?>">FeedBack Threshold</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="review_site_promotion">Review Site Promotion</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="feedback_page">Feedback Pages</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="feedback_email">Feedback Email</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="email_alert_setup">Email Alert Setup</a></li>
															<li><span aria-hidden="true" class="glyphicon glyphicon-ok"></span><a class="submenu" rel="review_plugin">Review plugin</a></li>
														</ul>
													</div>
										  <?php echo $this->element('micropage')?>

										</div>
										<!--Sub Menus-->
										 <div class="submenucontent"  id="business_online_review_site">							
														<?php echo $this->element('business_online_review_site')?>		
													</div>
																 <div class="submenucontent"  id="business_change_password">							
														<?php echo $this->element('business_change_password')?>		
													</div>
													<div class="submenucontent" id="business_info">
																	<?php echo $this->element('business_info')?>				
													</div>
													<div class="submenucontent" id="business_online_review_sites" >					
														<?php echo $this->element('business_online_review_sites')?>		
													</div>
													<div  class="submenucontent" id="business_review_site_promotion" ><?php echo $this->element('business_review_site_promotion')?>		
													</div>
														<div  class="submenucontent" id="business_feedback_page" >								
														<?php echo $this->element('business_feedback_page')?>		
													</div>
														<div class="submenucontent"  id="business_feedback_email" >							
														<?php echo $this->element('business_feedback_email')?>		
													</div>
														<div class="submenucontent"  id="business_email_alert_setup" >							
														<?php echo $this->element('business_email_alert_setup')?>		
													</div>
														<div class="submenucontent"  id="business_review_plugin" >							
														<?php echo $this->element('business_review_plugin')?>		
													</div>
										<!--Sub Menus-->
									<!-- END MAIN -->
								</div>
							</div>
						</div>
						<!-- END BODY -->
					</div>
					<!-- END PORTLET -->
			
			</div>
		  </div>
		</div>
		
		
</div>
</div>
<script>
	$(document).ready(function(){
		$('.submenucontent').css('display','none');
		$('#apply').click(function(){
			var start_time = $("#toselect option:selected" ).text();
			var end_time = $("#fromselect option:selected" ).text();
			
			$('.start').val(start_time);
			$('.end').val(end_time);
		});

	 $('.submenu').click(function(){
	 		var selectedid=$(this).attr('rel');	 		
	 		$('.submenu').css('font-weight','lighter');
	 		$('.submenucontent').hide();
	 		$('#'+'business_'+selectedid).show();
	 		$(this).css('font-weight','bolder');


	 });




	});
</script>
