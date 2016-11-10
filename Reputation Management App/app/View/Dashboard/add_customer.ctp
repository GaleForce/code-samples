 <script type="text/javascript">
$(document).ready(function(){
    $('#CustomerAddForm').validate({
           onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
            	"data[Customer][employee_id]":
                {
                   // required:false
                },
                "data[Customer][firstname]":
                {
                    required:true,
		    accept: "[a-zA-Z]+",
                    minlength:1,
		    maxlength: 20
                    //remote:ajax_url+'users/validate_first_name'
				        },
                "data[Customer][lastname]":
                {
                   // required:true,
                   // minlength:5,
                    //remote:ajax_url+'users/validate_first_name'
                },


                "data[Customer][email]":
                {
                    required:true,
                    email:true,
                   // remote:ajax_url+'dashboard/checkEmail_user'
                },

                "data[Customer][phonenumber]":
                {
                	//required:true,
                    number:true
                },
                "data[Customer][addresslin1]":
                {
                   //required:true
                },
                "data[Customer][country_id]":
                {
                  //required:true	
                },
                "data[Customer][state_id]":
                {
                	required:true
                },
                 "data[Customer][city_id]":
                {
                    required:true
                },
                "data[Customer][zip]":
                {
                	required:true,
                        minlength: 5,
                	remote:ajax_url+'dashboard/Zip'
                },
                "data[Customer][notes]":
                {
                	//required:true
                   
                },
                 
                
            },
            messages:
            {
            	 "data[Customer][employee_id]":
                {
                    //required:"Please Select the employee name."
                },
                "data[Customer][firstname]":
                {
                    required:"Please enter the first name.",
		    accept :"Please enter only characters "
                    //minlength: 'First Name should be atleast 5 characters long.',
                    //remote:"Only alphabets."
			      	},
              "data[Customer][lastname]":
              {
               // required:"Please enter the last name."
              },
				    "data[Customer][email]":
                {
                    required:"Please enter the company Email address",
                    email:"Please enter a valid email.",
                    //remote:"This Email already exist."
                },
                "data[Customer][phonenumber]":
                {
                    //required:"Please enter the Phone number",
                    number:"Please enter a valid number"
                },
                "data[Customer][addresslin1]":
                {
                    //required:"Please enter the address"
                     
                },
                "data[Customer][country_id]":
                {
                	required:"Please Select The country name"
                },
                "data[Customer][state_id]":
                {
                  required:"Please Select The state Name"	
                },
                "data[Customer][city_id]":
                {
                	required:"Please Enter the city name."
                },
                "data[Customer][zip]":
                {
                required:"Please enter the Zip code",
                remote :"Please enter Either numeric or alphanumeric Zip Code"
                },
                 
                "data[Customer][notes]":
                {
                   //required:"Please write some information here"
                },

            }
        
        
        });
        
    
    });
