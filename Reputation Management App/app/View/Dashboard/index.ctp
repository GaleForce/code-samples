<?php
 if(isset($searchText)){ 
   $searchText = $searchText;
 } 
 ?>
<script type="text/javascript">
$(document).ready(function(){
    $('#feedback-search').validate({
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
                    required:"This is required field",
                }    
            },
             messages: {},
             errorElement : 'div',
             errorLabelContainer: '.errorTxt'  
    });
    
    });
</script>

<?php echo $this->element('nav')?>
<div class="page-content-wrapper">
<div class="page-content">
  <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
               Widget settings form goes here
            </div>
            <div class="modal-footer">
              <button type="button" class="btn blue">Save changes</button>
              <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
      <!-- BEGIN PAGE HEADER-->
      <?php echo $this->Session->flash(); ?>
      <h3 class="page-title">
      <?php echo $design['AgencysiteSetting']['sitetitle']; ?> - Dashboard <small>statistics and more</small>
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT;?>">Home</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="#">Dashboard</a>
          </li>
        </ul>
        <div class="page-toolbar">
          <!--<div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height reforce-red ref-whitetext" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
          </div>-->
        </div>
      </div>
      <!-- END PAGE HEADER-->
      <!-- business listing -->
     <?php App::import('Controller', 'Dashboard');
                           $dashboard = new DashboardController; ?>
            <!-- load dashboard controller to call get reatings method -->
      <?php echo $this->element('topbar')?>     
      <div class="clearfix">
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <!-- BEGIN PORTLET-->
          <div class="portlet box reforce-red">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-globe"></i>Clients
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
                
                  <div class="col-md-6 col-xs-6">
                  <a href="<?php echo HTTP_ROOT?>businesses/add" class="">
                    <div class="btn-group">
                      <button id="sample_editable_1_new" class="btn green">
                      Add New <i class="fa fa-plus"></i>
                      
                      </button>
                    </div>
                  </a>
                                        
                  </div>
                  <div class="col-md-6 col-xs-6">
                    <div class="btn-group pull-right">
                      <button class="btn dropdown-toggle yellow" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="<?php echo HTTP_ROOT?>businesses/add" class="">
                          Add New </a>
                        </li>
                        <li>
                          <a href="<?php echo HTTP_ROOT?>dashboard/manageUser">
                          Manage Clients </a>
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
              
              <div class="row" style="margin-top:10px;">
                
                <div class="col-md-6">
                    <form class="form-inline" id="feedback-search" method="post" action="<?php echo HTTP_ROOT?>dashboard/searchBusiness">
                    <form accept-charset="utf-8" method="post" id="searchFormIndexForm" action="<?php echo HTTP_ROOT?>dashboard/searchBusiness">
                    <div class="input-group">
                    <input type="search" class="form-control input-large input-inline" placeholder="Search For Business" name="data[searchForm][search]">
                      <span class="input-group-btn">
                        <button type="submit" class="btn blue" type="button">Go!</button>
                        <!--  <input type="submit" class="owner-btn btn-primary" value="Search" style="margin-left:5px;"/> -->
                      </span>
                    </div>
                  </form>
                </div>
                                        
                  </div>
                  <div class="col-md-6">
                  
                                
              </div>
              
            </div>
            <div class="table-scrollable">
            <table class="table table-hover">
                      <thead>
                      <tr>
                         <th class="busi_owner"><?php echo $this->Paginator->sort('Business.businessname','Business Name'); ?></th>
                         <th class="dash_rate"><?php echo $this->Paginator->sort('Business.averageRating','Average Rating');?></th>
                         <th><?php echo $this->Paginator->sort('Business.lastReviewdate','Last Reviewed On');?></th>
                         <th><?php echo $this->Paginator->sort('User.lastlogin','Last Login');?></th>
                         <th class="dash-review"><?php echo $this->Paginator->sort('Business.totalReviews','Total Reviews');?></th>
                      </tr>
                      </thead>
                         <tbody>
                              <?php $k=0; if(!empty($businesses)){ ?>  
                              <?php foreach ($businesses as $key => $business):

                                 // if(!$business['Business']['averageRating']){
                                 //    continue;
                                 // }
                              ?>  

                              <tr>
                                
                                 <td><?php echo h($business['Business']['businessname']); ?>&nbsp;</td>
                                 <td>
                                    <!-- get averrage ratings for business -->
                                    <?php
                                         $avgrating=($business['Business']['averageRating'])?number_format((float)$business['Business']['averageRating'], 2, '.', ''):'--' ;
                                         echo $avgrating; 
                                    ?>&nbsp;
                                   
                                 </td>
                                 <td>
                                    <!-- get last review date -->
                                    <?php 
                                     if(!$business['Business']['lastReviewdate']){
                                          $LRdat="No Reviews";
                                      }else{
                                          $Rdate=strtotime($business['Business']['lastReviewdate']);
                                          $LRdat=date('Y-m-d',$Rdate);
                                      } 
                                     
                                    echo $LRdat; ?>&nbsp;
                                 </td>
                                 <?php 
                                    if($business['User']['lastlogin']){
                                        $date=strtotime($business['User']['lastlogin']);
                                        $dat=date('Y-m-d',$date);
                                    }else{
                                         $dat='---' ;
                                    }
                                   
                                 ?>
                                 <td><?php echo h($dat); ?>&nbsp;</td>
                                 <td>
                                    <!-- get total review -->
                                    <?php  
                                        //echo $dashboard -> totalReviews($business['Business']['id'] ); 
                                        echo $business['Business']['totalReviews'];
                                    ?>&nbsp;
                                 </td>
                              </tr>
                              <?php endforeach; ?>
                              <?php }else { ?>
                               <tr><th colspan="5No record found." style="text-align:center !important;"> <?php echo "No record found.";?></th></td></tr>
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
                <div class="pagination">
                   <?php
                    echo $this->Paginator->prev('< ' . __('previous |'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__(' next') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
                <?php }?>
                <!-- business list ends -->
                
                    </div>
          </div>
          </div>
          <!-- END PORTLET-->
        
        </div>
      </div>
      <!-- SEPARATOR FOR NEXT PORTLET -->
      <div class="clearfix">
        </div>
        
    </div>
  </div>
  </div>
