 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
 <?php echo $this->Html->script('jquery'); ?>
 <?php echo $this->Html->script('jquery.validate.min'); ?>
 <?php echo $this->Html->css('bootstrap.min.css'); ?>
 <?php echo $this->Html->css('bootstrap-theme.min.css'); ?>
 <?php echo $this->Html->css('repelev.css'); ?>

<script type="text/javascript">
$(document).ready(function(){
    $('#CustomerRatingForm').validate({
           event:'blur',
            rules:
            {
              "data[BusinessReview][ratingstar]":
                {
                    required:true
                },
                "data[BusinessReview][ratingdescription]":
                {
                   required:true
                },
                   
            },
            messages:
            {
               "data[BusinessReview][ratingstar]":
                {
                    required:"Rating could not be empty."
                },
                "data[BusinessReview][ratingdescription]":
                {
                    required:"Please enter the description."
                     
               },
              }
         });
      });
</script>


<div class="rating-container"><!--===main-container start here===-->


<div class="row">

<div class="col-md-6 logo-style">
 <div class="co-logo"><a href="javascript:void(0)"><?php if(isset($address)){?><img style="width:100%;height:100px;" src="<?php echo HTTP_ROOT;?>img/<?php echo @$address['Business']['business_logo'] ?>" alt="Company Logo"/><?php }?></a></div>
</div>

<div class="col-md-6 logo-non-style">  
  <div class="co-logo"><b>Address:</b>&nbsp;<?php echo @$address['Business']['addressline1'].' '. @$address['Business']['addressline2'] ?></br>
    City:<label><?php echo @$address['Business']['city'];?></label></br>
    State:<label> <?php echo @$address['State']['stateName'];?></label></br>
    Country: <label><?php echo @$address['Country']['country_name'];?></label></br>
  </div>
</div>

</div>



<div class="row">
<div class="col-md-12">

<div class="review-form-start">
<!--Feed Back Setting Start -->
<div class="feedsetting ">
<?php if(@$feedbacksetting['FeedbackSetting']['displayvideo']):?>
<?php echo @$feedbacksetting['FeedbackSetting']['embedcodemalepostivevideo'];?>

<h2>Special Offer</h2>
<?php echo @$feedbacksetting['FeedbackSetting']['special_offer'];?>
</div>
<div class="sepline"></div>
<?php endif;?>

<!--Feed Back Setting End -->
  <form method="post" id="frmreview" accept-charset="utf-8" action="<?php echo HTTP_ROOT ?>admin/postReview" id="CustomerRatingForm">
  
 
  
   <div class="form-group">
      <label class="control-label col-sm-4">Your Rating of Us</label>

      <div class="col-sm-8">
     <input type="hidden" class="ratingvalue" name="data[BusinessReview][ratingstar]">
    

    <div class="rating-select">
    <div class="btn btn-default btn-sm class1">
      <span class="glyphicon glyphicon-star-empty">
      </span>
    </div>
    
    
    <div class="btn btn-default btn-sm class2">
      <span class="glyphicon glyphicon-star-empty">
      </span>
      
    </div>

    <div class="btn btn-default btn-sm class3">
      <span class="glyphicon glyphicon-star-empty">
      </span>
     
    </div>

    <div class="btn btn-default btn-sm class4">
      <span class="glyphicon glyphicon-star-empty">
      </span>
      
    </div>

    <div class="btn btn-default btn-sm class5">
      <span class="glyphicon glyphicon-star-empty">
      </span>
      
    </div>
     
  </div></br>
<div style="display:none;color:red;" id="notificationstar"></div>

   </div>
</div>


<div class="form-group">
      <label class="control-label col-sm-4" for="email">Review Us: What was your experience?</label>
      <div class="col-sm-8">
<textarea class="field text full required form-control review-back" id="pwd" name="data[BusinessReview][ratingdescription]"></textarea>
      </div>
      <div style="display:none;color:red;" id="notificationtxt"></div>
    </div>
     
   <div class="form-group">

      <div class="col-sm-4"></div>
     
     <label class="control-label col-sm-8 review-average">
     <input class="roomselect" type="checkbox" name="data[BusinessReview][share_online]" value="1"> i am authorizing to post my review and name online.
      i confirm that i have done business  with Marketing and that my review is valid.</label>
</div>
<div style="display:none;color:red;" id="notificationcheckbox"></div>
<div class="form-group">
    <input type="hidden" name="data[BusinessReview][user_id]" value="<?php echo @$user_id;?>">
    <input type="hidden" name="data[BusinessReview][customer_id]" value="<?php echo @$customer_id;?>">
      <label class="control-label col-sm-4"></label>
      <div class="col-sm-8">
  <input type="button" class="review-btn postreview" value="Post Review">
  </div>
</div>

</form>
</div>
</div>
</div>
</div>
 
<script type="text/javascript">
$(function(){
    $('.rating-select .btn').on('mouseover', function(){
        $(this).removeClass('btn-default').addClass('btn-warning');
        $(this).prevAll().removeClass('btn-default').addClass('btn-warning');
        $(this).nextAll().removeClass('btn-warning').addClass('btn-default');
    });

    $('.rating-select').on('mouseleave', function(){
        active = $(this).parent().find('.selected');
        if(active.length) {
            active.removeClass('btn-default').addClass('btn-warning');
            active.prevAll().removeClass('btn-default').addClass('btn-warning');
            active.nextAll().removeClass('btn-warning').addClass('btn-default');
        } else {
            $(this).find('.btn').removeClass('btn-warning').addClass('btn-default');
        }
    });

    $('.rating-select .btn').click(function(){

        if($(this).hasClass('selected')) {
            $('.rating-select .selected').removeClass('selected');
        } else {
            $('.rating-select .selected').removeClass('selected');
            $(this).addClass('selected');

            if($(this).hasClass('class1')) { 
              $('.ratingvalue').val('1');
              }
              if($(this).hasClass('class2')) { 
              $('.ratingvalue').val('2');
              }
               if($(this).hasClass('class3')) { 
              $('.ratingvalue').val('3');
              }
               if($(this).hasClass('class4')) { 
              $('.ratingvalue').val('4');
              }
               if($(this).hasClass('class5')) { 
              $('.ratingvalue').val('5');
              }


        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('.postreview').click(function(){
   var rat = $('.ratingvalue').val();
   var txt = $('#pwd').val();
    if(rat == '')
   {
            $('#notificationstar').text('Please Select Your Review Rank.');
            $('#notificationstar').show();
            $('#notificationstar').delay(2000).fadeOut();
            return false;
   }
   if(txt == '')
   {
            $('#notificationtxt').text('Please Give Your Review ');
            $('#notificationtxt').show();
            $('#notificationtxt').delay(2000).fadeOut();
            return false;
   }
   if (!$('.roomselect').is(':checked')) 
   {
             $('#notificationcheckbox').text('Please Confirm Before Leave Reviews.');
             $('#notificationcheckbox').show();
             $('#notificationcheckbox').delay(2000).fadeOut();
             return false;
    }
    
   else
   {
    $('#frmreview').submit();
   }


  });
});
</script>



