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
<script type="text/javascript">
$(document).ready(function(){
    $('#searchBusinessForm').validate({
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
      ReForce Administration - Businesses
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Administration</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="<?php echo HTTP_ROOT?>">Businesses</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
    <div class="row">
          

            

           
      
      <div class="col-md-12">
        <!-- BEGIN PORTLET-->
          <div class="portlet box reforce-red">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-user"></i>All Businesses
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
					 <form class="form-inline" id="manage-search" method="post" action="<?php echo HTTP_ROOT?>admin/agencyBusiness">
						<div class="form-group">
						<label class="sr-only"> </label>
						<p style="float:left;" class="form-control-static"><strong>Search:</strong></p>
						</div>
						<div class="form-group">
						<label for="inputPassword2" class="sr-only"> </label>
						<input type="hidden" name = "data[searchForm][agency_id]" value="<?php echo @$agency_id ?>">
						<input style="float:left;width:210px;" type="text" class="form-control fieldtext admin_ind" id="inputPassword2" placeholder="Type Business Name " name="data[searchForm][search]" value="<?php echo @$searchText; ?>">
						<div style="margin-left:0px; color:#bb0000" class="errorTxt"></div>
						</div>
						<input type="submit" class="btn btn-primary" value="Search"/>
						
					  </form>
                  </div>
                  
                  <div class="col-md-3 col-xs-3">
                  <a href="<?php echo HTTP_ROOT?>admin/add_business" class="">
                    <div class="btn-group pull-right">
                      <button id="sample_editable_1_new" class="btn green">
                      Add New Business <i class="fa fa-plus"></i>
                      
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
                          <a href="<?php echo HTTP_ROOT?>admin/add_business" class="">
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
								<th><?php echo $this->Paginator->sort('Business.agencyname','Agency Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Business.businessname','Business Name'); ?></th>
								<th><?php echo $this->Paginator->sort('BusinessCategory.name','Category');  ?></th>
								<th><?php echo $this->Paginator->sort('User.firstname','Contact'); ?> </th>
								<th class="dash-serial"><?php echo $this->Paginator->sort('User.status','Status');  ?></th>
								<th class="dash-action"><?php echo 'Action'; ?></th>
							 </tr>
						</thead>
						 <tbody>
							<?php if(!empty($Agency_bus)){ ?>
							<?php foreach ($Agency_bus as $key => $value) { ?>
							<tr>
								<td style="text-align:left;"><?php echo h($value['Business']['agencyname']); ?>&nbsp;</td> 
								<td style="text-align:left;"><?php echo h($value['Business']['businessname']); ?>&nbsp;</td>
								<td><?php echo h($value['BusinessCategory']['name']); ?>&nbsp;</td>
								<td><?php echo h($value['User']['email']); ?>&nbsp;</td>
								 <?php $target = array(0=>1,1=>0); ?>
								<?php if($value['User']['status'] == 1) {?>
								<td> <div style="cursor:pointer" class='statuschange' id="change<?php echo $value['User']['id']?>" rel="<?php echo HTTP_ROOT.'admin/updatestatusbusiness/'.base64_encode($value['User']['id']).'/'.$target[$value['User']['status']]?>"><img id="imge<?php echo $value['User']['id']?>" src="<?php echo HTTP_ROOT?>img/green_dots.png" width="25" height="11"></div>&nbsp;</td>
								<?php }else{ ?>
								<td><div style="cursor:pointer" class='statuschange' id="change<?php echo $value['User']['id']?>" rel="<?php echo HTTP_ROOT.'admin/updatestatusbusiness/'.base64_encode($value['User']['id']).'/'.$target[$value['User']['status']]?>"><img id="imge<?php echo $value['User']['id']?>" src="<?php echo HTTP_ROOT?>img/red-dots.png" width="25" height="11"></div>&nbsp;</td>
								<?php }?>
								<td><div class="dropdown drop_act">
								  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
									Action
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/edit_business/'.base64_encode($value['Business']['id'])?>">Edit</a></li>
								  
								   <!-- <li role="presentation"><a role="menuitem" tabindex="-1" 
									onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php //echo HTTP_ROOT.'admin/delete/'.base64_encode($value['Business']['id'])?>">Delete</a></li>-->
								   
								   <!--  <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/bus_updatestatus/'.base64_encode($value['Business']['id']).'/'.$target[$value['User']['status']]?>">Status</a></li> -->
									<li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/employees/'.base64_encode($value['Business']['id'])?>">Employee</a></li>
								  </ul>
								</div>
							  </td>
							</tr>
							<?php } } else {?>
			  <tr><th colspan="5No record found." style="text-align:center !important;"> <?php echo "No record found.";?></th></td></tr>
							<?php } ?>
							</tbody>
						  </table>
						   <?php if(!empty($Agency_bus)){ ?>
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
                     var newurl=ajax_url+'admin/updatestatusbusiness/'+response[1]+'/'+response[2];
                       if(response[2]==0){
                          var newdots=ajax_url+'img/green_dots.png';
                       }else{
                         var newdots=ajax_url+'img/red-dots.png';
                       }
                       $('#change'+response[3]).attr('rel',newurl);
                       $('#imge'+response[3]).attr('src',newdots);
                       $("#loading").hide();
                       $('#bdycontent').html('Status has been updated Successfully.');                  
                       $('#alert').click();
                                     
                  }else if(response[0]=='agency'){
                     $("#loading").hide();
                     $('#bdycontent').html('Please Activate Business Agency First..');                  
                     $('#alert').click();
                   
                  }else{
                     $("#loading").hide();
                     $('#bdycontent').html('!Oops there is something wrong with server.Please try again.');
                     $('#alert').click();
                    
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