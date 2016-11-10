
<style>

.btn.btn-primary {
    margin-left: 98px;
}

</style>

 <?php if(@$feedbacksetting['FeedbackSetting']['business_id']):?>
<form class="form-horizontal feedback_pages" accept-charset="utf-8" method="post" id="EmailTemplateAddForm" action="<?php echo HTTP_ROOT?>FeedbackSettings/update/">

 <input type="hidden" name="data[FeedbackSetting][business_id]" value="<?php echo @$currentbusinessid;?>">
 <input type="hidden" name="data[FeedbackSetting][id]" value="<?php echo @$feedbacksetting['FeedbackSetting']['id'];?>">
<?php else:?>
	<form class="form-horizontal" accept-charset="utf-8" method="post" id="EmailTemplateAddForm" action="<?php echo HTTP_ROOT?>FeedbackSettings/add/<?php echo $busid;?>">
	 <input type="hidden" name="data[FeedbackSetting][business_id]" value="<?php echo @$currentbusinessid;?>">
	
<?php endif;?>
    <div class="form-group">
    	<label class="control-label col-sm-4" for="email">Display Video</label>  
    		<div class="col-sm-6 "> 
       <input type="checkbox" name="data[FeedbackSetting][displayvideo]" class="input form-control" <?php if(@$feedbacksetting['FeedbackSetting']['displayvideo']==1){?>checked="checked"<?php } ?> value="1">
        <input type="hidden" name="data[FeedbackSetting][status]" class="input" value="1">
						          
							 </div> 
							</div>
		<div class="form-group">
	    	<label class="control-label col-sm-4" for="email">Video Embed</label>  
	    	<div class="col-sm-6 "> 
	        <textarea id="Vembed" class="input texarea form-control" name="data[FeedbackSetting][embedcodemalepostivevideo]"><?php echo @$feedbacksetting['FeedbackSetting']['embedcodemalepostivevideo'];?>
	        </textarea>
		 </div> 
		</div>
				     

					  
					 	<div class="form-group">
					      <label class="control-label col-sm-4" for="email">Special Offer </label>
					      	<div class="col-sm-6">
					       <textarea name="data[FeedbackSetting][special_offer]" id="FeedbackPageEmailTemplate"><?php echo @$feedbacksetting['FeedbackSetting']['special_offer'];?></textarea>
					      </div>
					    </div>

					     <div class="form-group">
						    <label class="control-label col-sm-4" for="email">&nbsp;</label>
						    <div class="col-sm-6">
						    <!-- <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#emailcontent-model"> -->
						      <a href="javascript:void(0)" id="preview" class="preview merge" onclick="newPopupFP();" type="button" >Preview</a>
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
					              <?php $fields=explode(',',@$defaultemplate['DefaultTemplate']['mergefields'])?>
					              <table>
					                <?php foreach (@$variables as $key => $value) { ?>
					                     <tr><td><?php echo $value?></td><td style="margin-left:100px">
					                     <input type="button" value="Insert" class="insertFP">
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
						    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
						    		<div class="col-sm-8 submitting"> 
						        <input type="submit" class="submit btn btn-primary first_ad" value="Submit">
							 </div> 
							</div>
</form>

<script type="text/javascript">

		CKEDITOR.replace( 'FeedbackPageEmailTemplate',
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
	$('.insertFP').on('click',function(){ 
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.FeedbackPageEmailTemplate;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.FeedbackPageEmailTemplate.focus();
        });

});
</script>
<script type="text/javascript">
// Popup window code
function newPopupFP(url) {
	var myContent = CKEDITOR.instances['FeedbackPageEmailTemplate'].getData();
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	popupWindow.document.write(myContent);
}
</script>
