
<div class="site_promotion">
 <form id="formSetup" method="POST" class="form" enctype="multipart/form-data" action="<?php echo HTTP_ROOT?>dashboard/business_review_site_promotion/<?php echo $busid?>">

 <h5 class="pub_mr_site">Review Site Promotion</h5>

 	<div>
 		<h2 class="positive_email">Review Site</h2>
 	</div>

 	
 	<?php foreach ($promotionsites as $key=>$value) {  	?>
 				<input type="hidden" name="data[BusinessSitePromotion][bid][]" value="<?php echo @$value['SocialMedia']['bid']?>"/>
 				<input type="hidden" name="data[BusinessSitePromotion][promotionId][]" value="<?php echo @$value['SocialMedia']['promotionId']?>"/>
 				<input type="hidden" name="data[BusinessSitePromotion][socialMediaId][]" value="<?php echo @$value['SocialMedia']['id']?>"/>
 				<input type="hidden" name="data[BusinessSitePromotion][socialMediaName][]" value="<?php echo @$value['SocialMedia']['mediasitename']?>"/>
	 			<div class="form-group">
		 			<label for="email" class="control-label col-sm-4">
		 				<?php echo $value['SocialMedia']['mediasitename'];?> 			
		 			</label>
		 			<div class="col-sm-4">
		 				<input type="checkbox" <?php if(isset($value['SocialMedia']['promotionStatus']) && $value['SocialMedia']['promotionStatus']){?> value="1" checked="checked" <?php } else {?> value="0"<?php }?> name="data[BusinessSitePromotion][status][<?php echo $key ?>]">
		 			</div>
	 			</div>
	 			<div class="form-group">
		 			<label for="email" class="control-label col-sm-4">
		 				<img src="/repmgsys/img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png">
		 			</label>

		 			<div class="col-sm-4">
			 			<input type="textbox" value="<?php echo $value['SocialMedia']['url'] ?>" name="data[BusinessSitePromotion][url][]" class="business_form form-control">

			 			<input type="textbox" placeholder="Review us" value="<?php echo @$value['SocialMedia']['review'] ?>" name="data[BusinessSitePromotion][review][]" class="business_form form-control"> 
	 				</div>
	 			</div>
 		<?php }?>
 			
<div class="form-group">
	<label class="control-label col-sm-2" for="email">&nbsp;</label>  
	<div class="col-sm-10 submitting"> 
        <input type="submit" class="submit btn btn-primary mcr_sit_btn" value="Submit">
	</div> 
</div>
 
</form>			

</div>
