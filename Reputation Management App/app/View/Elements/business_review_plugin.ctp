<h5 class="pub_mr_site">Review Plugin</h5>
<div class="reviews_sites">
    <?php if(count($Reviewsitedata)>0):?>
      <div class="main-change-password">
        <h2 class="account-heading">Customize Website Plugin</h2>
        <form accept-charset="utf-8" method="post" id="onlinereviewsite" action="<?php echo HTTP_ROOT?>dashboard/onlineReviewPlugin/<?php echo $busid ?>">
         <?php foreach($Reviewsitedata as $key=>$value):?>
            <?php $reviewSiteId= $value['SocialMedia']['id']; 
                $mn = $value['SocialMedia']['mediasitename']; 
            ?>
               <div class="form-group">
                    <label class="control-label col-sm-3" for="email">
                    <?php echo @$mn?> Business </label>                    
                     <?php if(in_array($reviewSiteId,$reviewSite)){?>
                      <input type="checkbox" name = "data[socialMedia][id][]" value="<?php echo $reviewSiteId; ?>" checked="checked">
                      <input type="hidden" name="data[UncheckedSocialMedia][id][]" value="<?php echo $reviewSiteId; ?>">
                        <?php } else {?>
                       <input type="checkbox" name = "data[socialMedia][id][]" value="<?php echo $reviewSiteId; ?>">
                     <?php } ?>                    
                    <div class="col-sm-9"></div>                     
               </div>
         <?php endforeach;?>
         <div class="form-group">
            <label class="control-label col-sm-3" for="email">&nbsp;</label>
                <div class="col-sm-9 submitting">
                    <input type="submit" class="submit btn btn-primary" value="SAVE">
            </div>
        </div>
         </form>
       </div>  
    <?php endif;?>
</div>
  
<div id="review_plugin_script" style="background:#ddd;padding:10px;">
<p><strong>Copy and add the below script to before the closing of Body tag</strong></p>

<?php
$domain=HTTP_ROOT;
$script=$domain.'js/review.js';
$content= <<<CONTENT
  <div id="reputation"> </div>
  <script src="$script"></script> 
  <script type="text/javascript"> 
  function review_load(){var e="$domain";var b='$businessid';fetchReviews(e,b)}
  window.onload=review_load();
  </script>
CONTENT;
?>
<pre><code>
<?php
$content=str_replace('<','&lt;',$content);
echo $content;?>
</code></pre>
</div>
 
