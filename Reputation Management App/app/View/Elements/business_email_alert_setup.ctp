
<style>

.btn.btn-primary {
    margin-left: 98px;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		 $('#PositiveEmailForm').validate({
		 	onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
            	"data[EmailTemplate][senderemail]":
                {
                   // required:true,
                    email:true    
                }
            },
            messages:
            {
            	"data[EmailTemplate][senderemail]":
                {
                   // required:'Please enter email.',
                    email:'Please enter valid email.'
                }
            }
		 });
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		 $('#NegativeEmailForm').validate({
		 	onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
            	"data[EmailTemplate][senderemail]":
                {
                   // required:true,
                    email:true    
                }
            },
            messages:
            {
            	"data[EmailTemplate][senderemail]":
                {
                   // required:'Please enter email.',
                    email:'Please enter valid email.'
                }
            }
		 });
	});
</script>

  
<div class="positiveemail">
<h2 class="positive_email">Positive Review Email Alert</h2>
<form class="form-horizontal" accept-charset="utf-8" method="post" id="PositiveEmailForm" action="<?php echo HTTP_ROOT?>EmailTemplates/update/<?php echo $busid;?>">
				     <div class="form-group">
				        <label class="control-label col-sm-4">Email template name:</label>
				        <div class="col-sm-6">
	 				<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo @$positive_email['EmailTemplate']['id']?>">
	 				<input type="hidden" name="data[EmailTemplate][type]" value="5">
					<input type="hidden" name="data[EmailTemplate][status]" value="1">

					 <input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo @$currentbusinessid?>">

				          <input type="text" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]" value="<?php echo @$positive_email['EmailTemplate']['emailtemplatename']?>">
				        </div>
				    </div>


					   <div class="form-group">
					      <label class="control-label col-sm-4">Email subject:</label>
					      <div class="col-sm-6">
					        <input type="text" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]" value="<?php echo @$positive_email['EmailTemplate']['emailsubject']?>">
					      </div>
					    </div>


					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Email content:</label>
					      	<div class="col-sm-6">
					       <textarea name="data[EmailTemplate][emailcontent]" id="EmailTemplatecontent"><?php echo @$positive_email['EmailTemplate']['emailcontent']?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#Posemailcontent-model">
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopup();" type="button" >Preview</a>
						    </div>
					    </div>

					    <div class="modal fade" id="Posemailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					                     <input type="button" value="Insert" class="insert">
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
					        <input type="text" class="field text full form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Customer Sender name" name="data[EmailTemplate][sendername]" value="<?php echo @$positive_email['EmailTemplate']['sendername']?>">
					      </div>
					    </div>
					  
					     
					    <div class="form-group">
					      <label class="control-label col-sm-4" for="email">Sender email:</label>
					      <div class="col-sm-6">
					        <input type="tel" class="field text full form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Senderemail" name="data[EmailTemplate][senderemail]" value="<?php echo @$positive_email['EmailTemplate']['senderemail']?>">
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
<div class="negativeemail">
	<h2 class="positive_email">Negative Review Email Alert</h2>
<form class="form-horizontal" accept-charset="utf-8" method="post" id="NegativeEmailForm" action="<?php echo HTTP_ROOT?>EmailTemplates/update/<?php echo $busid;?>">
				     <div class="form-group">
				        <label class="control-label col-sm-4">Email template name:</label>
				        <div class="col-sm-6">
	 				<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo @$negative_email['EmailTemplate']['id']?>">
	 				<input type="hidden" name="data[EmailTemplate][type]" value="6">
`					<input type="hidden" name="data[EmailTemplate][status]" value="1">

					 <input type="hidden" name="data[EmailTemplate][business_id]" value="<?php echo @$currentbusinessid?>">

				          <input type="text" class="form-control form-back" id="EmailTemplateEmailtemplatename" placeholder="Enter Email Template Name" name="data[EmailTemplate][emailtemplatename]" value="<?php echo @$negative_email['EmailTemplate']['emailtemplatename']?>">
				        </div>
				    </div>


					   <div class="form-group">
					      <label class="control-label col-sm-4">Email subject:</label>
					      <div class="col-sm-6">
					        <input type="text" class="form-control form-back" id="EmailTemplateEmailsubject" placeholder="Enter Email subject" name="data[EmailTemplate][emailsubject]" value="<?php echo @$negative_email['EmailTemplate']['emailsubject']?>">
					      </div>
					    </div>


					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Email content:</label>
					      	<div class="col-sm-6">
					       <textarea id="NegativeEmailTemplate" name="data[EmailTemplate][emailcontent]" ><?php echo @$negative_email['EmailTemplate']['emailcontent']?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#Negemailcontent-model">
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopup();" type="button" >Preview</a>
						    </div>
					    </div>

					    <div class="modal fade" id="Negemailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					                     <input type="button" value="Insert" class="insertval1">
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
					        <input type="text" class="field text full form-control form-back" maxlength="100" id="EmailTemplateSendername" placeholder="Enter Customer Sender name" name="data[EmailTemplate][sendername]" value="<?php echo @$negative_email['EmailTemplate']['sendername']?>">
					      </div>
					    </div>
					  
					     
					    <div class="form-group">
					      <label class="control-label col-sm-4" for="email">Sender email:</label>
					      <div class="col-sm-6">
					        <input type="tel" class="field text full form-control form-back" maxlength="255" id="EmailTemplateSenderemail" placeholder="Enter Senderemail" name="data[EmailTemplate][senderemail]" value="<?php echo @$negative_email['EmailTemplate']['senderemail']?>">
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

 <script type="text/javascript">

		CKEDITOR.replace( 'EmailTemplatecontent',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

			CKEDITOR.replace( 'NegativeEmailTemplate',
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
	$('.insertval1').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.NegativeEmailTemplate;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.NegativeEmailTemplate.focus();
        });

	$('.insert').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.EmailTemplatecontent;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.EmailTemplatecontent.focus();
        });

});
</script>

<script type="text/javascript">
// Popup window code
function newPopup(url) {
	var myContent = CKEDITOR.instances['EmailTemplatecontent'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}

function newPopup2(url) {
	var myContent = CKEDITOR.instances['NegativeEmailTemplate'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}
</script>
