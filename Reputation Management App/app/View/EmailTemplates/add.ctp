<?php echo $this->Html->script(array('ckeditor/ckeditor.js'));?>
<?php echo $this->Html->script(array('jquery-ui.min.js'))?>
<?php echo $this->Html->css(array('jquery-ui.css'))?>

<style>
#cke_EmailTemplateEmailcontent
{
	width:75% !important;
}
.btn.btn-primary {
    margin-left: 98px;
}
</style>

<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
		   <?php echo $this->Session->flash(); ?>  
		  <h3 class="page-title">
		  <?php echo $this->element('welcome')?> - Add Email Template
		  </h3>
		  <div class="page-bar">
			<ul class="page-breadcrumb">
			  <li>
				<i class="fa fa-home"></i>
				<a href="<?php echo HTTP_ROOT?>">Home</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="<?php echo HTTP_ROOT?>">Email Templates</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="<?php echo HTTP_ROOT?>">Add New</a>
			  </li>
			</ul>
			<div class="page-toolbar">
			  
			</div>
		  </div>
		  <!-- END PAGE HEADER-->
        
			
			<div class="row"> <!-- ROW & COL FOR LAYOUT -->
				<div class="col-lg-10 col-md-9 col-sm-8">
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
							<i class="fa fa-user"></i>New Email Templates
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
							
							  
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="table-scrollable">
										
										<form class="form-horizontal" accept-charset="utf-8" method="post" id="EmailTemplateAddForm" action="<?php echo HTTP_ROOT?>EmailTemplates/add/<?php echo $busid;?>">

   	
											<div class="form-group">
											  <label class="control-label col-sm-4">Email Template:</label>
											  <div class="col-sm-6">
												<select name="data[EmailTemplate][type]" class="form-control">
												<?php foreach ($con as $key => $value) { ?>
													   <option value="<?php echo $key;?>"><?php echo $value ?></option>
												<?php }?>
												</select>
											  </div>
											</div>


											 <div class="form-group">
												<label class="control-label col-sm-4">Email template name:</label>
												<div class="col-sm-6">

												<input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo $bussiness_id;?>">

												  <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]">
												</div>
											</div>


										   <div class="form-group">
											  <label class="control-label col-sm-4">Email subject:</label>
											  <div class="col-sm-6">
												<input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]">
											  </div>
											</div>


											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Email content:</label>
												<div class="col-sm-6 emeil_text">
											   <textarea name="data[EmailTemplate][emailcontent]" id="EmailTemplateEmailcontent"><?php echo @$emailtemplate['AgencyTemplate']['emailcontent']?></textarea>
											  </div>
											</div>

											 <div class="form-group">
												<label class="control-label col-sm-5" for="email" id="sam_hide">&nbsp;</label>
												<div class="col-sm-6">
												 <input type="button" value="Get Merge Fields" class="btn btn-primary dam_btn" data-toggle="modal" data-target="#emailcontent-model">
												  <a href="javascript:void(0)" id="preview" class="btn preview add_preview" onclick="newPopup();" type="button" >Preview</a>
												</div>
											</div>

											<div class="modal fade" id="emailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="exampleModalLabel">Click Insert button to mearge field</h4>
												  </div>
												  <div class="modal-body">
													  <table>
															<?php foreach (@$variables as $key => $value) { ?>
																 <tr><td><?php echo $value?></td><td style="margin-left:100px">
																 <input type="button" value="Insert" class="insertval">
																 </td></tr>
															<?php }?>
													  </table>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												  </div>
												</div>
											  </div>
											</div>

											 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Sender name:</label>
											  <div class="col-sm-6">
												<input type="text" class="field text full required form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Sender name" name="data[EmailTemplate][sendername]" required="required">
											  </div>
											</div>
										  
											 
											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Sender email:</label>
											  <div class="col-sm-6">
												<input type="tel" class="field text full required form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Sender email" name="data[EmailTemplate][senderemail]" required="required">
											  </div>
											</div>

											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Start Date:</label>
											  <div class="col-sm-6">
												<input type="text" readonly="readonly" name="data[EmailTemplate][startdate]" class="datepicker startdate">
												<img id="date" src="<?php echo HTTP_ROOT.'img/date.png'?>"> 
											</div>
											</div>
										   
											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">End Date:</label>
											  <div class="col-sm-6">
												<input type="text" readonly="readonly" name="data[EmailTemplate][enddate]" class="datepicker enddate">
												<img id="date1" src="<?php echo HTTP_ROOT.'img/date.png'?>">
											  </div>
										   </div>

											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Status:</label>
											  <div class="col-sm-5">
												<select name="data[EmailTemplate][status]">
													<option value="1">Enable</option>
													<option value="0">Disable</option>
												</select>
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
				<?php echo $this->element('reviews_business_user')?>
			</div> <!-- END LAYOUT ROW -->	
		
	</div>
