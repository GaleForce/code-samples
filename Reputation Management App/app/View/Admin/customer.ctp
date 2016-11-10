<?php if(isset($searchText))
         { 
        ?>
            <script type="text/javascript">
             var scrolled=0;
             scrolled=scrolled+500;
             $(window).load(function() {
            $("html, body").animate({ scrollTop: scrolled }, 1000);
             });
           </script>        
         <?php } ?>
<?php
 if(isset($searchText))
 { 
   $searchText = $searchText;
 } 
 ?>
 <?php echo $this->element('nav_admin')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
       <?php echo $this->Session->flash(); ?>  
      <h3 class="page-title">
      ReForce Administration - Customers
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Administration</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="<?php echo HTTP_ROOT?>admin/customer">Customers</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
		
        <div class="row">
          <div class="col-sm-12">
			<div id="content-wrapper">
				
				       <!-- BEGIN PORTLET-->
					  <div class="portlet box reforce-red">
					  
						<!-- BEGIN PORTLET TITLE -->
						<div class="portlet-title">
						  <div class="caption">
							<i class="fa fa-user"></i>All Customers
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
						<!-- END TITLE -->
						
						<!-- BEGIN PORTLET BODY -->
						<div class="portlet-body grey">
						
						
						  <!-- TOOLBAR (PORT) -->
						  <div class="table-toolbar">
						  
							<div class="row">
							
							  <div class="col-md-7 col-xs-12">
									<form class="form-inline" id="manage-search" method="post" action="<?php echo HTTP_ROOT?>admin/customer">
									
									<div class="input-group">
									<input type="text" class="form-control fieldtext admin_ind" id="inputPassword2" placeholder="Customer Name " name="data[searchForm][search]" value="<?php echo @$searchText; ?>">
									<div style="margin-left:0px; color:#bb0000;" class="errorTxt"></div>
									
									<span class="input-group-btn">
										<button type="submit" class="btn blue" type="button">Search</button>
									</span>
									</div>
								  </form>
							  </div>
							  
							  <div class="col-md-3 col-xs-6">
							  <a href="<?php echo HTTP_ROOT?>admin/add_customer" class="">
								<div class="btn-group pull-right">
								  <button id="sample_editable_1_new" class="btn green">
								  Add New Customer <i class="fa fa-plus"></i>
								  
								  </button>
								</div>
							  </a>
							  </div>
							  
							  <div class="col-md-2 col-xs-6">
								<div class="btn-group pull-right">
								  <button class="btn dropdown-toggle yellow" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
								  </button>
								  <ul class="dropdown-menu pull-right">
									<li>
									  <a href="<?php echo HTTP_ROOT?>admin/add_customer" class="">
									  Add New Customer</a>
									</li>
									
									<li>
									  <a href="#">
									  Print </a>
									</li>
									<li>
									  <a href="#">
									  Export to CSV </a>
									</li>
								  </ul>
								</div>
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
												<tr>
												<th class="customer-first-col"><?php echo $this->Paginator->sort('Customer.firstname','Customer Name'); ?></th>
												<th><?php echo $this->Paginator->sort('Business.businessname','Business Name');  ?></th>
										<th><?php echo $this->Paginator->sort('Business.agencyname','Agency Name');  ?></th>
												<th><?php echo $this->Paginator->sort('Customer.email','Email'); ?> </th>
												<th class="dash-action"><?php echo 'Action'; ?></th>
											  </tr>
											  </tr>
											</thead>
											  <tbody>
											<?php if(!empty($Customer)){ ?>
											<?php foreach ($Customer as $key => $value) { ?>
											<tr>
												<td style="text-align:left;"><?php echo h($value['Customer']['firstname'].' '.$value['Customer']['lastname']); ?>&nbsp;</td>
												<td><?php echo h($value['Business']['businessname']); ?>&nbsp;</td>
										<td><?php echo h($value['Business']['agencyname']); ?>&nbsp;</td>
												<td><?php echo h($value['Customer']['email']); ?>&nbsp;</td>
												 <td><div class="dropdown drop_act" id="customer-drop">
												  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
													Action
													<span class="caret"></span>
												  </button>
												  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
													<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/edit_customer/'.base64_encode($value['Customer']['id'])?>">Edit</a></li>
													</ul>
												</div>
											  </td>
											</tr>
											<?php } } else {?>  <tr><th colspan="5No record found." style="text-align:center !important;"> <?php echo "No record found.";?></th></td></tr> <?php } ?>
											</tbody>
										  </table>
										  
										  <?php if(!empty($Customer)){ ?>
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
									<!-- END MAIN -->
								</div>
							</div>
						</div>
						<!-- END BODY -->
					</div>
					<!-- END PORTLET -->
			
			</div>
		  </div>
		</div>
		
		
</div>
</div>
 
 <script type="text/javascript">
$(document).ready(function(){
    $('#manage-search').validate({
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
                    required:"This is required field.",
                }    
            },
             messages: {},
             errorElement : 'div',
             errorLabelContainer: '.errorTxt'  
    });
    
    });
</script>
