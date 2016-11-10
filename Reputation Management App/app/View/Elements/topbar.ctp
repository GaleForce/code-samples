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

  $count=0;$overallRat=0;$compnyrating=array();$i=0;$count1=0;$fourfivecount=0;
     foreach ($businessesdata as $key => $business){
      $fourfivecount += (int) $business['Business']['fourstarCount'];
      $fourfivecount += (int) $business['Business']['fivestarCount'];
      
       if(!$business['Business']['averageRating']){
         $overallRat=$overallRat+0;
         $rat=0;
       } else{
         $overallRat=$overallRat+$business['Business']['averageRating'];
          $rat=$business['Business']['averageRating'];
          $rat=$business['Business']['averageRating'];
          $count1=$count1+$business['Business']['totalReviews'];
          $count++;
       }
       $compnyrating[$i]['name']=$business['Business']['businessname'];
       $compnyrating[$i]['averageRatings']=$rat;
       $i++;
      
      }
      $amtgood = (int)(($fourfivecount / $count1) * 100);
      
    $businessesdata['evars'] = array(
         'count'         => $count
        ,'count1'        => $count1
        ,'overallRat'    => $overallRat
        ,'compnyrating'  => $compnyrating
        ,'fourfivecount' => $fourfivecount
        ,'amtgood'       => $amtgood
      );
?>
<?php extract($businessesdata['evars']); ?>
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
                 <?php echo $count1 ?>
              </div>
              <div class="desc">
                 Total Reviews
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>businesses/report">
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
                 <?php echo $count ?>
              </div>
              <div class="desc">
                 Businesses With Reviews
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>businesses/report">
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
                <?php if($count>0){?>
                <?php echo number_format((float)$overallRat/$count, 2, '.', '');?>
                <?php } else {?>
                <?php echo number_format((float)0, 2, '.', '');?>
                <?php }?>
                
              </div>
              <div class="desc">
                 Average Business Rating
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>businesses/report">
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
                 <?php echo $amtgood . '%'; ?>
                 </div>
              <div class="desc">
                 of Feedback is Positive
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT?>businesses/report">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- END DASHBOARD STATS -->