<script type="text/javascript">
$(document).ready(function(){
    $('#editsite').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                
                "data[SocialMedia][url]":
                {
                    required:true,
                    url:true
                },
               
                
            },
            messages:
            {
                "data[SocialMedia][url]":
                {
                    required:"This field is required.",
                    url:"Enter a valid url."
                },
               
            }
        });
    });
</script>
<?php echo $this->element('nav_admin')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
       <?php echo $this->Session->flash(); ?>  
      <h3 class="page-title">
      ReForce Administration - Edit Site
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Administration</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="<?php echo HTTP_ROOT?>admin/sites">Manage Sites</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
		
        <div class="row">
          <div class="col-sm-12">
			<div id="content-wrapper">
			
						<span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/sites">Go Back</a></span><br /><br />
				       <!-- BEGIN PORTLET-->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-user"></i>Edit Site
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							
						  </div>
						</div>
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body form grey">
					
						  
							<div class="main-form-start form-body">
								<form class="form-horizontal"  accept-charset="utf-8" method="post" id="editsite" action="<?php echo HTTP_ROOT?>admin/editsite">
								  <input type="hidden" name="data[SocialMedia][id]" value="<?php echo $site['SocialMedia']['id']?>">
									<div class="form-group">
									  <label class="control-label col-sm-4" >Site URL:</label>
									  <div class="col-sm-4">
										<input type="text" class="form-control form-back" placeholder="Enter Site Url" name="data[SocialMedia][url]" value="<?php echo @$site['SocialMedia']['url']?>">
									  </div>
									</div>

									<div class="form-group">
									  <label class="control-label col-sm-4" >Status:</label>
									  <div class="col-sm-4">
									  <input type="checkbox" class="form-control form-back" name="data[SocialMedia][status]"  <?php if($site['SocialMedia']['status']==1){?>checked="checked"<?php } ?> value="1">
									  </div>
									</div>
								  <div class="form-group">
									<label class="control-label col-sm-4" for="email">&nbsp;</label>  
									<div class="col-sm-8 submitting"> 
										<input type="submit" class="submit btn btn-primary" value="Submit">
									 </div> 
								  </div>
								</form>
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