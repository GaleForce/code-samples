
<a href="<?php echo HTTP_ROOT?>users/logout">Logout</a>

<div class="container">
    <div class="row">
					<div class="col-sm-3">
						<h2 class="subhead">Welcome, Business Name</h2>
					</div>
					<div class="col-sm-3 nopad-left">
						
					</div>
					<div class="col-sm-4 nopad-right">
						<input name="quick-search" placeholder="Quick Search" class="quicksearch" type="text">
						<button type="button" class="btn arrow-submit"></button>
					</div>
					<div class="col-sm-2">
					
					</div>
			 
 
  	 <div class="row">
      <div class="col-sm-10">
         <div id="content-wrapper">
             <?php echo $this->element('nav_business_user')?>
            <div class="wrapTab">
             <?php echo "Business Deshboard is under construction."?></br>   
            </div>
         </div>
      </div>
       <?php echo $this->element('reviews_business_user')?>
   </div>
 

