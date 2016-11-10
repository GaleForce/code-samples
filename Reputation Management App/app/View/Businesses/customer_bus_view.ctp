<div class="container">

<div class="row">
 <?php echo $this->element('welcome')?>
<div class="col-sm-10">
<div id="content-wrapper">
   <?php echo $this->element('nav_business_user')?>
    <div class="wrapTab">
    <span><a href="<?php echo HTTP_ROOT?>dashboard/reporting/<?php echo $busid?>" class="go-back btn btn-primary">Go Back</a></span>
	<p>Customer First Name: <?php echo $customer['Customer']['firstname']?></p>
	<p>Customer Last Name: <?php echo $customer['Customer']['lastname']?></p>
	<p>Customer Email: <?php echo $customer['Customer']['email']?></p>
	<p>
		Rating: 
		<?php 
    	    for($i=1;$i<=$customer['BusinessReview']['ratingstar'];$i++){ 
    	?>   	
    	      <?php if($i<=5){ ?>
    	        <img src="<?php echo HTTP_ROOT?>/img/star.png">
    	      <?php } else {?>
    	         <img src="<?php echo HTTP_ROOT?>img/small.png">
    	      <?php }?>
    	   	
    	<?php }?>
	                    		
	</p>
	<p>Feedback: <?php echo $customer['BusinessReview']['ratingdescription']?></p>
	<p></p>
	</div>
	</div>
	
  </div>	
   <?php echo $this->element('reviews_business_user')?>
</div>
