  <script src="http://cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.1.6/ZeroClipboard.js" type="text/javascript"></script>  
 <?php echo $this->Html->script('jquery'); ?>
 <?php echo $this->Html->script('jquery.validate.min'); ?>
 <?php echo $this->Html->css('bootstrap.min.css'); ?>
 <?php echo $this->Html->css('bootstrap-theme.min.css'); ?>
 <?php echo $this->Html->css('repelev.css'); ?>

 
<div class="rating-container"><!--===main-container start here===-->


<div class="row">

<div class="col-md-6 logo-style">
 <div class="co-logo"><a href="javascript:void(0)"><?php if(isset($address)){?><img style="width:100%;height:100px;" src="<?php echo HTTP_ROOT;?>img/<?php echo @$address['Business']['business_logo'] ?>" alt="Company Logo"/><?php }?></a></div>
</div>

<div class="col-md-6 logo-non-style">  
  <div class="co-logo"><b>Address:</b>&nbsp;<?php echo @$address['Business']['addressline1'].' '. @$address['Business']['addressline2'] ?></br>
    City:<label><?php echo @$address['City']['city_name'];?></label></br>
    State:<label> <?php echo @$address['State']['stateName'];?></label></br>
    Country: <label><?php echo @$address['Country']['country_name'];?></label></br>
  </div>
</div>

</div>



<div class="row">

<div class="col-md-8"> 
<div class="thank-feedback-left">
      <p>Thank you so much for your valuable feedback!</p>
      <p><strong>Dear <?php echo $customer_name['Customer']['firstname'].' '.$customer_name['Customer']['lastname'] ?>,</strong></p>
      <p>We work hard to exceed our customers'expectations,We know you have many option so, It is rewarding to hear that you are happy you selected marketing. </p>
      <p>Would you be willing to share your comments with others who may be looking our service? if so, simply copy your review then choose your favorite review site from the links below,click and login then the submit your reviews.</p>
      <p>Thank you ! We truely appreciate your review and your willingness to share your experience.</p>

      <p>Here is your review. Simply click on the next below to copy and use on one of the review sites listed here.</p>
      <div>
      <textarea class="copy-comment" id="copyReview"><?php echo $review_given['BusinessReview']['ratingdescription'] ?></textarea>
      </div>
      <div>
      <label class="copy-btn">Press this button to copy your feedback</label><button type="button" class="btn btn-primary copied" id="Copy">Copy</button>
      </div>

</div>
</div>


<div class="col-md-4">

  <div class="thank-feedback-right">

  <h2>Please share your experience with the world on one of these sites below!</h2>

  <div class="social-share">

  <h6><strong>Simply follow these 3 easy steps:</strong></h6>
  <ul>
    <li>Copy your feedback below</li>
    <li>Click on the logo below to write a review</li>  
    <li>Paste your feedback</li>  
  </ul>
 <?php if(empty($sites)){?> 
 
<?php }else { ?>
    <?php foreach($sites as $site){?>
      <div class="review-google">
        <a href="<?php echo $site['Visibility']['pageurl']?>" target='_blank'>
          <img src="<?php echo $this->webroot.'img/social-icons/'.$site['SocialMedia']['mediasitename'].'1.png'; ?>" alt="<?php echo $site['SocialMedia']['mediasitename']?>">
        </a>
      </div>
    <?php }?>

<?php }?>
  </div>




  </div>

</div>



</div>
</div>
 
 

<script type="text/javascript">
        $(document).ready(function(){
        $('#Copy').click(function(){ 
        var client = new ZeroClipboard(document.getElementById("copyReview"));
        client.on("ready", function (readyEvent) {
            client.on("aftercopy", function (event) {
           });
        });
      });
      });  
</script>
