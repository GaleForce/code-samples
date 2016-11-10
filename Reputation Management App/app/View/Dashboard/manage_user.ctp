<?php
 if(isset($searchText))
 { 
   $searchText = $searchText;
 } 
 ?>
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
<?php echo $this->element('nav')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
       <?php echo $this->Session->flash(); ?>  
      <h3 class="page-title">
      <?php echo $design['AgencysiteSetting']['sitetitle']; ?> - Manage Users
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Home</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="#">Manage Users</a>
          </li>
        </ul>
        <div class="page-toolbar">
          
        </div>
      </div>
      <!-- END PAGE HEADER-->
        
        <div class="row">
          <div class="col-sm-12">
            <div id="content-wrapper">
              
              <div class="wrapTab">
           
            
             
            <div class="bodyTaab">
            

           
      
      <div class="col-md-10">
        <!-- BEGIN PORTLET-->
          <div class="portlet box reforce-red">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-user"></i>Business Accounts
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
                    <form class="form-inline" id="manage-search" method="post" action="<?php echo HTTP_ROOT?>dashboard/manageUser">
                    <form accept-charset="utf-8" method="post" id="searchFormIndexForm" action="<?php echo HTTP_ROOT?>dashboard/searchBusiness">
                    <div class="input-group">
                    <input type="search" class="form-control input-large input-inline" placeholder="Search Accounts" name="data[searchForm][search]">
                      <span class="input-group-btn">
                        <button type="submit" class="btn blue" type="button">Search</button>
                      </span>
                    </div>
                  </form>
                  </div>
                  
                  <div class="col-md-3 col-xs-3">
                  <a href="<?php echo HTTP_ROOT?>businesses/add" class="">
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
                          <a href="<?php echo HTTP_ROOT?>businesses/add" class="">
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
                           
                          <th class="bus_name"><?php echo $this->Paginator->sort('businessname','Business Name'); ?></th>
                          <th class="categ"><?php echo $this->Paginator->sort('BusinessCategory.name','Industry'); ?></th>
                          <th class="web_add"><?php echo $this->Paginator->sort('Business.companywebaddress','Website');  ?></th>
                          <th class="regis-date"><?php echo $this->Paginator->sort('createdat','Registration Date'); ?> </th>
                          <th class="dash-serial"><?php echo $this->Paginator->sort('Business.status','Status');  ?></th>
                          <th class="dash-account"><?php echo $this->Paginator->sort('Business.account_type','Acount Type'); ?></th>
                          <th class="dash-action"><?php echo 'Manage'; ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php App::import('Controller', 'Dashboard');
                               $dashboard = new DashboardController; ?>
                              
                         <?php if(!empty($businesses)){ ?>  
                         <?php foreach ($businesses as $key => $business): ?> 
                         <tr>
                               
                                <td><?php echo h($business['Business']['businessname']); ?>&nbsp;</td>
                                <td><?php echo h($business['BusinessCategory']['name']);//$this->Html->link($business['BusinessCategory']['name'], array('controller' => 'business_categories', 'action' => 'view', $business['BusinessCategory']['id'])); ?>&nbsp;</td>
                                <td><?php echo h($business['Business']['companywebaddress']); ?>&nbsp;</td>
                                <?php 
                                   $date = strtotime($business['Business']['createdat']);
                                   if($date > 1)
                                   { 
                                   $dat = date('Y-m-d', $date);
                                   $tme = date('H:m:s A',$date);
                                   }
                                   else
                                   {
                                    $dat = '--';
                                   }
                                ?>
                                <td><?php echo h($dat); ?>&nbsp;</td>

                                   <?php $target = array(0=>1,1=>0); ?>
                                  <?php if($business['User']['status'] == 1) {?>
                                  <td> <div style="cursor:pointer" class='statuschange' id="change<?php echo $business['User']['id']?>" rel="<?php echo HTTP_ROOT.'admin/updatestatusbusiness/'.base64_encode($business['User']['id']).'/'.$target[$business['User']['status']]?>"><img id="imge<?php echo $business['User']['id']?>" src="<?php echo HTTP_ROOT?>img/green_dots.png" width="25" height="11"></div>&nbsp;</td>
                                  <?php }else{ ?>
                                  <td><div style="cursor:pointer" class='statuschange' id="change<?php echo $business['User']['id']?>" rel="<?php echo HTTP_ROOT.'admin/updatestatusbusiness/'.base64_encode($business['User']['id']).'/'.$target[$business['User']['status']]?>"><img id="imge<?php echo $business['User']['id']?>" src="<?php echo HTTP_ROOT?>img/red-dots.png" width="25" height="11"></div>&nbsp;</td>
                                  <?php }?>
                                <td>paid</td>
                               <td><div class="dropdown pull-right">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                  Manage
                                  <span class="caret"></span>
                                </button>
                                
                                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'businesses/updateBusiness/'.base64_encode($business['Business']['id'])?>">Edit</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'businesses/resetPassword/'.base64_encode($business['Business']['user_Id'])?>">Password</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" 
                                  onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php echo HTTP_ROOT.'businesses/deleteBusiness/'.base64_encode($business['Business']['id']).'/'.base64_encode($business['Business']['user_Id'])?>">Delete</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" onclick="if(!confirm('Do you want to resend the new password and user name?')){return false;}" title="Delete" href="<?php echo HTTP_ROOT.'businesses/resendCredentail/'.base64_encode($business['Business']['user_Id'])?>">Resend Credentials</a></li>
                                
                                 <li role="presentation"> <?php echo $this->Html->link('Dashboard', '/dashboard/feedback/?bussiness='.base64_encode($business['Business']['id']), array('target' => '_blank','class'=>"")); ?></li>
                                </ul>
                                </div>
                              </td>
                              
                          </tr>
                         
                        
                         <?php endforeach; ?>
                         <?php } else {?>
                           <tr><th colspan="7" style="text-align:center !important;"> <?php echo "No record found.";?></th></td></tr>
                         <?php } ?>
                        </tbody>
                        </table>

                        <?php if(!empty($businesses)){ ?>
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

          <!-- END PORTLET-->
          </div>
      
      
            
            </div>             
          
              </div>
            </div>
          </div>
          <?php echo $this->element('reviewsidebar')?>
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
</div>
<style>
div.error {
    background: none repeat scroll 0 0 #f9e5e6;
    border: 1px solid #e8aaad;
    color: #b50007;
}
div.success {
    background: none repeat scroll 0 0 #d3f2c6;
    border: 1px solid #195600;
    color: #195600;
}
.response-msg {
    cursor: pointer;
    font-size: 13px;
    margin: 10px 0;
    padding: 6px 7px 7px 10px;
} 
</style>