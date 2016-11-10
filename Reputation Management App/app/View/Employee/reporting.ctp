<?php if(isset($rating))
         { 
        ?>
            <script type="text/javascript">
             $(window).load(function() {
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
             });
           </script>        
         <?php } ?>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php
$totalReview=$onestar+$twostar+$threestar+$fourstar+$fivestar;
$ratingData = array(
        '0' => array('Element','Number Of Customers'),
        '1' => array('One Star', $onestar),
        '2' => array('Two Star', $twostar),
        '3' => array('Three Star',$threestar),
        '4' => array('Four Star', $fourstar),
        '5' => array('Five Star', $fivestar)
);
$feedbackData=array();
if($success){
  $feedbackData = array(
        '0' => array('Feedback Customers','Number Of Customers'),
        '1' => array('Feedback', $success),
        '2' => array('No Feedback Customers Yet', $notFeed));

}else{
  $feedbackData = array(
        '0' => array('Feedback Customers','Number Of Customers'),
        '1' => array('Feedback', 0),
        '2' => array('No Feedback Customers Yet', 1));
        
}


?>
<?php echo $this->element('AdminElement/employeenav')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
		   <?php echo $this->Session->flash(); ?>  
		  <h3 class="page-title">
		  Welcome, <?php echo $EmployeeName;?> - Reporting
		  </h3>
		  <div class="page-bar">
			<ul class="page-breadcrumb">
			  <li>
				<i class="fa fa-home"></i>
				<a href="<?php echo HTTP_ROOT?>">Home</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="#">Reporting</a>
				
			  </li>
			 
			</ul>
			<div class="page-toolbar">
				<div class="row">
					<div class="col-md-12">
					

					
					</div>
				</div>
			</div>
		  </div>
		  <!-- END PAGE HEADER-->
			
			<div class="row"> <!-- ROW & COL FOR LAYOUT -->
			<div class="col-md-12">
												
			<div class="row"> 
				<div class="col-sm-6">
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
							<i class="fa fa-bar-chart"></i> Reviews by Rating
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
							
								 
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									
										<div id="ex0"></div>
										 
										
									
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
				
				<div class="col-sm-6">
				
					<!----------------------------------->
					<!----------------------------------->
						  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
						  <!--   >>  BEGIN PORTLET  << -->
						  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
						  <div class="portlet box reforce-red">
						  
							<!-- BEGIN PORTLET TITLE -->
							<div class="portlet-title">
							  <div class="caption">
								<i class="fa fa-reply"></i> Customer Response Rate
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
								
									 
												
								</div>
							  </div>
							  <!-- TOOLBAR END (PORT) -->
							  
								<div class="row">
									<div class="col-md-12">
										<!-- PORTLET MAIN CONTENT -->
										
											<div id="piechart"></div>

										
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
				
			</div> <!-- END LAYOUT ROW -->	
			
			<div class="row">
				<div class="col-sm-12">
				
										<!----------------------------------->
										<!----------------------------------->
											  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
											  <!--   >>  BEGIN PORTLET  << -->
											  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
											  <div class="portlet box reforce-red">
											  
												<!-- BEGIN PORTLET TITLE -->
												<div class="portlet-title">
												  <div class="caption">
													<i class="fa fa-list-ol"></i> Number of Reviews for Each Rating
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
													
														 
																	
													</div>
												  </div>
												  <!-- TOOLBAR END (PORT) -->
												  
													<div class="row">
														<div class="col-md-12">
															<!-- PORTLET MAIN CONTENT -->
															
																<div class="table-scrollable">
																
																	<?php if($totalReview==0)$totalReview=1;?>

																	  <table class="table report-table">  
																		 <tr><td></td><td>1 Star</td><td>2 Star</td><td>3 Star</td><td>4 Star</td><td>5 Star</td></tr>
																		 <tr><td>Reviews:</td><td><?php echo $onestar?></td><td><?php echo $twostar?></td><td><?php echo $threestar?></td><td><?php echo $fourstar?></td><td><?php echo $fivestar?></td></tr>
																		 <tr><td>Percentage:</td><td><?php echo number_format((float)(($onestar/$totalReview)*100), 2, '.', '').'%'?></td><td><?php echo number_format((float)(($twostar/$totalReview)*100), 2, '.', '').'%'?></td><td><?php echo number_format((float)(($threestar/$totalReview)*100), 2, '.', '').'%'?></td><td><?php echo number_format((float)(($fourstar/$totalReview)*100), 2, '.', '').'%'?></td><td><?php echo number_format((float)(($fivestar/$totalReview)*100), 2, '.', '').'%'?></td></tr>
																	  </table>
																
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
			</div>
			
			<div class="row">
				<div class="col-sm-12">
				
										<!----------------------------------->
										<!----------------------------------->
											  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
											  <!--   >>  BEGIN PORTLET  << -->
											  <!-- @@@ @@@ @@@ @@@ @@@ @@@ -->
											  <div class="portlet box reforce-red">
											  
												<!-- BEGIN PORTLET TITLE -->
												<div class="portlet-title">
												  <div class="caption">
													<i class="fa fa-user"></i>Reviews by Customer
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
														<div class="col-md-4">
														               <form method="post" id="search-reviews" class="form-inline" action="<?php echo HTTP_ROOT?>Employee/reporting">
																		<input type="hidden" name="data[Employee][id]" value="<?php echo @$selectedId;?>">
																		
																		<div class="form-group input-group">
																		<label class="sr-only" for="inputPassword2"> </label>
																		<input type="text" name="data[searchForm][search]" placeholder="Search by Customer Info" id="searchname" class="form-control input-md fieldtext">
																		<div class="errorTxt" style="margin-left:0px; color:#bb0000"></div>
																		<span class="input-group-btn">
																			<button type="submit" class="btn blue" type="button">Search</button>
																		</span>
																		</div>
																		
														</div>
														
														<div class="col-md-6">
																	  <form method="post" id="filterBy" class="form-inline" action="<?php echo HTTP_ROOT?>Employee/reporting/">
																	  <input type="hidden" name="data[Employee][id]" value="<?php echo @$selectedId;?>">
																	  <input type="hidden" name="data[Employee][time]" value="<?php echo @$selectedtime;?>">
																		  <div class="form-group">
																			  <b>Filter By: </b> 
																			  <label>
																				<input type="checkbox" class="radio" value="1" name="data[BusinessReview][starrating]" <?php if(@$rating==1){ ?>checked="checked"<?php } ?>/><span>One Star</span></label>
																			  <label>
																				<input type="checkbox" class="radio" value="2" name="data[BusinessReview][starrating]" <?php if(@$rating==2){ ?>checked="checked"<?php } ?> /><span>Two Star</span></label>
																			  <label>
																				<input type="checkbox" class="radio" value="3" name="data[BusinessReview][starrating]" <?php if(@$rating==3){ ?>checked="checked"<?php } ?> /><span>Three Star</span></label>
																	<label>
																	  <input type="checkbox" class="radio" value="4" name="data[BusinessReview][starrating]" <?php if(@$rating==4){ ?>checked="checked"<?php } ?> /><span>Four Star</span></label>
																	<label>
																	  <input type="checkbox" class="radio" value="5" name="data[BusinessReview][starrating]" <?php if(@$rating==5){ ?>checked="checked"<?php } ?> /><span>Five Star</span></label>  
																			</div>
																	</form>
														</div>
														
														<div class="col-md-2">
															<a style="cursor:pointer;" class="btn adNew blue pull-right" data-toggle="modal" data-target="#csv_export-model" data-placement="top" title="Export Customers in CSV">
															   <!-- <img style="width:20px;height:20px;" src="<?php // echo $this->webroot; ?>img/export.jpeg">-->
															   <i class="fa fa-download"></i> Export Customers
															</a> 
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
																			  
																			  <th class="cust_pad"><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
																			  <th class="last-serial last_pad"><?php echo $this->Paginator->sort('Customer.firstname','Last Name'); ?></th>
																			  <th class="fed_tab"><?php echo $this->Paginator->sort('BusinessReview.ratingdate','Feedback Date'); ?></a></th>
																			  <th class="last-serial"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
																			  <th><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
																			  <th class="employee-serial"><?php echo $this->Paginator->sort('Business.businessname','Business Name'); ?></th>
																			  <th><?php echo $this->Paginator->sort('BusinessReview.ratingstar','Rating'); ?></th>
																			  <th class="dash-serial">Action</th>                  
																		</tr>
																		</thead>
																		<tbody>
																	 
																		<?php if(!empty($customersReviews)){?>
																		<?php foreach ($customersReviews as $key => $review) {?>
																			<tr>
																				
																				<td><?php echo $review['Customer']['firstname']; ?></td>
																				<td><?php echo $review['Customer']['lastname']; ?></td>
																				<td>
																					<?php 
																						$date = strtotime($review['BusinessReview']['ratingdate']);
																						$dat = date('Y-m-d', $date);
																						$tme = date('H:m:s A',$date);
																						echo $dat;
																					?>
																				</td>
																				<td><?php echo $review['Customer']['phonenumber']; ?></td>
																				<td><?php echo $review['Customer']['email']; ?></td>
																				<td><?php echo $review['Business']['businessname']; ?></td>
																				<td>
																				<?php 
																					for($i=1;$i<=5;$i++){ 
																				?>   	
																					  <?php if($i<=$review['BusinessReview']['ratingstar']){ ?>
																						<img src="<?php echo HTTP_ROOT?>img/star.png">
																					  <?php } else {?>
																						 <img src="<?php echo HTTP_ROOT?>img/small.png">
																					  <?php }?>
																					
																				<?php }?>
																					
																				   
																				</td>
																				<td><a href="<?php echo HTTP_ROOT.'Employee/customerView/'.$review['BusinessReview']['id']?>/<?php echo $busid?>">View</a></td>
																			</tr>
																		<?php } ?>  	
																		<?php } else{?>  	
																			<tr><th colspan="8" style="text-align:center !Important;"> <?php echo "No record found.";?></th></td></tr>
																		<?php }?>
																		</tbody>
																  </table>
																   <?php //if(count($customersReviews)>0){?>
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
																	<?php //}?>  
																
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
				
			</div>
		</div>
		
		</div>
		
	</div>
