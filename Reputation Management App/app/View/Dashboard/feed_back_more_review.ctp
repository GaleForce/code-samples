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
          
            foreach($businessuserreview as $key=>$value)
            { 

        	 if(count($value['Onlinereview']) > 0)
				{  
					$ratingstar = $value['Onlinereview']['ratingstar'];
                 ?>	
		             <tr>
		             				<td class="recent-feedback-img"><img src="<?php echo HTTP_ROOT?>app/webroot/img/generic-avatar.png"></td>
									<td class="recent-feedback-info">
									<p class="or-name"><?php echo $value['Onlinereview']['CustomerFullName']?></p>
									<p id='abc<?php echo $i; ?>' class="rf-subject"><?php echo $this->Text->truncate(
											$value['Onlinereview']['ratingdescription'],
											128,
											array(
												'ending' =>'...',
												'exact' => false 
												)
											);
									?></p>
									<p class="<?php echo $j; ?>" style="display:none; font-size: 1.1em;font-weight: 800;margin: -3px 0 0;"><?php echo $value['Onlinereview']['ratingdescription'] ;?></p>
									<?php if(strlen($value['Onlinereview']['ratingdescription']) >127){ ?>
									<a href="javascript:void();" id="<?php echo $i; ?>" class="show"><span  class="pqr<?php echo $i; ?>"></span><lable class='pqr<?php echo $i; ?>' >Read More</lable></a>
									<?php } ?>
									<p class="rf-date"><?php echo date("d/m/Y", strtotime($value['Onlinereview']['updated']));?></p>
									</td>
									<?php if($ratingstar == 5) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></td><?php } ?>
									<?php if($ratingstar == 4) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></td><?php } ?>
									<?php if($ratingstar == 3) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></td><?php } ?>
									<?php if($ratingstar == 2) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></td><?php } ?>
									<?php if($ratingstar == 1) { ?><td><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"></td><?php } ?>

		                                
		 
										</tr>

									<?php 
									 
							
							$i++;$j++;	} 

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

