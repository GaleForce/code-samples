<div class="container">
<div class="row">
      <div class="col-sm-3">
         <h2 class="subhead">Agency Dashboard</h2>
      </div>
      <div class="col-sm-3 nopad-left">
        <form id="addnewbus" method="post" action="<?php echo HTTP_ROOT;?>businesses/add/addnew">
           <input type="text" name="data[Business][name]" placeholder="+ Add New Business" class="quickfield" />
           <input type="submit" class="btn arrow-submit" value="">
        </form>   
      </div>
      <div class="col-sm-3 nopad-right">
         <input type="text" name="search-biz" placeholder="Search Clients" class="quickfield" />
         <input type="submit" class="btn arrow-submit" value="">
      </div>
      <div class="col-sm-3">
      </div>
</div>
<div class="row">
<div class="col-sm-10">
<div id="content-wrapper">
     <?php echo $this->element('nav')?>
    <div class="wrapTab">
	<p>Customer First Name: <?php echo $customer['Customer']['firstname']?></p>
	<p>Customer Last Name: <?php echo $customer['Customer']['lastname']?></p>
	<p>Customer Email: <?php echo $customer['Customer']['email']?></p>
	<p>
		Rating: 
		<?php 
    	    for($i=1;$i<=$customer['BusinessReview']['ratingstar'];$i++){ 
    	?>   	
    	      <?php if($i<=4){ ?>
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
	 <?php echo $this->element('reviewsidebar')?>  
  </div>	
</div>