</script>
<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<?php echo $this->Session->flash(); ?>
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
		   <?php echo $this->Session->flash(); ?>  
		  <h3 class="page-title">
		  <?php echo $this->element('welcome')?> - Add Customer
		  </h3>
		  <div class="page-bar">
			<ul class="page-breadcrumb">
			  <li>
				<i class="fa fa-home"></i>
				<a href="<?php echo HTTP_ROOT?>">Home</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="<?php echo HTTP_ROOT?>">Contact Manager</a>
				<i class="fa fa-angle-right"></i>
			  </li>
			  <li>
				<a href="<?php echo HTTP_ROOT?>">Add Customer</a>
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
							<i class="fa fa-user"></i>Add Customer
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
							
							  <div class="col-sm-12">
								<span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>dashboard/contactManager/<?php echo $busid ?>">Go Back</a></span>
							  </div>
											
							</div>
						  </div>
						  <!-- TOOLBAR END (PORT) -->
						  
							<div class="row">
								<div class="col-md-12">
									<!-- PORTLET MAIN CONTENT -->
									<div class="">
										
										<form class="form-horizontal"  accept-charset="utf-8" method="post" id="CustomerAddForm" action="<?php echo HTTP_ROOT?>dashboard/addCustomer/<?php echo $busid; ?>">
										 <div class="form-group">
											   <label class="control-label col-sm-4" for="email">Employee:</label>
												 <div class="col-sm-6">
													<select class="form-selected form-control" id="CustomerEmployee" name="data[Customer][employee_id]">
																	<option value=""><?php echo "Select Business Employee Name"?></option>
																		<?php foreach($emps as $key=>$val){?>
																			<option value="<?php echo @$val['BusinessEmployee']['id']?>"><?php echo @$val['BusinessEmployee']['emp_name']?></option>
																		<?php } ?>
																</select></br>
														   </div>
														  </div>

											   <div class="form-group">
											  <label class="control-label col-sm-4">Customer First Name:</label>
											  <div class="col-sm-6">
												<input type="text" required="required" class="form-control form-back" id="CustomerFirstname" placeholder="Enter First Name" name="data[Customer][firstname]">
											  </div>
											</div>


										   <div class="form-group">
											  <label class="control-label col-sm-4">Customer Last Name:</label>
											  <div class="col-sm-6">
												<input type="text"  class="form-control form-back" id="CustomerLastname" placeholder="Enter Last Name" name="data[Customer][lastname]">
											  </div>
											</div>

										 


											 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Customer Email Address:</label>
											  <div class="col-sm-6">
											   <!-- <input type="text" class="field text full required form-control form-back" maxlength="100" id="Customeremailaddress" placeholder="Enter Customer Email Address" name="data[Customer][email]" required="required"> -->
												<textarea class="field text full required form-control form-back" maxlength="100" id="Customeremailaddress" placeholder="Enter Customer Email Address" name="data[Customer][email]" required="required"></textarea>
											  </div>
											</div>
										   <div class="form-group">
											  <label class="control-label col-sm-4" for="email">I have permission to email this address</label>
											  <div class="col-sm-6">
												<input type="checkbox" name="data[Customer][permission_to_email]">
											  </div>
											</div>
											



										 
											<div class="form-group">
											  <label class="control-label col-sm-4">Cell Phone:</label>
											  <div class="col-sm-6">
												<input type="tel" class="field text full form-control form-back" maxlength="255" id="CustomerPhone" placeholder="Enter Phone Number" name="data[Customer][phonenumber]" >
											  </div>
											</div>



											 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Address:</label>
												<div class="col-sm-6">
												<input type="text" class="field text full form-control form-back" maxlength="255" id="CustomerAddress" placeholder="Enter Address" name="data[Customer][addressline1]">
											  </div>
											</div>



										  
										 <div class="form-group">
											   <label class="control-label col-sm-4" for="email">Country:</label>
												   <div class="col-sm-6">
													   <select class="form-selected form-control" id="find_country_business" name="data[Customer][country_id]">
																   <option value=""><?php echo "Select Country"?></option>
																	<option value="<?php echo 1 ?>"><?php echo $countries[1] ?></option>
																   <?php
																		foreach($countries as $key=>$val){
																		  if($key == 1) { continue; }
																			?>
																			  <option value="<?php echo $key?>"><?php echo $val?></option>
																		  <?php } ?>
														  </select></div>
												 </div>




										 <div class="form-group">
											 <label class="control-label col-sm-4" for="email">State/Province:</label>
											  <div class="col-sm-6">
												  <select class="form-selected form-control" id="find_state_business" name="data[Customer][state_id]">
														  <option value="">Select State</option>
														</select></div>
											</div>
										 
										 <div class="form-group">
										   <label class="control-label col-sm-4" for="email"> City:</label>
											<div class="col-sm-6">
											 
											  <input type="text" class="field text full form-control form-back" placeholder="Enter City" name="data[Customer][city_id]" >
										</div> 
										</div> 

										 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Zip:</label>
											  <div class="col-sm-6">
												<input type="text" class="field text full form-control form-back" maxlength="20" id="BusinessZip" placeholder="Enter zip" name="data[Customer][zip]" >
											  </div>
											</div>
											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Added to Review Sequence</label>
											  <div class="col-sm-6">
												<input type="checkbox" name="data[Customer][preview]" value="1">
											  </div>
											</div>
											
										   
										  <div class="form-group">
											  <label class="control-label col-sm-4" for="email">My notes</label>
											  <div class="col-sm-6">
												<textarea class="field text full form-control form-back" id="pwd" name="data[Customer][notes]"></textarea>
											  </div>
											</div>


												 <div class="form-group">
													<label class="control-label col-sm-4" for="email">&nbsp;</label>  
														<div class="col-sm-8 submitting"> 
													<input type="submit" class="submit btn btn-primary" value="Add Customer">
												 </div> 
												</div>

												</form>
										
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
    $("#find_country_business").change(function(){
          $.ajax({                   
                url: ajax_url+'users/findState',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (states) {
                  var options = '';
                  options = '<option value="">Select State</option>';
                  $.each(states.html, function(index, states) {
              options += '<option value="' + index + '">' + states + '</option>';
          });
          options1 = '<option value="">Select City</option>';
          $('#find_state_business').html(options);
          $('#find_city_business').html(options1);
                }
            });
            return false;
    });
    $("#find_state_business").change(function(){
      $.ajax({                   
                url: ajax_url+'users/findCity',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (states) {
                  var options = '';
                  options = '<option value="">Select City</option>';
                  $.each(states.html, function(index, cities) {
              options += '<option value="' + index + '">' + cities + '</option>';
          });
          $('#find_city_business').html(options);
                }
            });
            return false;   
        });

  });
</script>