</div>	

<script>
$(function() {
$( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
<script type="text/javascript">

	CKEDITOR.replace( 'EmailTemplateEmailcontent',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});


$(document).ready(function(){
	$('.insertval').on('click',function(){
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.EmailTemplateEmailcontent;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.EmailTemplateEmailcontent.focus();
        });

	$('#date').click(function(){
	   $('.startdate').focus();
	  });

	  $('#date1').click(function(){
	   $('.enddate').focus();
	  });

});

</script>
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	var myContent = CKEDITOR.instances['EmailTemplateEmailcontent'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#EmailTemplateAddForm').validate({
    	ignore: [],
           onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                
                "data[EmailTemplate][business_id]":
                {
                    required:true,
                },
                "data[EmailTemplate][emailtemplatename]":
                {
                    required:true,
                },
                "data[EmailTemplate][emailsubject]":
                {
                    required:true
                },
                "data[EmailTemplate][sendername]":
                {
                    required:true
                },
                "data[EmailTemplate][senderemail]":
                {
                    required:true,
                    email:true
                },
                "data[EmailTemplate][startdate]":
                {
                   // required:true
                },
                "data[EmailTemplate][enddate]":
                {
                  //  required:true
                },
                "data[EmailTemplate][emailcontent]":
                {
                	 required:function()
                	 {
                	 	 CKEDITOR.instances.EmailTemplateEmailcontent.updateElement();
                	 }
                }
               

            },
            messages:
            {
                "data[EmailTemplate][business_id]":
                {
                    required:"This field is required."
                },
                "data[EmailTemplate][emailtemplatename]":
                {
                    required:"This field is required."
                
                },
                "data[EmailTemplate][emailsubject]":
                {
                    required:"This field is required."
                   
                },
                "data[EmailTemplate][sendername]":
                {
                    required:"This field is required."
                },
                "data[EmailTemplate][senderemail]":
                {
                   required:'Please enter email.',
                   email:'Please enter valid email.'
                },
                 "data[EmailTemplate][startdate]":
                {
                   required:'Please enter startdate.'
                },
                "data[EmailTemplate][enddate]":
                {
                   required:'Please enter enddate.'
                },
                "data[EmailTemplate][emailcontent]":
                {
                   required:'Please enter email.'
                }
                
            },
               errorPlacement: function(error, $elem) {
                    if ($elem.is('textarea')) {
                        $elem.next().css('border', '1px solid red');
                        error.insertAfter($elem.next());
                        CKEDITOR.instances.EmailTemplateEmailcontent.focus();
                    }else{
                         error.insertAfter($elem); 
                    }
                },
        
        
        });
        
        CKEDITOR.instances.EmailTemplateEmailcontent.on('contentDom', function() {
        CKEDITOR.instances.EmailTemplateEmailcontent.document.on('keyup', function(event) {
           if(CKEDITOR.instances.EmailTemplateEmailcontent.getData()==''){
                $("[for='EmailTemplateEmailcontent']").css('display','block');
                $('#EmailTemplateEmailcontent').removeClass('valid');
                $('#EmailTemplateEmailcontent').addClass('error');
                $('#EmailTemplateEmailcontent').next().css('border','1px solid red');
           }else{
                $("[for='EmailTemplateEmailcontent']").css('display','none');
                $('#EmailTemplateEmailcontent').removeClass('error');
                $('#EmailTemplateEmailcontent').addClass('valid');
                $('#EmailTemplateEmailcontent').next().css('border','none');
           }
        });
    });
    
    });

</script>