</div>
  <script type="text/javascript">
$(document).ready(function(){
    $('#search-reviews').validate({
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
<script>
    google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(<?php echo json_encode($ratingData) ?>);

      var options = {
        width: '90%',
        height:325,
		
		backgroundColor: 'transparent',
		title: 'Ratings Left by Customers',
		subtitle: 'Scale from 1 to 5 Stars',
        hAxis: {
          title: 'Rating in Stars',
          gridlines: {count: 5}
        },
        vAxis: {
          title: 'Number of Customers'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('ex0'));

      chart.draw(data, options);
    }
  
</script>
 
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo json_encode($feedbackData) ?>);

        var options = {
          width: '90%',
		  height:325,
          title: 'Customer Response',
		  is3D: true,
		  backgroundColor: 'transparent',
          sliceVisibilityThreshold:0
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>
<script type="text/javascript">
  $("input:checkbox").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);

      } else {
        $box.prop("checked", false);
      }
      $('#filterBy').submit();  
    });
</script>  
            
 <div class="modal fade" id="csv_export-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="upload-title">Export file</h4>
                                  <h5 class="filter-title">Filter options</h5>
                                  
                                </div>
                               
                                <div class="modal-body">
                                  <form id="frmsubmit" method="post" action="<?php echo HTTP_ROOT?>Employee/exportReport/<?php echo $busid ?>"> 
                                   <h5 class="export-title" id="exampleModalLabel">Export All (select All)</h5>


      <div class="main_slct">
      <input type="checkbox" value="allType" class="all" name="data[exportby][all]">
      <span>Select All</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="1" class="particular" name="data[exportby][search]">
      <span>1 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="2" class="particular" name="data[exportby][search]">
      <span>2 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="3" class="particular" name="data[exportby][search]">
      <span>3 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="4" class="particular" name="data[exportby][search]">
      <span>4 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="5" class="particular" name="data[exportby][search]">
      <span>5 Star</span>
      </div>
  
      <div class="main_slcted">
      <input type="button" class="btnSubmit btn-primary btn" value="ExportFile"></button>
      <div id="notificationexport" style="display:none;color:red"></div>
      <div id="notificationexport" style="display:none;color:red"></div>
      </div>
                                   
      </div>
      </form> 
      <div class="modal-footer">
      <button type="button" class="btn btn-default buttonclose close_modal" data-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
      </div>
    </div>


