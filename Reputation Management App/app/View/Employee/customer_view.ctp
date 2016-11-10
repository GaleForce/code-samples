<div class="container">
        <div class="row">
          <div class="col-sm-3">
            <h2 class="subhead"></h2>
          </div>
          <div class="col-sm-3 nopad-left">
            <input type="text" name="add-new-biz" placeholder="+ Send Notification" class="quickfield" />
            <button type="button" class="btn arrow-submit"></button>
          </div>
          <div class="col-sm-3 nopad-right">
            <input type="text" name="search-biz" placeholder=" Feedback Notification" class="quickfield" />
            <button type="button" class="btn arrow-submit"></button>
          </div>  
          <div class="col-sm-3">
          
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-08">
            <div id="content-wrapper">
              <nav id="subnavbar" class="navbar">
                <div id="navbar" class="navbar-collapse collapse">
                 <?php echo $this->element('AdminElement/employeenav')?>
                </div>
              </nav>
             
               
             
          
             <div class="wrapTab">
    <span><a href="<?php echo HTTP_ROOT?>Employee/reporting/" class="go-back btn btn-primary">Go Back</a></span>
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
      </div>
  </div>
            
            
            
    



   