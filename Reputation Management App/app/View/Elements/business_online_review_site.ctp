<div class="main-change-password">
    <h1 class="account-heading">Online Review Sites</h1>
    <form accept-charset="utf-8" method="post" id="onlinereviewsite" action="<?php echo HTTP_ROOT?>dashboard/editVisibilityUrl/<?php echo $busid ?>">
        
       <?php 

        $cnt = 0;
       foreach($online_review_sites as $key=>$value)
       {
        $mn= $value['SocialMedia']['mediasitename']; 
        if($value['SocialMedia']['accounttype'] == 'ReviewSite')
        {   
            $cnt++;
       ?> 
        <div class="form-group">
            <label class="control-label col-sm-4" for="email"><?php echo @$mn?> Business Url</label>
            <div class="col-sm-4">
                <!--<input type="hidden" name="data[Visibility][]" value="<?php //echo $socialmediaName?>"/> 
                <input type="hidden" name="data[Visibility][]" value="<?php //echo $value['Visibility']['id']?>"/> -->
             <?php if(in_array($mn, $media)){?>
              <input type="hidden" name="data[Visibility][]" value="<?php echo $mn?>"/>
              <input type="hidden" name="data[Visibility][]" value="<?php echo array_search($mn, $media)?>"/>  
              <?php } else { ?>
              <input type="hidden" name="data[Visibility][]" value="<?php echo $mn?>"/>
              <input type="hidden" name="data[Visibility][]" value=" "/>  
              <?php } ?> 

              <input type="text" class="form-control" name="data[Visibility][]" value="<?php echo $value['SocialMedia']['prefixurl']?>" readonly/>
			  </div>
			  <div class="col-sm-4">
                <input type="text" class="form-control" name="data[Visibility][]" value="<?php echo in_array($mn, $media)?@$media[$mn]:''?>"/>
			  </div>

                 <!--<input type="text" name="data[Visibility][]" value="<?php //echo $value['SocialMedia']['prefixurl']?>" readonly/>
                <input type="text" name="data[Visibility][]" value="<?php //echo $value['Visibility']['url']?>" required="required"/>-->  
            
        </div>
        <?php } else {
             continue;
        }
    }
         if($cnt > 0)
         {
         ?>

        <div class="form-group">
            <label class="control-label col-sm-8" for="email">&nbsp;</label>
                <div class="col-sm-4 submitting">
                    <input type="submit" class="submit btn btn-primary" value="Save Settings">
            </div>
        </div>
        <?php } else { ?>
        <p>No Reviews Site Found OR This Review sites Might be Disabled by Admin.</p>
        <?php }?>
</form>    
</div>

 <script type="text/javascript">
$(document).ready(function(){
    $('#onlinereviewsite').validate({
        onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[Visibility][url][]":
                {
                    required:true
                } 
            },
            messages:
            {
                 
                "data[Visibility][url][]":
                {
                    required:"This field is required."
                }
            }
        
        
        });
        


});

</script>