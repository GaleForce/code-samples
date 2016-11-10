<script type="text/javascript">
$(document).ready(function(){
	$('#ResetPassword').validate({
			rules:
			{
				"data[User][password]":
				{
					required:true,
					minlength: 8
				},
				"data[User][cpassword]":
				{
					required:true,
					equalTo:'#UserPassword'
				}
				
			},
			messages:
			{
				"data[User][password]":
				{
					required:"This field is required.",
					minlength: 'Password should be atleast 8 characters long.'
				},
				"data[User][cpassword]":
				{
					required:"This field is required.",
					equalTo:'Password and confirm password does not match.'
				}
				
			}
		
		
		});
		
	
	});
</script>

<?php echo $this->element('nav')?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">
<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?php echo $design['AgencysiteSetting']['sitetitle']; ?> - Change Password
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Change Password</a>
					</li>
				</ul>
				<div class="page-toolbar">
					
				</div>
			</div>
			<!-- END PAGE HEADER-->
        
        <div class="row">
          <div class="col-sm-12">
            <div id="content-wrapper">

              <div class="wrapTab">
           
           
             
            <div class="bodyTaab">
            <!--start the section-->
<div class="col-md-10">
				<!-- BEGIN PORTLET-->
					<div class="portlet box reforce-red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>Change Password
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
					<div class="portlet-body form grey">
							<div class="table-toolbar">
							
							<br />
							<a class="go-back btn btn-primary pull-right" href="<?php echo HTTP_ROOT?>dashboard/manageUser">Go Back</a>
							
								<div class="row">
								
									<div class="col-md-12">
											 								
									</div>	
																
								</div>
							
						
						
								</div>
					<!-- START FIELDS -->
					<form class="form-horizontal" accept-charset="utf-8" method="post" id="ResetPassword" action="<?php echo HTTP_ROOT?>businesses/resetPassword">
      
						 <input type="hidden" name="data[User][id]" value="<?php echo $udata['User']['id']?>">


						<div class="form-group">
						<label class="control-label col-sm-4" for="email">New Password:</label>
						<div class="col-sm-4">
						<input class="form-control account-back" type="password" required="required" id="UserPassword" name="data[User][password]">
						</div>
						</div>

						<div class="form-group">
						<label class="control-label col-sm-4" for="email">Confirm Password:</label>
						<div class="col-sm-4">
						<input class="form-control account-back" type="password" required="required" id="cpass" name="data[User][cpassword]">
						</div>
						</div>

						<div class="form-group">
						<label class="control-label col-sm-4" for="email">&nbsp;</label>
						<div class="col-sm-4 submitting">
						<input type="submit" class="submit btn btn-primary" value="Submit">
						</div>
						</div>

					</form>
					</div>
					<!-- END PORTLET-->



   </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
