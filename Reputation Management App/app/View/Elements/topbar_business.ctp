<?php
//pr($businessesdata);die;
/*$count=0;$overallRat=0;$compnyrating=array();$i=0;$count1=0;
 foreach ($businessesdata as $key => $business){
   if(!$business['Business']['averageRating']){
         $overallRat=$overallRat+0;
         $rat=0;
   } else{
         $overallRat=$overallRat+$business['Business']['averageRating'];
          $rat=$business['Business']['averageRating'];
          $count1=$count1+$business['Business']['totalReviews'];
          $count++;
   }
   $compnyrating[$i]['name']=$business['Business']['businessname'];
   $compnyrating[$i]['averageRatings']=$rat;
   $i++;
  
  }*/


?>
<!-- BEGIN DASHBOARD STATS -->
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <!-- Total Feedback Box -->
          <div class="dashboard-stat blue">
            <div class="visual">
              <i class="fa fa-comments"></i>
            </div>
            <div class="details">
              <div class="number">
                 <?php echo $businessesdata['Business']['totalReviews'] ?> 
              </div>
              <div class="desc">
                 Total System Reviews
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>dashboard/reporting">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <!-- Reviewed Businesses Box -->
          <div class="dashboard-stat green">
            <div class="visual">
              <i class="fa fa-thumbs-o-up"></i>
            </div>
            <div class="details">
              <div class="number">
                
				<div class="txt-format"><?php echo number_format((float)$businessesdata['Business']['averageRating'], 2, '.', '');?></div>
              </div>
              <div class="desc">
                 Average Customer Rating
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>dashboard/reporting">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <!-- Average Rating Box -->
          <div class="dashboard-stat purple">
            <div class="visual">
              <i class="fa fa-rocket"></i>
            </div>
            <div class="details">
              <div class="number">
               
                <?php echo number_format((float)$online_average_rating[0]['AverageRating'], 2, '.', '');?>
              </div>
              <div class="desc">
                 Average Rating Online
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>dashboard/reporting">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <!-- New Feedback Box -->
          <div class="dashboard-stat yellow">
            <div class="visual">
              <i class="fa fa-bar-chart"></i>
            </div>
            <div class="details">
              <div class="number">
                 <?php echo number_format((float)$online_average_rating[0]['totalcount']);?>
                 </div>
              <div class="desc">
                 Total Online Reviews
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>dashboard/reporting">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- END DASHBOARD STATS -->