<style>

.btn.btn-primary {
    margin-left: 98px;
}



</style>
<script type="text/javascript">
$(document).ready(function(){
    $('#Feedbackemail').validate({
           onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
            	 
                 
                "data[EmailTemplate][senderemail]":
                {
                    required:true,
                    email:true,
                },
      
                
            },
            messages:
            {
            	 
                "data[EmailTemplate][senderemail]":
                {
                    required:"Please enter the Email",
                    email:"Please Enter The Valid Email"
                     
                },
                 }
          
        });
        
    
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#REMINDER').validate({
           onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
            	 
                 
                "data[EmailTemplate][senderemail]":
                {
                    required:true,
                    email:true,
                },

                 
                 
                
            },
            messages:
            {
            	 
                "data[EmailTemplate][senderemail]":
                {
                    required:"Please enter the Email",
                    email:"Please Enter The Valid Email"
                     
                },
                 }
        
        
        });
        
    
    });
</script>

<h2>Customize Automated Email Messages (Click Name to Expand)</h2>
<div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-plus-square"></i> INITIAL FEEDBACK REQUEST EMAIL</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                <!--intitial feedback email form start-->	

                    <form class="form-horizontal" accept-charset="utf-8" method="post" id="Feedbackemail" action="<?php echo HTTP_ROOT?>EmailTemplates/update/<?php echo $busid;?>">
				     <div class="form-group">
				        <label class="control-label col-sm-4">Email template name:</label>
				        <div class="col-sm-6">
	 				<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo @$initialfeedback['EmailTemplate']['id']?>">
	 				<input type="hidden" name="data[EmailTemplate][type]" value="1">
					<input type="hidden" name="data[EmailTemplate][status]" value="1">

					 <input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo @$currentbusinessid?>">

				          <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]" value="<?php echo @$initialfeedback['EmailTemplate']['emailtemplatename']?>">
				        </div>
				    </div>


					   <div class="form-group">
					      <label class="control-label col-sm-4">Email subject:</label>
					      <div class="col-sm-6">
					        <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]" value="<?php echo @$initialfeedback['EmailTemplate']['emailsubject']?>">
					      </div>
					    </div>


					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Email content:</label>
					      	<div class="col-sm-6">
					       <textarea name="data[EmailTemplate][emailcontent]" id="FeedbackEmailTemplateEmailcontent"><?php echo @$initialfeedback['EmailTemplate']['emailcontent']?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#InitialFeedemailcontent-model">
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopupFE();" type="button" >Preview</a>
						    </div>
					    </div>

					    <div class="modal fade" id="InitialFeedemailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					      <div class="modal-dialog">
					        <div class="modal-content">
					          <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <h4 class="modal-title" id="exampleModalLabel">Click Insert button to mearge field</h4>
					          </div>
					          <div class="modal-body">
					              <?php $fields=explode(',',@$defaultemplate['DefaultTemplate']['mergefields'])?>
					              <table>
					                <?php foreach (@$variables as $key => $value) { ?>
					                     <tr><td><?php echo $value?></td><td style="margin-left:100px">
					                     <input type="button" value="Insert" class="insert1">
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
					        <input type="text" class="field text full required form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Customer Sender name" name="data[EmailTemplate][sendername]" required="required" value="<?php echo @$initialfeedback['EmailTemplate']['sendername']?>">
					      </div>
					    </div>
					  
					     
					    <div class="form-group">
					      <label class="control-label col-sm-4" for="email">Sender email:</label>
					      <div class="col-sm-6">
					        <input type="tel" class="field text full required form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Senderemail" name="data[EmailTemplate][senderemail]" required="required" value="<?php echo @$initialfeedback['EmailTemplate']['senderemail']?>">
					      </div>
					    </div>


					   
						 <div class="form-group">
						    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
						    		<div class="col-sm-6 submitting"> 
						        <input type="submit" class="submit btn btn-primary first_ad" value="Submit">
							 </div> 
							</div>

						</form>
                </div>
            </div>
        </div> 
       
       <!--second 2-->
       <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fa fa-plus-square"></i> FEEDBACK REMINDER EMAIL</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                <!--intitial feedback email form start-->	

                    <form class="form-horizontal" accept-charset="utf-8" method="post" id="REMINDER" action="<?php echo HTTP_ROOT?>EmailTemplates/update/<?php echo $busid;?>">
				     <div class="form-group">
				        <label class="control-label col-sm-4">Email template name:</label>
				        <div class="col-sm-6">
	 				<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo @$feedback_reminder['EmailTemplate']['id']?>">
	 				<input type="hidden" name="data[EmailTemplate][type]" value="2">
					<input type="hidden" name="data[EmailTemplate][status]" value="1">

					 <input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo @$currentbusinessid?>">

				          <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]" value="<?php echo @$feedback_reminder['EmailTemplate']['emailtemplatename']?>">
				        </div>
				    </div>


					   <div class="form-group">
					      <label class="control-label col-sm-4">Email subject:</label>
					      <div class="col-sm-6">
					        <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]" value="<?php echo @$feedback_reminder['EmailTemplate']['emailsubject']?>">
					      </div>
					    </div>


					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Email content:</label>
					      	<div class="col-sm-6">
					       <textarea name="data[EmailTemplate][emailcontent]" id="FeedbackRemainderEmailcontent"><?php echo @$feedback_reminder['EmailTemplate']['emailcontent']?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#FeedRememailcontent-model">
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopupFR();" type="button" >Preview</a>
						    </div>
					    </div>

					    <div class="modal fade" id="FeedRememailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					      <div class="modal-dialog">
					        <div class="modal-content">
					          <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <h4 class="modal-title" id="exampleModalLabel">Click Insert button to mearge field</h4>
					          </div>
					          <div class="modal-body">
					              <?php $fields=explode(',',@$defaultemplate['DefaultTemplate']['mergefields'])?>
					              <table>
					                <?php foreach (@$variables as $key => $value) { ?>
					                     <tr><td><?php echo $value?></td><td style="margin-left:100px">
					                     <input type="button" value="Insert" class="insert2">
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
					        <input type="text" class="field text full required form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Customer Sender name" name="data[EmailTemplate][sendername]" required="required" value="<?php echo @$feedback_reminder['EmailTemplate']['sendername']?>">
					      </div>
					    </div>
					  
					     
					    <div class="form-group">
					      <label class="control-label col-sm-4" for="email">Sender email:</label>
					      <div class="col-sm-6">
					        <input type="tel" class="field text full required form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Senderemail" name="data[EmailTemplate][senderemail]" required="required" value="<?php echo @$feedback_reminder['EmailTemplate']['senderemail']?>">
					      </div>
					    </div>


					   
						 <div class="form-group">
						    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
						    		<div class="col-sm-6 submitting"> 
						        <input type="submit" class="submit btn btn-primary first_ad" value="Submit">
							 </div> 
							</div>

						</form>
                </div>
            </div>
        </div> 

        <!-- 3rd one-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="fa fa-plus-square"></i> POSITIVE FEEDBACK THANK YOU EMAIL</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                <!--intitial feedback email form start-->	

                    <form class="form-horizontal" accept-charset="utf-8" method="post" id="POSITIVE_FEEDBACK" action="<?php echo HTTP_ROOT?>EmailTemplates/update/<?php echo $busid;?>">
				     <div class="form-group">
				        <label class="control-label col-sm-4">Email template name:</label>
				        <div class="col-sm-6">
	 				<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo @$positive_feedback['EmailTemplate']['id']?>">
	 				<input type="hidden" name="data[EmailTemplate][type]" value="3">
					<input type="hidden" name="data[EmailTemplate][status]" value="1">

					 <input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo @$currentbusinessid?>">

				          <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]" value="<?php echo @$positive_feedback['EmailTemplate']['emailtemplatename']?>">
				        </div>
				    </div>


					   <div class="form-group">
					      <label class="control-label col-sm-4">Email subject:</label>
					      <div class="col-sm-6">
					        <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]" value="<?php echo @$positive_feedback['EmailTemplate']['emailsubject']?>">
					      </div>
					    </div>


					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Email content:</label>
					      	<div class="col-sm-6">
					       <textarea name="data[EmailTemplate][emailcontent]" id="PositiveFeedbackEmailcontent"><?php echo @$positive_feedback['EmailTemplate']['emailcontent']?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#PositiveFeedemailcontent-model">
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopupPF();" type="button" >Preview</a>
						    </div>
					    </div>

					    <div class="modal fade" id="PositiveFeedemailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					      <div class="modal-dialog">
					        <div class="modal-content">
					          <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <h4 class="modal-title" id="exampleModalLabel">Click Insert button to mearge field</h4>
					          </div>
					          <div class="modal-body">
					              <?php $fields=explode(',',@$defaultemplate['DefaultTemplate']['mergefields'])?>
					              <table>
					                <?php foreach (@$variables as $key => $value) { ?>
					                     <tr><td><?php echo $value?></td><td style="margin-left:100px">
					                     <input type="button" value="Insert" class="insert3">
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
					        <input type="text" class="field text full required form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Customer Sender name" name="data[EmailTemplate][sendername]" required="required" value="<?php echo @$positive_feedback['EmailTemplate']['sendername']?>">
					      </div>
					    </div>
					  
					     
					    <div class="form-group">
					      <label class="control-label col-sm-4" for="email">Sender email:</label>
					      <div class="col-sm-6">
					        <input type="tel" class="field text full required form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Senderemail" name="data[EmailTemplate][senderemail]" required="required" value="<?php echo @$positive_feedback['EmailTemplate']['senderemail']?>">
					      </div>
					    </div>


					   
						 <div class="form-group">
						    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
						    		<div class="col-sm-6 submitting"> 
						        <input type="submit" class="submit btn btn-primary first_ad" value="Submit">
							 </div> 
							</div>

						</form>
                </div>
            </div>
        </div> 
         <!-- 4rd one-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsefOUR"><i class="fa fa-plus-square"></i> NEGATIVE FEEDBACK THANK YOU EMAIL</a>
                </h4>
            </div>
            <div id="collapsefOUR" class="panel-collapse collapse">
                <div class="panel-body">
                <!--intitial feedback email form start-->	

                    <form class="form-horizontal" accept-charset="utf-8" method="post" id="NEGATIVE_FEEDBACK" action="<?php echo HTTP_ROOT?>EmailTemplates/update/<?php echo $busid;?>">
				     <div class="form-group">
				        <label class="control-label col-sm-4">Email template name:</label>
				        <div class="col-sm-6">
	 				<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo @$negative_feedback['EmailTemplate']['id']?>">
	 				<input type="hidden" name="data[EmailTemplate][type]" value="4">
					<input type="hidden" name="data[EmailTemplate][status]" value="1">

					 <input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo @$currentbusinessid?>">

				          <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]" value="<?php echo @$negative_feedback['EmailTemplate']['emailtemplatename']?>">
				        </div>
				    </div>


					   <div class="form-group">
					      <label class="control-label col-sm-4">Email subject:</label>
					      <div class="col-sm-6">
					        <input type="text" required="required" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]" value="<?php echo @$negative_feedback['EmailTemplate']['emailsubject']?>">
					      </div>
					    </div>


					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Email content:</label>
					      	<div class="col-sm-6">
					       <textarea name="data[EmailTemplate][emailcontent]" id="NegativeFeedbackEmailcontent"><?php echo @$negative_feedback['EmailTemplate']['emailcontent']?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#NegativeFeedemailcontent-model">
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopupNF();" type="button" >Preview</a>
						    </div>
					    </div>

					    <div class="modal fade" id="NegativeFeedemailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					                     <input type="button" value="Insert" class="insert4">
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
					        <input type="text" class="field text full required form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Customer Sender name" name="data[EmailTemplate][sendername]" required="required" value="<?php echo @$negative_feedback['EmailTemplate']['sendername']?>">
					      </div>
					    </div>
					  
					     
					    <div class="form-group">
					      <label class="control-label col-sm-4" for="email">Sender email:</label>
					      <div class="col-sm-6">
					        <input type="tel" class="field text full required form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Senderemail" name="data[EmailTemplate][senderemail]" required="required" value="<?php echo @$negative_feedback['EmailTemplate']['senderemail']?>">
					      </div>
					    </div>


					   
						 <div class="form-group">
						    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
						    		<div class="col-sm-6 submitting"> 
						        <input type="submit" class="submit btn btn-primary first_ad" value="Submit">
							 </div> 
							</div>

						</form>
                </div>
            </div>
        </div> 
      
