<?php
//pr($businessesdata);die;
$count=0;$overallRat=0;$compnyrating=array();$i=0;$count1=0;
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
  
  }
?>
<div class="col-md-3 col-lg-2">
            <div class="dashboard-stat blue">
            <span class="rateavg">
                <?php 
                  $ratings=array();
                  foreach($compnyrating as $key=>$value){
                    $ratings[$key]=$value['averageRatings'];
                  }
                  array_multisort($ratings, SORT_DESC, $compnyrating);
                ?>
                 <?php if($count>0){?>
                <?php echo number_format((float)$overallRat/$count, 2, '.', '');?>
                <?php } else {?>
                 <?php echo number_format((float)0, 2, '.', '');?>
                <?php }?>
              </span>
            <div class="visual vside">
              <i class="fa fa-comments"></i>
            </div>
            <div class="details dside">
              
              <div class="desc">
                 Overall Rating Average
              </div>
              <div class="more">
                 <?php echo "out of $count1 total business reviews" ?>
              </div>
            </div>
          </div>
        <!-- BEGIN PORTLET
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-cogs"></i>Rating Average
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
              </div>
            </div>
            
            <div class="portlet-body yellow">
         <div class="rating-average">
            <?php 

              $ratings=array();
              foreach($compnyrating as $key=>$value){
                  $ratings[$key]=$value['averageRatings'];
              }
              array_multisort($ratings, SORT_DESC, $compnyrating);
            ?>
             <?php if($count>0){?>
            <span><?php echo number_format((float)$overallRat/$count, 2, '.', '');?></span>
            <?php } else {?>
               <span><?php echo number_format((float)0, 2, '.', '');?></span>
            <?php }?>
         </div>
         <div class="sidebar-box">
            <p class="rating-amount"><?php echo "Overall rating average out of $count1 total business reviews" ?></p>
         </div>
     </div>
          </div>
           END PORTLET-->
          
          <!-- BEGIN PORTLET-->
          <div class="portlet box blue best-biz">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-trophy"></i>Highest Ratings
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
              </div>
            </div>
            
            <div class="portlet-body yellow">
        
            <p class="best-heading">Business by average rating...</p>
            <ol>
             <?php if(!empty($compnyrating))
               { 

                $incr=1;
                foreach ($compnyrating as $key => $value) 
                {
                if($value['averageRatings'] <=2){
                    continue;
                  }else{
                   
                
                    ?>
                  <li><?php echo $value['name']?></li>
                 <?php if($incr==3){
                  break;
                
              }
              $incr++;

              }
            }
          }
          ?>
                 
                   
                
            </ol>
       
            <?php array_multisort($ratings, SORT_ASC, $compnyrating);?>
      </div>
      </div>
      
      <div class="portlet box blue best-biz">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-level-down"></i>Lowest Ratings
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
              </div>
            </div>
            
            <div class="portlet-body yellow">
            <p class="worst-heading">Business by average rating...</p>
            <ol>
               <?php if(!empty($compnyrating))
               {

                $incr=1;
                foreach ($compnyrating as $key => $value) 
                {
                if($value['averageRatings']>2){
                    continue;
                  }else{
                   $incr++;
             
                 
                    ?>
                  <li><?php echo $value['name']?></li>
                 <?php if($incr==3){
                  break;
                 
              }
              }
            }
          }


                ?>
               
            </ol></div></div>
         </div>
