        <div class="col-lg-2 col-md-3 col-sm-4">
          <!-- Total Feedback Box -->
          <div class="dashboard-stat blue">
            <div class="visual">
              <i class="fa fa-comments"></i>
            </div>
            
              <div class="rateavg">
                 <?php if($businessesdata['Business']['averageRating']>0){?>
				<span><?php echo number_format((float)$businessesdata['Business']['averageRating'], 2, '.', '');?></span>
				<?php } else {?>
				   <span><?php echo number_format((float)0, 2, '.', '');?></span>
				<?php }?>
              </div>
              <div class="details dside">
              
              <div class="desc">
                 Your Feedback Rating
              </div>
              <div class="more">
            <?php if($businessesdata['Business']['totalReviews']>0) {?>
			<?php echo 'Overall feedback rating out of '.$businessesdata['Business']['totalReviews']?>
			<?php }?>              
			  </div>
			  </div>
                 
          </div>
        
		
			<div class="dashboard-stat reforce-red">
             <div class="stars-title">
                 Your Star Ratings
              </div>
			  <div class="star-chart-total">
            <?php if($businessesdata['Business']['totalReviews']>0){?>
				<?php echo $businessesdata['Business']['totalReviews'].' Reviews';}else {?>  
				<?php echo "Reviews";?> 
			<?php }?>
              </div>
                 <?php if($businessesdata['Business']['totalReviews']>0){?>
			<ul class="breakdown-stars">
				<li><span><?php echo $businessesdata['Business']['fivestarCount']?></span><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"</li>
				<li><span><?php echo $businessesdata['Business']['fourstarCount']?></span><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"</li>
				<li><span><?php echo $businessesdata['Business']['threestarCount']?></span><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"</li>
				<li><span><?php echo $businessesdata['Business']['twostarCount']?></span><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"</li>
				<li><span><?php echo $businessesdata['Business']['onestarCount']?></span><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"</li>
			</ul>
			<?php }else{?>
     				<span><?php echo "NO FEEDBACK YET...";?></span> 
			<?php }?>
              
              <div class="details dside">
              
              <div class="desc">
                 
              </div>
              <div class="more-chart more">
            <?php if($businessesdata['Business']['totalReviews']>0) {?>
			<?php echo 'Overall feedback rating out of '.$businessesdata['Business']['totalReviews']?>
			<?php }?>              
			  </div>
			  </div>
                 
          </div>
		
		
		<div class="dashboard-stat blue">
            <div class="visual">
              <i class="fa fa-thumbs-up"></i>
            </div>
            
              <div class="rateavg">
                <?php if($online_average_rating[0]['AverageRating']>0){?>
            <span><?php echo number_format((float)$online_average_rating[0]['AverageRating'], 2, '.', '');?></span>
            <?php } else {?>
               <span><?php echo number_format((float)0, 2, '.', '');?></span>
            <?php }?>
              </div>
              <div class="details dside">
              
              <div class="desc">
                 Your Online Rating
              </div>
              <div class="more">
            Overall online rating <?php echo number_format((float)$online_average_rating[0]['AverageRating'], 2, '.', '');?><br>out of <?php echo number_format((float)$online_average_rating[0]['totalcount']);?>             
			  </div>
			  </div>
                 
          </div>
		
		
		</div>
            

            <!-- <div class="cta-box">
          
			<p>Agency Logo</p>
			<a href="javascript:void(0)"><?php if(isset($design)){?><img style="width:100%;height:100px;" src="<?php echo HTTP_ROOT;?>/img/agencylogo/medium/<?php echo @$design['AgencysiteSetting']['agencylogo']; ?>"alt="Agency Logo"/><?php }?></a>
			</div>
		</div>






 <div class="modal fade" id="talk-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                 <?php echo ".................Under Construction.............."; ?>
                                <input type="text" id="chat" class="form-control">
								</div>
								<div class="togg-btn">
                                    <input class="btn btn-primary visibility-submit" type="submit" value="Send"/>
                                    </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default closness" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                    </div>