</div>

    <script type="text/javascript">

	CKEDITOR.replace( 'FeedbackEmailTemplateEmailcontent',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

	CKEDITOR.replace( 'FeedbackRemainderEmailcontent',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

	CKEDITOR.replace( 'PositiveFeedbackEmailcontent',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

		CKEDITOR.replace( 'NegativeFeedbackEmailcontent',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});


</script>

<script>
	$(document).ready(function(){
	$('.insert1').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.FeedbackEmailTemplateEmailcontent;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.FeedbackEmailTemplateEmailcontent.focus();
        });

	$('.insert2').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.FeedbackRemainderEmailcontent;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.FeedbackRemainderEmailcontent.focus();
        });

	$('.insert3').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.PositiveFeedbackEmailcontent;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.PositiveFeedbackEmailcontent.focus();
        });

	$('.insert4').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.NegativeFeedbackEmailcontent;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.NegativeFeedbackEmailcontent.focus();
        });

});
</script>
<script type="text/javascript">
// Popup window code
function newPopupFE(url) {
	var myContent = CKEDITOR.instances['FeedbackEmailTemplateEmailcontent'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}

function newPopupFR(url) {
	var myContent = CKEDITOR.instances['FeedbackRemainderEmailcontent'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}

function newPopupPF(url) {
	var myContent = CKEDITOR.instances['PositiveFeedbackEmailcontent'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}

function newPopupNF(url) {
	var myContent = CKEDITOR.instances['NegativeFeedbackEmailcontent'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}
</script>
