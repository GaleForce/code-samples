<div class="container">
	<div class="row">
	<?php echo $this->element('welcome')?>
 
	<div class="col-sm-3 nopad-left">
		<a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>dashboard/feedback/<?php echo $busid ?>">Go Back</a>
	</div>
	<div class="col-sm-4 nopad-right">
	<input name="quick-search" placeholder="Quick Search" class="quicksearch" type="text">
	<button type="button" class="btn arrow-submit"></button>
	</div>

	<div class="col-sm-2 km">
	<div class="help-btn">
	<button type="button" class="btn btn-default get-help"><span aria-hidden="true" class="glyphicon glyphicon-question-sign"></span><em>Get Help</em></button>
	</div>
	</div>

	<div class="row">

      <div class="col-sm-10">
         <div id="content-wrapper">
             <?php echo $this->element('nav_business_user')?>
            <div class="wrapTab">
            <h3 class="table-heading">Most Recent Feedback</h3>
            <table class="recent-feedback" cellpadding="0" cellspacing="0" border="0">
           	<tbody>
           <?php $i=1;$j=1;
					   
						 foreach ($businessuserreview as $key => $value) { ?>
								
							  <tr>
								<td class="or-img"><img alt="Avatar" src="<?php echo $this->webroot; ?>img/generic-avatar.png"></td>
								<td class="or-info">
									<p class="or-name"><?php echo $value['Onlinereview']['CustomerFullName']?></p>
									<p class="or-subject">Subject</p>
                          
                          <p id='abc1<?php echo $i; ?>' class="rf-subject"><?php echo $this->Text->truncate(
											$value['Onlinereview']['ratingdescription'],
											128,
											array(
												'ending' =>'...',
												'exact' => false 
												)
											);
									?></p> 
									<p class="<?php echo $j; ?>" style="display:none; font-size: 1.1em;margin: -3px 0 0;"><?php echo $value['Onlinereview']['ratingdescription'] ;?></p>
									<?php if(strlen($value['Onlinereview']['ratingdescription']) >127){ ?>
									<a href="javascript:void();" id="<?php echo $i; ?>" class="show"><span  class="pqr1<?php echo $i; ?>"></span><lable class='pqr<?php echo $i; ?>' >Read More</lable></a>
									<?php } ?>

 	 
									<p class="or-date">Date of Review <?php echo @$value['Onlinereview']['updated'];?></p>
								</td>
								
							<?php if($value['Onlinereview']['ratingstar'] >= 5) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></td><?php } ?>
							<?php if($value['Onlinereview']['ratingstar'] == 4) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></td><?php } ?>
							<?php if($value['Onlinereview']['ratingstar'] == 3) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></td><?php } ?>
							<?php if($value['Onlinereview']['ratingstar'] == 2) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></td><?php } ?>
							<?php if($value['Onlinereview']['ratingstar'] == 1) { ?><td class="or-stars"><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"></td><?php } ?>
							<?php /*
							<td class="or-actions">
									<img src="<?php echo $this->webroot; ?>img/action-share.png">
									<img src="<?php echo $this->webroot; ?>img/action-history.png">
								
								<?php $target = array(0=>1,1=>0); ?>
										<?php if($value['Onlinereview']['confirmation'] == 1) {?>
						                   
						                      <span title="Active" style="cursor:pointer" class='statuschange1' id="change1<?php echo $value['Onlinereview']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/onlinereviewsstatus/'.base64_encode($value['Onlinereview']['id']).'/'.$target[$value['Onlinereview']['confirmation']]?>">
						                      <img id="imge1<?php echo $value['Onlinereview']['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress-1.png"></span>
						                   
						                    <?php }else{ ?>
						                  
						                      <span title="Inactive" style="cursor:pointer" class='statuschange1' id="change1<?php echo $value['Onlinereview']['id']?>" rel="<?php echo HTTP_ROOT.'dashboard/onlinereviewsstatus/'.base64_encode($value['Onlinereview']['id']).'/'.$target[$value['Onlinereview']['confirmation']]?>">
						                      <img id="imge1<?php echo $value['Onlinereview']['id']?>" src="<?php echo HTTP_ROOT?>img/action-suppress.png"></span>
						                
                    					<?php  }?>
                    			</td>	
                    			*/ ?>

					 <?php
					  $i++;
				      $j++;
				  }
					  ?>

							
					 
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
		<?php echo $this->element('reviews_business_user')?>
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
<script type="text/javascript">
$(document).ready(function(){
 	 $('.statuschange1').on('click', function(){
       var url=$(this).attr('rel');
       $("#loading").show();
       $.ajax({                   
                url: url,
                type: 'POST',
                 cache: false,
                dataType: 'json',
                success: function (response) {
                  if(response[0]=='success'){
                     var newurl=ajax_url+'dashboard/onlinereviewsstatus/'+response[1]+'/'+response[2];
                       if(response[2]==0){
                          var newdots=ajax_url+'img/action-suppress-1.png';
                          var title='Active';
                       }else{
                         var newdots=ajax_url+'img/action-suppress.png';
                         var title='Inactive';
                       }
                       $('#change1'+response[3]).attr('rel',newurl);
                       $('#change1'+response[3]).attr('title',title);
                       $('#imge1'+response[3]).attr('src',newdots);
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
