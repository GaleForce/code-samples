<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
		   <?php echo $this->Session->flash(); ?>  
		  <h3 class="page-title">
		  <?php echo $this->element('welcome')?> - Modify Auto Email Settings
		  </h3>
		  <div class="page-bar">
			<ul class="page-breadcrumb">
			  <li>
				<i class="fa fa-home"></i>
				<a href="<?php echo HTTP_ROOT?>">Home</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="<?php echo HTTP_ROOT?>">Setup</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="<?php echo HTTP_ROOT?>">Auto Email Settings</a>
			  </li>
			</ul>
			<div class="page-toolbar">
			  
			</div>
		  </div>
		  <!-- END PAGE HEADER-->
        
			
			<div class="row"> <!-- ROW & COL FOR LAYOUT -->
				<div class="col-sm-12">
				<?php echo $this->Session->flash(); ?>  
				
				<!----------------------------------->
				<!----------------------------------->
					  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
				      <!--   >>  BEGIN PORTLET  << -->
					  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-user"></i>Automated Email Settings
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							<!-- <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
							</a> -->
							<a href="" class="fullscreen" data-original-title="" title="">
							</a>
							<!-- <a href="javascript:;" class="reload" data-original-title="" title="">
							</a> -->
						  </div>
						</div>
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body grey">
						
						
						  <!-- TOOLBAR (PORT) -->
						  <div class="table-toolbar">
						  
							<div class="row">
							
							  <div class="col-md-12">
								<span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>dashboard/businesSetup/<?php echo $busid; ?>">Go Back</a></span>
							  </div>
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-sm-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="">
										
										<?php $limit = 10;?>
										<form class="form form-horizontal online-review-form"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>dashboard/onlineReviewSite/<?php echo $busid;?>">

    
										   <div class="form-group">
											<input type="hidden" value="<?php echo $data['Business']['id'];  ?>" name="data[Business][id]">
												 <label class="control-label col-sm-6">Positive Feedback Threshold:</label>   
													<div class="col-sm-2">
												  <?php
												  $feed = $data['Business']['feedbackthreshold'];
											  
												  ?>
											  <select class="form-selected form-control" required="required" id="feedbackthreshold" name="data[Business][feedbackthreshold]">
											  
											  <?php 
											  for($i = 1; $i <= 5; $i++)
											  {
											  ?>
											<option <?php if($i==$feed)  { ?> selected="selected" value="<?php echo $data['Business']['feedbackthreshold']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?>-Star </option>
												<?php
											  }

											?>

											</select>

											</div>
											</div>


										<div class="form-group">
												 <label class="control-label col-sm-6">Number of Automated E-mail Attempts:</label>   
													<div class="col-sm-2">
													<?php
													
												  $auto_email = $data['Business']['automatedenailattempts'];
												   

												  ?>

										  <select class="form-selected form-control" required="required" id="automatedenailattempts" name="data[Business][automatedenailattempts]">
											 
											  <?php $limit_emial = 10;
											  for($i = 1; $i <= $limit_emial; $i++)
											  {
											  ?>
											  <option <?php if($i==$auto_email)  { ?> selected="selected"  value="<?php echo $data['Business']['automatedenailattempts']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
												<?php
											  }
											?>
											</select>
											   </div>
											 </div>  


										 

											<div class="form-group">
												 <label class="control-label col-sm-6">Automated Email Frequency (Days):</label>   
													<div class="col-sm-2">
													  <?php
													
												  $emial_freq = $data['Business']['emailfrequency'];
												  ?>

										  <select class="form-selected form-control" required="required" id="emailfrequency" name="data[Business][emailfrequency]">
												   
												   
											  <?php $limit_freq = 10;
											  for($i = 1; $i <= $limit_freq; $i++)
											  {
											  ?>
											  <option <?php if($i==$emial_freq)  { ?> selected="selected" value="<?php echo $data['Business']['emailfrequency']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
												<?php
											  }
											?>
													   


										  
												  </select>
													 </div>
												 </div>     



										  <div class="form-group">


										   <label class="control-label col-sm-6" for="email">Number of Follow-up Email Attempts:</label>
										<div class="col-sm-2">
											<?php
													
												  $emial_freq = $data['Business']['automatedpostfeedbackenailattempts'];
												  ?>

										  <select class="form-selected form-control" required="required" id="emailfrequency" name="data[Business][automatedpostfeedbackenailattempts]">
												   
													
											  <?php $limit_freq = 10;
											  for($i = 1; $i <= $limit_freq; $i++)
											  {
											  ?>
											  <option <?php if($i==$emial_freq)  { ?> selected="selected" value="<?php echo $data['Business']['automatedpostfeedbackenailattempts']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
												<?php
											  }
											?>
													   


										  
												  </select>
										</div>
											</div>





											<div class="form-group">


										   <label class="control-label col-sm-6" for="email">Automated Follow-up Frequency (Days):</label>
										   <div class="col-sm-2">
										 <?php
													
												  $emial_freq = $data['Business']['postfeedbackemailfrequency'];
												  ?>

										  <select class="form-selected form-control" required="required" id="emailfrequency" name="data[Business][postfeedbackemailfrequency]">
												   
													
											  <?php $limit_freq = 10;
											  for($i = 1; $i <= $limit_freq; $i++)
											  {
											  ?>
											  <option <?php if($i==$emial_freq)  { ?> selected="selected" value="<?php echo $data['Business']['postfeedbackemailfrequency']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
												<?php
											  }
											?>
													   


										  
												  </select>
										</div>
											</div>


										  
												 
											  

										  <div class="form-group">
											<label class="control-label col-sm-6" for="email">&nbsp;</label>  
											<div class="col-sm-2 submitting"> 
												<input type="submit" class="submit btn btn-primary" value="Submit">
												 <span><a class="btn btn-danger cancel" href="<?php echo HTTP_ROOT?>dashboard/businesSetup/<?php echo $busid; ?>">Cancel</a></span></h1>
											 </div> 
											</div>


										 
										</form>
									
									</div>
									<!-- MAIN END -->
								</div>
							</div>
							
						</div>
						<!-- END PORTLET BODY -->
						
					</div>
					<!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
					<!--   >>   END PORTLET  <<  -->
					<!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
			  <!----------------------------------->
			  <!----------------------------------->
		
				</div>
			</div> <!-- END LAYOUT ROW -->	
		
	</div>
</div>	


<div class="businesses container">

<h1 class="business-heading">FEEDBACK THRESHOLDS </h1>
<!-- <div class="main-back">
<a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>dashboard/manageUser">Go Back</a></div> --> 

<div class="add-business">


<div class="main-form-start">

</div>

</div>