<style>
.modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }
</style>
 <script type="text/javascript">
   $('document').ready(function(){
     $(document).on('click','.all',function() {
      $('.particular').prop('checked',true);
       $(this).addClass('uncheckAll');
        $('.btnSubmit').click(function() {
          
        $('#frmsubmit').submit();
        $('.buttonclose').trigger( "click" ); 
        }); 
    });
    $(document).on('click','.uncheckAll',function() {
      $('.particular').prop('checked',false);
       $(this).removeClass('uncheckAll');
       $('.all').removeAttr('checked'); 
    });  
      $('.particular').click(function(){
      $('.particular').removeClass('active');
      $(this).addClass('active');
      $(this).attr('checked',true);
      $('.all').removeAttr('checked');
      $('input[type=checkbox]').each(function () {
        if( $( this ).hasClass( 'active' ))
        {
          $(this).attr('checked',true);
        }
        else
        {
          $(this).removeAttr('checked');
        }

      return;

    });

     $('.btnSubmit').click(function() { 
       $('#frmsubmit').submit();
        $('.buttonclose').trigger( "click" ); 
       }); 
   });
  });
 </script>
 <script type="text/javascript">
 $(document).ready(function(){
 $('.btnSubmit').click(function(){
  var count = $("[type='checkbox']:checked").length;
  if( count > 0)
  {
        $('#frmsubmit').submit();
        $('.buttonclose').trigger( "click" );
  }else{
            $('#notificationexport').text('Pease select any option to generate the csv file');
            $('#notificationexport').show();
            $('#notificationexport').delay(2000).fadeOut();
            return false;
  }

  
 }); 
 });
 </script>            
            
    



   
