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
<script type="text/javascript">
$(document).ready(function(){
    $('#searchFormIndexForm').validate({
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
<?php echo $this->element('nav_admin')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
       <?php echo $this->Session->flash(); ?>  
      <h3 class="page-title">
      ReForce Administration - Dashboard
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Administration</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="<?php echo HTTP_ROOT?>">Dashboard</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
        <div class="row">
          <div class="col-sm-12">
            <div id="content-wrapper">

            

           
      
      <div class="col-md-12">
        <!-- BEGIN PORTLET-->
          <div class="portlet box reforce-red">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-user"></i>Agency Clients
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
              <div class="table-toolbar">
              
                <div class="row">
                
                  <div class="col-md-7 col-xs-7">
					<form class="form-inline" id="manage-search" method="post" action="<?php echo HTTP_ROOT?>admin/index">
						<div class="form-group">
						
						<label class="sr-only"> </label>
						<p style="float:left;" class="form-control-static"><strong>Search:</strong></p>
						</div>
						<div class="form-group">
						<label for="inputPassword2" class="sr-only"> </label>
						<input style="float:left; width:210px;" type="text" class="form-control fieldtext admin_ind" id="inputPassword2" placeholder="Type Agency Name " name="data[searchForm][search]" value="<?php echo @$searchText; ?>">
						<div style="margin-left: 0px; color:#bb0000" class="errorTxt"></div>
						</div>
						<input type="submit" class="btn btn-primary" value="Search"/>
						
					  </form>
                  </div>
                  
                  <div class="col-md-3 col-xs-3">
                  <a href="<?php echo HTTP_ROOT?>admin/add" class="">
                    <div class="btn-group pull-right">
                      <button id="sample_editable_1_new" class="btn green">
                      Add New Agency <i class="fa fa-plus"></i>
                      
                      </button>
                    </div>
                  </a>
                  </div>
                  
                  <div class="col-md-2 col-xs-2">
                    <div class="btn-group pull-right">
                      <button class="btn dropdown-toggle yellow" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="<?php echo HTTP_ROOT?>admin/add" class="">
                          Add New </a>
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
			  
			   <div class="row">
                
                  <div class="col-md-12">
                      <div class="table-scrollable">
                        <table class="table table-hover">
                        <thead class="tbleHead">
                          <tr>
							<th><?php echo $this->Paginator->sort('User.agencyname','Agency Name'); ?></th>
							<th><?php echo $this->Paginator->sort('User.lastlogin','Last login');  ?></th>
							<th><?php echo $this->Paginator->sort('User.email','Contact'); ?> </th>
							<th class="dash-serial"><?php echo $this->Paginator->sort('User.status','Status');  ?></th>
							<th class="dash-action"><?php echo 'Action'; ?></th>
						  </tr>
						 </thead>
						 <tbody>
									<?php if(!empty($agency_data)){ ?>
									<?php foreach ($agency_data as $key => $value) { ?>
									<tr>
										<td style="text-align:left;"><?php echo h($value['User']['agencyname']); ?>&nbsp;</td>
										 <?php 
											if($value['User']['lastlogin']){
												$date=strtotime($value['User']['lastlogin']);
												$dat=date('Y-m-d',$date);
											}else{
												 $dat='---' ;
											}
										   
										 ?>
										<td><?php echo $dat; ?>&nbsp;</td>
										<td><?php echo h($value['User']['email']); ?>&nbsp;</td>
										<?php $target = array(0=>1,1=>0); ?>
										<?php if($value['User']['status'] == 1) {?>
										<td> 
										  <div style="cursor:pointer" class='statuschange' id="change<?php echo $value['User']['id']?>" rel="<?php echo HTTP_ROOT.'admin/updatestatusagency/'.base64_encode($value['User']['id']).'/'.$target[$value['User']['status']]?>">
										  <img id="imge<?php echo $value['User']['id']?>" src="<?php echo HTTP_ROOT?>img/green_dots.png" width="25" height="11"></div>
										</td>
										<?php }else{ ?>
										<td> 
										  <div style="cursor:pointer" class='statuschange' id="change<?php echo $value['User']['id']?>" rel="<?php echo HTTP_ROOT.'admin/updatestatusagency/'.base64_encode($value['User']['id']).'/'.$target[$value['User']['status']]?>">
										  <img id="imge<?php echo $value['User']['id']?>" src="<?php echo HTTP_ROOT?>img/red-dots.png" width="25" height="11"></div>
										</td>
										<?php  }?>
										
										<td><div class="dropdown drop_act">
										  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
											Action
											<span class="caret"></span>
										  </button>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
											<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/editAgency/'.base64_encode($value['User']['id'])?>">Edit</a></li>
										  
										   <!--<li role="presentation"><a role="menuitem" tabindex="-1" 
											onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php //echo HTTP_ROOT.'admin/delete/'.base64_encode($value['User']['id'])?>">Delete</a></li>-->
										   
											 
											 <!--<li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/updatestatus/'.base64_encode($value['User']['id']).'/'.$target[$value['User']['status']]?>">Status</a></li> -->

											 <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/agencyBusiness/'.base64_encode($value['User']['id'])?>">Business</a></li>
										   
										  </ul>
										</div>
									  </td>
									</tr>
									<?php } } else {?>
					  <tr><th colspan="5No record found." style="text-align:center !important;"> <?php echo "No record found.";?></th></td></tr>

									<?php
										}
										?>
						</tbody>
					</table>
					
					  <?php if(!empty($agency_data)){ ?>
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
					</div>
				</div>
			</div>
			<!-- END PORTLET -->
				
	</div>
	</div>
	</div>
	</div>
			<div style="display:none" type="button" id="alert" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">	</div>
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
									 var newurl=ajax_url+'admin/updatestatusagency/'+response[1]+'/'+response[2];
									   if(response[2]==0){
										  var newdots=ajax_url+'img/green_dots.png';
									   }else{
										 var newdots=ajax_url+'img/red-dots.png';
									   }
									   $('#change'+response[3]).attr('rel',newurl);
									   $('#imge'+response[3]).attr('src',newdots);
									   $("#loading").hide();
									   //alert("Status has been updated Successfully.");  
										$('#bdycontent').html('Status has been updated Successfully.');                  
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