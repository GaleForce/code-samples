<?php if(isset($rating) || isset($ratingStatus) || isset($searchText))
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
 <?php echo $this->element('uploadcsv')?> 

<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
		   <?php echo $this->Session->flash(); ?>  
		  <h3 class="page-title">
		  <?php echo $this->element('welcome')?> - Contact Manager
		  </h3>
		  <div class="page-bar">
			<ul class="page-breadcrumb">
			  <li>
				<i class="fa fa-home"></i>
				<a href="<?php echo HTTP_ROOT?>">Home</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="#">Contact Manager</a>
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
							<i class="fa fa-user"></i>Contact Manager
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
								<div class="col-md-6">

									<form class="form-inline" accept-charset="utf-8" method="post" id="searchFormIndexForm" action="<?php echo HTTP_ROOT?>dashboard/contactManager">
										<div class="input-group form-group">
										<input type="search" class="form-control input-med input-inline" placeholder="Search by Name or Email" name="data[searchby][text]" value="<?php echo @$searchText ?>">
										  <span class="input-group-btn">
											<button type="submit" class="btn blue" type="button">Search</button>
										  </span>
										</div>
									</form>
									
								</div>
								  
								 <!-- Filters -->
								 <div class="col-md-6">
									<form method="post" class="form-inline" accept-charset="utf-8" id="searchbystar" href="<?php echo HTTP_ROOT;?>dashboard/contactManager">
										<div class="form-group">
										<b>Filter by Rating:</b>
											<span><input type="checkbox" class="checkbox-inline" name="data[searchbystar][star]" value="1" <?php if(@$rating==1){ ?>checked="checked"<?php } ?>/>1 star</span>	
											<span><input type="checkbox" class="checkbox-inline" name="data[searchbystar][star]" value="2" <?php if(@$rating==2){ ?>checked="checked"<?php } ?>/>2 star</span>
											<span><input type="checkbox" class="checkbox-inline" name="data[searchbystar][star]" value="3" <?php if(@$rating==3){ ?>checked="checked"<?php } ?>/>3 star</span>
											<span><input type="checkbox" class="checkbox-inline" name="data[searchbystar][star]" value="4" <?php if(@$rating==4){ ?>checked="checked"<?php } ?>/>4 star</span>
											<span><input type="checkbox" class="checkbox-inline" name="data[searchbystar][star]" value="5" <?php if(@$rating==5){ ?>checked="checked"<?php } ?>/>5 star</span></br>
										<b>Filter by Status:</b>
											<span><input type="checkbox" class="checkbox-inline" name="data[advancesearch][star]" value="NoFeedbackLeft" <?php if(@$ratingStatus=='NoFeedbackLeft'){ ?>checked="checked"<?php } ?>/>No feedBack Left</span>
											<span><input type="checkbox" class="checkbox-inline" name="data[advancesearch][star]" value="NotInFeedbackSequence" <?php if(@$ratingStatus=='NotInFeedbackSequence'){ ?>checked="checked"<?php } ?>>Not in feedBack Sequence</span> 
											<span><input type="checkbox" class="checkbox-inline" name="data[advancesearch][star]" value="InFeedbackSequence" <?php if(@$ratingStatus=='InFeedbackSequence'){ ?>checked="checked"<?php } ?>>In feedback sequence</span>
											<span><input type="checkbox" class="checkbox-inline" name="data[advancesearch][star]" value="Opt-Out" <?php if(@$ratingStatus=='Opt-Out'){ ?>checked="checked"<?php } ?>>Opt Out</span>
										</div>
									</form>
								 </div>
											
							</div>
							
							<div class="row"> <!-- 2nd ROW BUTTONS -->
							
								<div class="col-md-6"> <!-- BUTTONS -->
								
									<div class="customer_btns">
										
										<!-- Add Customer -->
										<a data-toggle="tooltip" data-placement="top" title="New Customer" href="<?php echo HTTP_ROOT?>dashboard/addCustomer/<?php echo $busid; ?>" class="btn adNew blue-chambray">
											<i class="fa fa-user-plus"></i>
											<!--<img style="width:20px;height:20px;" src="<?php //echo $this->webroot; ?>img/addcustomer.png">-->
										</a>
										
										<!-- Import CSV -->
										<a style="cursor:pointer;" class="btn adNew blue-chambray" data-toggle="modal" data-target="#csv-model" >
											<i class="fa fa-upload" data-toggle="tooltip" data-placement="top" title="Import CSV of Customers"></i>
											<!-- <img style="width:20px;height:20px;" src="<?php // echo $this->webroot; ?>img/import.jpeg"> -->
										</a>
										
										<!-- Export CSV -->
										<a style="cursor:pointer;" class="btn adNew blue-chambray" data-toggle="modal" data-target="#csv_export-model" >
											<i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="Export Customers in CSV"></i>
											<!--<img  style="width:20px;height:20px;" src="<?php // echo $this->webroot; ?>img/export.jpeg">-->
										</a>
										
										<!--<a href="javascript:void(0)" class="btn adNew btn-info">Send Special Notification</a>-->
										
										<!-- Start Feedback -->
										<a data-toggle="tooltip" data-placement="top" title="Request Review from Customer" href="javascript:void(0)" class="btn btn-primary adNew startfeedback blue"><i class="fa fa-star"></i> Add to Review Sequence</a>
										
										<!-- Quick Add Customer -->
										<a style="cursor:pointer;" class="btn adNew green" data-toggle="modal" data-target="#quick_add-model"><span data-toggle="tooltip" data-placement="top" title="Quick Add Customer"><i class="fa fa-plus-circle"></i> Quick Add Customer</span></a>              

										<div style="display:none;color:red;" id="notification"></div>
									
									</div>
								</div>
								
								<div class="col-md-6"> <!-- MORE BUTTONS -->
									
									
								</div>
								
							</div>
							
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="table-scrollable">
										<?php echo $this->element('customer_list')?>
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
</div> <!-- FINAL WRAPPER (V LEVEL) -->		
<script type="text/javascript">
  $(".searchbystart input:checkbox").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);

      } else {
        $box.prop("checked", false);
      }
      $('#searchbystar').submit();  
    });
</script>
<script type="text/javascript">
  var selected = new Array();
   $('document').ready(function(){
   $('.inputchk').click(function() {
   var id = $(this).val();
   var found = jQuery.inArray(id, selected);
   if (found >= 0) {
   selected.splice(found, 1);
    } else {
    selected.push(id);
    }
  });
         $('.startfeedback').click(function() { 
          if(selected.length == 0)
          {
            $('#notification').text('Please select any user to further proceed');
            $('#notification').show();
            $('#notification').delay(2000).fadeOut();
            return false;
          }
 $("#loading").show();
 $('#loading').append('<h2>Sending Emails...</h2>');
          $.ajax({                   
                url: ajax_url+'dashboard/startfeedback',
                cache: false,
                type: 'POST',
                //dataType: 'json',
                data: { id: selected },
                success: function (response) {
                  $("#loading").hide();
                 window.location.reload();
                }
              
            });
        
            return false;
        });
   });
 </script>
 <script type="text/javascript">
$(document).ready(function(){
    $('#manage-search').validate({
         rules:
            {
               "data[searchby][text]":
                {
                    required:true,
                }   
            },
         messages:
            {   
               "data[searchby][text]":
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
 opacity: 0.8;
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
</style>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>