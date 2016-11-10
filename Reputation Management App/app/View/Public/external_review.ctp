<div class="businesses container">



<div class="add-micro_review">
<div class="micro-form-start">

<div class="row">
<div class="col-md-4">
<div class="micro-review-logo">

<?php if(!empty($bus_logo['Business']['business_logo'])){?>
<img style="height:100px; width:100%;" src="<?php echo HTTP_ROOT.'/img/'.$bus_logo['Business']['business_logo'] ?>" />
<?php }else{?>
<img style="height:100px; width:100%;" src="<?php echo HTTP_ROOT.'/img/images-1425447531.jpeg' ?>" />
<?php }?>
</div>
</div>
<div class="col-md-8">
<div class="micro-review-addres">
<address>
 <strong><?php  echo @$bus_logo['Business']['addressline1'] ?></strong><br> 
<!-- 8895 North Military Trail<br>
Suite B202<br>
Palm Beach Gardens, FL 33410 -->
</address>
</div>
</div>

</div>

<!-- <div class="micro-reviewing">
<div class="form-group">
<label class="control-label col-sm-4">Address:<?php //echo $bus_logo['Business']['addressline1'] ?></label>
<div class="col-sm-8">

</div>
</div>
</div> -->


<div class="sepline"></div>

<!--Feed Back Setting Start -->
<?php if(@$feedbacksetting['FeedbackSetting']['displayvideo']):?>
<?php echo @$feedbacksetting['FeedbackSetting']['embedcodemalepostivevideo'];?>

<h2>Special Offer</h2>
<?php echo @$feedbacksetting['FeedbackSetting']['special_offer'];?>

<div class="sepline"></div>
<?php endif;?>

<!--Feed Back Setting End -->





<form class="form-horizontal" id="Formreview" method="POST" action="<?php echo HTTP_ROOT?>public/external_review">

<p class="micr_p">Thank you for taking a minute to leave a review. We appreciate your feedback.</p>

		<input type="hidden" name="data[Customer][user_id]" value="<?php echo @$bus_logo['Business']['user_Id'];?>">
		<input type="hidden" name="data[Customer][business_id]" value="<?php echo $business_id?>">
    <input type="hidden" name="data[Customer][employee_id]" value="<?php echo $bus_logo['Business']['user_Id'];?>">
    <input type="hidden" name="feedbackthreshold" value="<?php echo @$bus_logo['Business']['feedbackthreshold'];?>">
	 <div class="form-group">
      <label class="control-label col-sm-4">First Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control dam-back" name="data[Customer][firstname]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4">Last Name:</label>
      <div class="col-sm-8">
        <input type="text"  class="form-control dam-back" name="data[Customer][lastname]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4">Email:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control dam-back" name="data[Customer][email]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4">Phone :</label>
      <div class="col-sm-8">
        <input type="text" class="form-control dam-back" name="data[Customer][phonenumber]">
     </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4">Address:</label>
      <div class="col-sm-8">
        <textarea class="form-control dam-back" name="data[Customer][addressline1]"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4">Rating:</label>
      <div class="col-sm-8">
       <select class="dam-selected" name="data[BusinessReview][ratingstar]">
                <option value="">Please give your ratings</option> 
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
      </div>
    </div>

<!--     <div class="form-group">
      <label class="control-label col-sm-4">Employee:</label>
      <div class="col-sm-8">
       <select class="dam-selected" name="data[Customer][employee_id]">
                <option value="">Select Employee</option> 
                <option value="1">R.Raju Ramcharan</option>
                <option value="2">Stangen</option>
                <option value="3">Skyler</option>
                <option value="4">Vipin Lee</option>
                <option value="5">Kamal Polard</option>
              </select>
      </div>
    </div> -->

    <div class="form-group">
      <label class="control-label col-sm-4">Review Box:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control dam-back" name="data[BusinessReview][ratingdescription]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4">&nbsp;</label>
      <div class="col-sm-8"> 
      <p class="autho">I am authorizing Smartlink Internet Marketing to post my review and name online.
      <p class="autho">I confirm that i have done business with Smartlink Internet Marketing and that my review is valid.</p>
      </div>       
 </div>

     <div class="form-group">
	    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
	    	<div class="col-sm-8 submitting"> 
		        <input type="submit" class="submit btn btn-primary submit" value="Submit">
			</div> 
	</div>


 

</form>





</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		 $('#Formreview').validate({
		 	event:'blur',
            rules:
            {
                "data[Customer][firstname]":
                {
                    required:true,
                },
                "data[Customer][lastname]":
                {
                    required:true,
                },
                "data[Customer][email]":
                {
                    required:true,
                    email:true,
		               // remote:ajax_url+'Public/validEmail/'+<?php echo $business_id?>
                },
                "data[Customer][phonenumber]":
                {
                    required:true,
                    number:true
                },
                "data[Customer][addressline1]":
                {
                    required:true,
                },
                "data[BusinessReview][ratingstar]":
                {
                    required:true,
                },
                "data[BusinessReview][ratingdescription]":
                {
                    required:true,
                }

            },
            messages:
            {
                "data[Customer][firstname]":
                {
                    required:"This field is required."
                },
                "data[Customer][lastname]":
                {
                    required:"This field is required."
                },
                 "data[Customer][email]":
                {
                   required:'Please enter email.',
                   email:'Please enter valid email.',
		               //remote:'You have already given the review.'
                },
                 "data[Customer][phonenumber]":
                {
                   required:'Please enter number.',
                },
                 "data[Customer][addressline1]":
                {
                  required:"This field is required."
                },
                 "data[BusinessReview][ratingstar]":
                {
                  required:"This field is required."
                },
                  "data[BusinessReview][ratingdescription]":
                {
                  required:"This field is required."
                }
            },
		 });
	});
</script>
