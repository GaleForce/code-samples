<div class="container">
				<div class="row">
					<div class="col-sm-3">
						 <h2 class="subhead">Welcome <?php echo $EmployeeName;?></h2>
					</div>
				<!--	<div class="col-sm-3 nopad-left">
						<input type="text" name="add-new-biz" placeholder="+ Send Notification" class="quickfield" />
						<button type="button" class="btn arrow-submit"></button>
					</div>
					<div class="col-sm-3 nopad-right">
						<input type="text" name="search-biz" placeholder=" Feedback Notification" class="quickfield" />
						<button type="button" class="btn arrow-submit"></button>
					</div>	 -->
					<div class="col-sm-3">
					
					</div>
				</div>
				<div class="row">
					<div class="col-sm-08">
						<a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>Employee/employeeFeedback">Go Back</a>
						<div id="content-wrapper">
							 <?php echo $this->element('AdminElement/employeenav')?>
							<div class="wrapTab">
							<h3 class="table-heading">Most Recent Feedback</h3>

             <table class="recent-feedback" cellpadding="0" cellspacing="0" border="0">
           	<tbody>
           <?php $i=1;$j=1;
          if(count($reviews) > 0)
				{ 
                foreach($reviews as $key=>$value)
            	{
            		if(empty($value)) { continue; } 
                    $ratingstar = $value['BusinessReview'][0]['ratingstar'];
                 ?>	
                 <tr>
		             				<td class="recent-feedback-img"><img src="<?php echo HTTP_ROOT?>app/webroot/img/generic-avatar.png"></td>
									<td class="recent-feedback-info">
									<p class="rf-name"><?php echo @$value['BusinessReview'][0]['firstName'].' '. @$value['BusinessReview'][0]['lastName'] ?></p>
									<p id='abc<?php echo $i; ?>' class="rf-subject"><?php echo $this->Text->truncate(
											$value['BusinessReview'][0]['ratingdescription'],
											128,
											array(
												'ending' =>'...',
												'exact' => false 
												)
											);
									?></p>
									<p class="<?php echo $j; ?>" style="display:none; font-size: 1.1em;font-weight: 800;margin: -3px 0 0;"><?php echo $value['BusinessReview'][0]['ratingdescription'] ;?></p>
									<?php if(strlen($value['BusinessReview'][0]['ratingdescription']) >127){ ?>
									<a href="javascript:void();" id="<?php echo $i; ?>" class="show"><span  class="pqr<?php echo $i; ?>"></span><lable class='pqr<?php echo $i; ?>' >Read More</lable></a>
									<?php } ?>
									<p class="rf-date"><?php echo date("d/m/Y", strtotime($value['BusinessReview'][0]['ratingdate']));?></p>
									</td>
									<?php if($ratingstar == 5) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></td><?php } ?>
									<?php if($ratingstar == 4) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></td><?php } ?>
									<?php if($ratingstar == 3) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></td><?php } ?>
									<?php if($ratingstar == 2) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></td><?php } ?>
									<?php if($ratingstar == 1) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"></td><?php } ?>
									 <td class="or-actions">
										<span title="Share" style="cursor:pointer" class='share-review' id="share<?php echo $value['Customer']['id']?>" rel="<?php echo HTTP_ROOT.'Employee/share/'.$value['Customer']['id'].'/'.$value['Business']['id']?>">
						                      <img src="<?php echo $this->webroot; ?>img/action-share.png">
						                </span>
										<span title="History" style="cursor:pointer" class='cust-history' id="history<?php echo $value['Customer']['id']?>" rel="<?php echo HTTP_ROOT.'Employee/history/'.$value['Customer']['id']?>">
						                      <img src="<?php echo $this->webroot; ?>img/action-history.png">
						                 </span>


										<?php $target = array(0=>1,1=>0); ?>
										<?php if($value['BusinessReview'][0]['approved'] == 1) {?>
						                   
						                      <span title="Active" style="cursor:pointer" class='statuschange' id="change<?php echo $value['BusinessReview'][0]['id']?>" rel="<?php echo HTTP_ROOT.'Employee/approveReview/'.base64_encode($value['BusinessReview'][0]['id']).'/'.$target[$value['BusinessReview'][0]['approved']]?>">
						                      <img id="imge<?php echo $value['BusinessReview'][0]['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress-1.png"></span>
						                   
						                    <?php }else{ ?>
						                  
						                      <span title="Inactive" style="cursor:pointer" class='statuschange' id="change<?php echo $value['BusinessReview'][0]['id']?>" rel="<?php echo HTTP_ROOT.'Employee/approveReview/'.base64_encode($value['BusinessReview'][0]['id']).'/'.$target[$value['BusinessReview'][0]['approved']]?>">
						                      <img id="imge<?php echo $value['BusinessReview'][0]['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress.png"></span>
						                
                    					<?php  }?>

                    					<div style="display:none" type="button" id="alert" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
										</div>

										<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  <div class="modal-dialog">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										     
										      </div>
										      <div class="modal-body" style="text-align:center;" id="bdycontent">
										        
										      </div>
										      
										    </div>
										  </div>
										</div>


									</td> 
		                                
		 
										</tr>

									<?php 
									 
							
							$i++;$j++;	} 
							 
							?>
						<?php 
					 
				
			}
						else
						{


					?>
					 <tr><td class="or-img"><?php echo "No Review Yet...";?></td></tr>
					<?php } ?>
						 
				 </tbody></table>

					 <p>
                           <?php
                              echo $this->Paginator->counter(array(
                              'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                              ));
                              ?> 
                        </p>
                        <div class="paging">
                           <?php
                              echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                              echo $this->Paginator->numbers(array('separator' => ''));
                              echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                              ?>
                        </div>
						</div>
					</div>
				</div>
				<?php echo $this->element('history')?>
				<?php echo $this->element('share')?>
			</div>
		
<script>
	$(document).ready(function(){
		$('.show').click(function(){
		var id=this.id;
		$('#abc'+id).hide();
		$('.'+id).show();
		$('.pqr'+id).hide();
		

	});
	})
</script>
<script>
	$(document).ready(function(){
		$('.show').click(function(){
		var id=this.id;
		$('#abc1'+id).hide();
		$('.'+id).show();
		$('.pqr1'+id).hide();

	});
	})
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.statuschange').on('click', function(){
       var url=$(this).attr('rel');
       $("#loading").show();
       $.ajax({                   
                url: url,
                type: 'POST',
                 cache: false,
                dataType: 'json',
                success: function (response) {
                  if(response[0]=='success'){
                     var newurl=ajax_url+'Employee/approveReview/'+response[1]+'/'+response[2];
                       if(response[2]==0){
                          var newdots=ajax_url+'img/action-suppress-1.png';
                          var title='Active';
                       }else{
                         var newdots=ajax_url+'img/action-suppress.png';
                         var title='Inactive';
                       }
                       $('#change'+response[3]).attr('rel',newurl);
                       $('#change'+response[3]).attr('title',title);
                       $('#imge'+response[3]).attr('src',newdots);
                       $("#loading").hide();
	                   $('#bdycontent').html('Review has been updated Successfully.');                  
	                   $('#alert').click();
                  }else{
                    $("#loading").hide();
                    alert("!Oops there is something wrong with server.Please try again.");
                  }
                  
                  }
            })

    });
 	
   
    });
</script>

<div id="loading" style="display:none">
  <img id="loading-image" src="<?php echo HTTP_ROOT?>img/ajax-loader.gif" alt="Loading..." />
</div>
<style type="text/css">
#loading {
  
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}

#loading-image {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 100;
}
.modal-header .close {
    margin-top: -11px;
}
</style>