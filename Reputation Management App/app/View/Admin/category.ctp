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
      ReForce Administration - Manage Categories
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Administration</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="<?php echo HTTP_ROOT?>admin/category">Manage Categories</a>
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
								<i class="fa fa-user"></i>Business Categories
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
									 <form class="form-inline" accept-charset="utf-8" method="post" id="searchFormIndexForm" action="<?php echo HTTP_ROOT?>admin/category">

										<div class="input-group">
										
										<input type="text" class="form-control input-inline" id="inputPassword2" placeholder="Category Name " name="data[searchForm][search]" value="<?php echo @$searchText; ?>">
										<div style="margin-left:0px; color:#bb0000;" class="errorTxt"></div>
										
										<span class="input-group-btn">
										<button type="submit" class="btn blue" type="button">Search</button>
										</span>
										</div>
									  </form>
									
								  </div>
								  
								  <div class="col-md-3 col-xs-6">
								  <a href="<?php echo HTTP_ROOT?>admin/add_category" class="">
									<div class="btn-group pull-right">
									  <button id="sample_editable_1_new" class="btn green">
									  Add Category <i class="fa fa-plus"></i>
									  
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
										  <a href="<?php echo HTTP_ROOT?>admin/add_category" class="">
										  Add Category </a>
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
													<th><?php echo $this->Paginator->sort('name','Category Name'); ?></th>
													<th class="dash-serial"><?php echo $this->Paginator->sort('status','Status');  ?></th>
													<th class="dash-action cat-action"><?php echo 'Action'; ?></th>
												  </tr>
												</thead>
											   <tbody>
												<?php if(!empty($bus_cat)){ ?>
												<?php foreach ($bus_cat as $key => $agency) { ?>
												<tr>
													<td style="text-align:left;"><?php echo h($agency['BusinessCategory']['name']); ?>&nbsp;</td>
													<?php $target = array(0=>1,1=>0); ?>
													<?php if($agency['BusinessCategory']['status'] == 1) {?>
													<td><div style="cursor:pointer" class='statuschange' id="change<?php echo $agency['BusinessCategory']['id']?>" rel="<?php echo HTTP_ROOT.'admin/cat_updatestatus/'.base64_encode($agency['BusinessCategory']['id']).'/'.$target[$agency['BusinessCategory']['status']]?>">
													<img id="imge<?php echo $agency['BusinessCategory']['id']?>" src="<?php echo HTTP_ROOT?>img/green_dots.png" width="25" height="11"></div>&nbsp;</td>
													<?php }else{ ?>
													<td><div style="cursor:pointer" class='statuschange' id="change<?php echo $agency['BusinessCategory']['id']?>" rel="<?php echo HTTP_ROOT.'admin/cat_updatestatus/'.base64_encode($agency['BusinessCategory']['id']).'/'.$target[$agency['BusinessCategory']['status']]?>"> 
													  <img id="imge<?php echo $agency['BusinessCategory']['id']?>" src="<?php echo HTTP_ROOT?>img/red-dots.png" width="25" height="11"></div>&nbsp;</td>
													<?php }?>
													<td><div class="dropdown drop_act" id="catep-drop">
													  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
														Action
														<span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
														<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/edit_category/'.base64_encode($agency['BusinessCategory']['id'])?>">Edit</a></li>
													  
														<!--<li role="presentation"><a role="menuitem" tabindex="-1" 
														onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php //echo HTTP_ROOT.'admin/delete/'.base64_encode($agency['BusinessCategory']['id'])?>">Delete</a></li>-->
													   
														<!-- <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/cat_updatestatus/'.base64_encode($agency['BusinessCategory']['id']).'/'.$target[$agency['BusinessCategory']['status']]?>">Status</a></li>-->

														 <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/bus_cat_list/'.base64_encode($agency['BusinessCategory']['id'])?>">Business</a></li>
													   
													  </ul>
													</div>
												  </td>
												</tr>
												<?php } } else {?>  <tr><th colspan="5No record found." style="text-align:center !important;"> <?php echo "No record found.";?></th></td></tr><?php } ?>
												</tbody>
											 </table>
											 
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
<script type="text/javascript">
  $('document').ready(function(){
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
                     var newurl=ajax_url+'admin/cat_updatestatus/'+response[1]+'/'+response[2];
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