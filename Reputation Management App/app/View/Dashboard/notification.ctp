
 <style type="text/css">
.searchBox{
  display: inline-block;
    margin-bottom: 12px;
    padding: 20px 20px 20px 36px;
    width: 45%;
}
 </style>

<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
		   <?php echo $this->Session->flash(); ?>  
		  <h3 class="page-title">
		  <?php echo $this->element('welcome')?> - Email Templates
		  </h3>
		  <div class="page-bar">
			<ul class="page-breadcrumb">
			  <li>
				<i class="fa fa-home"></i>
				<a href="<?php echo HTTP_ROOT?>">Home</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="#">Email Templates</a>
			  </li>
			</ul>
			<div class="page-toolbar">
			  
			</div>
		  </div>
		  <!-- END PAGE HEADER-->
        
			
			<div class="row"> <!-- ROW & COL FOR LAYOUT -->
				<div class="col-lg-10 col-md-9 col-sm-8">
				<?php echo $this->Session->flash(); ?>  
				
				<!----------------------------------->
				<!----------------------------------->
					  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
				      <!--   >>  BEGIN PORTLET  << -->
					  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-envelope"></i> Manage Email Templates
						  </div>
						  <div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							<!-- <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
							</a> -->
							<a href="" class="fullscreen" data-original-title="" title="">
							</a>
							<!-- <a href="javascript:;" class="reload" data-original-title="" title="">
							</a> -->
						  </div>
						</div>
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body grey">
						
						
						  <!-- TOOLBAR (PORT) -->
						  <div class="table-toolbar">
						  
							<div class="row">
							
							<!-- Search Tool -->
								<div class="col-md-6 col-sm-9">

									<form class="form-inline" accept-charset="utf-8" method="post" action="<?php echo HTTP_ROOT?>dashboard/notification/<?php echo $busid ?>" id="manage-search">
										<div class="input-group form-group">
										<input type="search" class="form-control input-med input-inline" id="inputPassword2" placeholder="Template Name" name="data[searchForm][search]">
										  <span class="input-group-btn">
											<button type="submit" class="btn blue" type="button">Search</button>
										  </span>
										</div>
									</form>
									
								</div>
								
								<div class="col-md-6 col-sm-3">
									 <?php echo $this->Html->link(__('Add New Template'),
										array('controller'=>'EmailTemplates','action' => 'add', $buss_id['Business']['id'], $busid),array('class' => 'btn nn pull-right green')); ?>
								</div>
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="table-scrollable">
										
										 <table class="table table-bordered table-striped">
											<thead class="tbleHead">
														  <tr>
															 <!-- <th class="report-serial">Sr. N.</th> -->
															  <th><?php echo $this->Paginator->sort('email template name'); ?></th>
															  <th><?php echo $this->Paginator->sort('email subject'); ?></th>
															  <th><?php echo $this->Paginator->sort('sender name'); ?></th>
															  <th><?php echo $this->Paginator->sort('sender email'); ?></th>
															  <!-- <th><?php //echo $this->Paginator->sort('email content'); ?></th> -->
															  <th class="actions"><?php echo 'Actions'; ?></th>
														  </tr>
														  </thead>
															<tbody>
															<?php if(count($emailtemplate)>0):?>
																<?php foreach ($emailtemplate as $key=>$emailTemplate): ?>
														  <tr>
														   <!--  <td><?php //echo h($emailTemplate['EmailTemplate']['id']); ?>&nbsp;</td> -->
														   <!-- <td><?php echo h($key+1); ?></td> -->
															<td><?php echo h($emailTemplate['EmailTemplate']['emailtemplatename']); ?>&nbsp;</td>
															<td><?php echo h($emailTemplate['EmailTemplate']['emailsubject']); ?>&nbsp;</td>
															<td><?php echo h($emailTemplate['EmailTemplate']['sendername']); ?>&nbsp;</td>
															<td><?php echo h($emailTemplate['EmailTemplate']['senderemail']); ?>&nbsp;</td>
															<!-- <td><?php //echo h($emailTemplate['EmailTemplate']['emailcontent']); ?>&nbsp;</td> -->
															<td class="actions" id="peroticed">
																<div class="dropdown" id="chap_style">
														   <button aria-expanded="false" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default dropdown-toggle">
																	  Action
																	  <span class="caret"></span>
																	</button>
														  <ul role="menu" aria-labelledby="dLabel" class="dropdown-menu">
															<li role="presentation">
															<?php echo $this->Html->link(__('Edit'), array('controller'=>'EmailTemplates','action' => 'edit', $emailTemplate['EmailTemplate']['id'],$busid)); ?>
															</li>
															
															<li role="presentation"><?php echo $this->Form->postLink(__('Delete'), array('controller'=>'EmailTemplates','action' => 'delete', $emailTemplate['EmailTemplate']['id'],$busid), array(), __('Are you sure you want to delete # %s?', $emailTemplate['EmailTemplate']['id'])); ?></li>
														   
														  </ul>
												   </div>


															</td>
														  </tr>
														<?php endforeach; ?>
															<?php else:?>
															<tr>
																<td colspan="5">No Record Found..</td>
															</tr>
															<?php endif;?>


														  
														  </tbody>
														  </table>
														  <?php if(!empty($emailtemplate)){ ?>
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
													<?php }?>
										
									</div>
									<!-- MAIN END -->
								</div>
							</div>
							
						</div>
						<!-- END PORTLET BODY -->
						
					</div>
					<!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
					<!--   >>   END PORTLET  <<  -->
					<!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
			  <!----------------------------------->
			  <!----------------------------------->
		
				</div>
				<?php echo $this->element('reviews_business_user')?>
			</div> <!-- END LAYOUT ROW -->	
		
	</div>
</div>	
<script type="text/javascript">
$(document).ready(function(){
    $('#manage-search').validate({
           event:'blur',
            rules:
            {
                "data[searchForm][search]":
                {
                    required:true,
                }
            
            },
            messages:
            {
               "data[searchForm][search]":
                {
                    required:"This field is required."
                }
                
            },
           
        });
  });
</script>
