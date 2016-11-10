<?php echo $this->element('nav')?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
      <h3 class="page-title">
      <?php echo $design['AgencysiteSetting']['sitetitle']; ?> - View Customer
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="#">View Customer Review</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
            
        </div>
      </div>
      <!-- END PAGE HEADER-->
<div class="row">
<div class="col-sm-10">
<div id="content-wrapper">
    <div class="wrapTab">
  <div class="portlet box reforce-red">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-user"></i>Review Detail
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                </a>
                <a href="" class="fullscreen" data-original-title="" title="">
                </a>
                <a href="javascript:;" class="reload" data-original-title="" title="">
                </a>
              </div>
            </div>
            
            <div class="portlet-body grey">
    <span><a href="<?php echo HTTP_ROOT?>businesses/report" class="go-back btn btn-primary pull-right">Go Back</a></span>
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
   <?php echo $this->element('reviewsidebar')?>  

</div>
</div>
</div>