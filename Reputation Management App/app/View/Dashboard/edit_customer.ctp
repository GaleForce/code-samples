  


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
                    required:true
                },
                "data[Customer][firstname]":
                {
                    required:true,
		    accept: "[a-zA-Z]+",
                    //minlength:5,
		    maxlength:20
                    //remote:ajax_url+'users/validate_first_name'
				        },
                "data[Customer][lastname]":
                {
                    required:true,
		    accept: "[a-zA-Z]+",
                    //minlength:5,
		    maxlength:20
                    //remote:ajax_url+'users/validate_first_name'
                },


                "data[Customer][email]":
                {
                    required:true,
                    email:true
                   //remote:ajax_url+'dashboard/checkEmail_user_edit'
                },

                "data[Customer][phonenumber]":
                {
                    required:true,
                    number:true
                },
                "data[Customer][addressline1]":
                {
                   required:true
                },
                "data[Customer][country_id]":
                {
                   required:true	
                },
                "data[Customer][state_id]":
                {
                   required:true
                },
                 "data[Customer][city_id]":
                {
                   required:true,
		   accept: "[a-zA-Z]+"
                },
                "data[Customer][zip]":
                {
                	required:true,
                        minlength: 5,
                	number:true
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
                    required:"Please Select the employee name."
                },
                "data[Customer][firstname]":
                {
                    required:"Please enter the first name.",
		    accept :"Please enter only characters "
                    //remote:"Only alphabets."
			      	},
              "data[Customer][lastname]":
              {
               	    required:"Please enter the first name.",
		    accept :"Please enter only characters "
              },
                "data[Customer][email]":
                {
                    required:"Please enter the company Email address",
                    email:"Please enter a valid email."
                    //remote:"This Email already exist."
                },
                "data[Customer][phonenumber]":
                {
                    required:"Please enter the Phone number",
                    number:"Please enter a valid number"
                },
                "data[Customer][addressline1]":
                {
                    required:"Please enter the address"
                     
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
                     required:"Please Enter the city name.",
		     accept :"Please enter only characters "
                },
                "data[Customer][zip]":
                {
                     required:"Please enter the Zip code",
               	 //    remote :"Please enter Either numeric or alphanumeric Zip Code"
		     number:"Please enter a valid number"
                },
                 
                "data[Customer][notes]":
                {
                  // required:"Please write some information here"
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
		  <?php echo $this->element('welcome')?> - Edit Customer
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
				<i class="fa fa-angle-right"></i>
			  </li>
			   <li>
				<a href="#">Edit Customer</a>
			  </li>
			</ul>
			<div class="page-toolbar">
			  
			</div>
		  </div>
		  <!-- END PAGE HEADER-->
        
			
			<div class="row"> <!-- ROW & COL FOR LAYOUT -->
				<div class="col-sm-12">
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
							<i class="fa fa-user"></i>Edit Customer
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
										
										
										<form class="form-horizontal"  accept-charset="utf-8" method="post" id="CustomerAddForm" action="<?php echo HTTP_ROOT?>dashboard/editCustomer<?php echo $busid ?>">
										 <div class="form-group">
											   <label class="control-label col-sm-4" for="email">Employee:</label>
											   <input type="hidden" name="data[Customer][id]" value="<?php echo $info['Customer']['id']; ?>">
											   <input type="hidden" name="data[Customer][business_id]" value="<?php echo $info['Customer']['business_id']; ?>" />
											 <div class="col-sm-4">
													<select class="form-selected form-control" id="CustomerEmployee" name="data[Customer][employee_id]">
																	<option value=""><?php echo "Select Business Employee Name"?></option>
																		<?php

																		foreach($employee as $key=>$val){?>
																			<option <?php if($val['BusinessEmployee']['id']==$info['Customer']['employee_id']){?>selected="selected" <?php }?> value="<?php echo $val['BusinessEmployee']['id']?>"><?php echo $val['BusinessEmployee']['emp_name']?></option>
																		<?php } ?>
																</select></br>
														   </div>
														  </div>

											   <div class="form-group">
											  <label class="control-label col-sm-4">Customer First Name:</label>
											  <div class="col-sm-4">
												<input type="text" required="required" class="form-control form-back" id="CustomerFirstname" placeholder="Enter First Name" name="data[Customer][firstname]" value="<?php echo $info['Customer']['firstname']; ?>">
											  </div>
											</div>


										   <div class="form-group">
											  <label class="control-label col-sm-4">Customer Last Name:</label>
											  <div class="col-sm-4">
												<input type="text"   class="form-control form-back" id="CustomerLastname" placeholder="Enter Last Name" name="data[Customer][lastname]" value="<?php echo $info['Customer']['lastname']; ?>">
											  </div>
											</div>

										 


											 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Customer Email Address:</label>
											  <div class="col-sm-4">
												<input type="text" class="field text full required form-control form-back" readonly="readonly" maxlength="100" id="Customeremailaddress" placeholder="Enter Customer Email Address" name="data[Customer][email]" required="required" value="<?php echo $info['Customer']['email']; ?>">
											  </div>
											</div>
										   
										   <div class="form-group">
											  <label class="control-label col-sm-4" for="email">I have permission to email this address</label>
											  <div class="col-sm-4">
												<input type="checkbox" name="data[Customer][permission_to_email]" 
												<?php if(($info['Customer']['permission_to_email'] == 1) && ($info['Customer']['preview'] == 1)) { ?> checked disabled="disabled"<?php } ?> >
											   </div>
											</div>
											



										 
											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Cell Phone:</label>
											  <div class="col-sm-4">
												<input type="tel" class="field text full form-control form-back" maxlength="255" id="CustomerPhone" placeholder="Enter Phone Number" name="data[Customer][phonenumber]" value="<?php echo $info['Customer']['phonenumber'] ?>">
											  </div>
											</div>



											 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Address:</label>
												<div class="col-sm-4">
											  <!--  <input type="text" class="field text full form-control form-back" maxlength="255" id="CustomerAddress" placeholder="Enter Address" name="data[Customer][addressline1]"   value="<?php echo $info['Customer']['addressline1'] ?>"> -->
											 <textarea  class="field text full form-control form-back" maxlength="255" id="CustomerAddress" placeholder="Enter Address" name="data[Customer][addressline1]" ><?php echo @$info['Customer']['addressline1'] ?></textarea>
												</div>
											</div>



										  

										  <div class="form-group">
											   <label class="control-label col-sm-4">Country:</label> 
												  <div class="col-sm-4">
												  <select class="form-selected form-control" id="find_country" name="data[Customer][country_id]">
												  <option value=""><?php echo "Select Country"?></option>
										  <?php
															 if($info['Country']['id'] == 1)
															 {
																
															 ?>
															  <option value="<?php echo 1 ?>" selected="selected"><?php echo $countries[1] ?></option>
															 <?php
															 unset($countries[1]);
															  }
															  else
															  {
															 ?>
															 <option value="<?php echo 1 ?>"><?php echo $countries[1] ?></option>
															 <?php
															 unset($countries[1]);
															}
														 ?>
														<?php foreach($countries as $key=>$val) {?>
															<option <?php if($info['Country']['id']==$key){?>selected="selected"<?php }?> value=<?php echo $key?>><?php echo $val?></option>
														<?php } ?>
												</select>
												</div>
											</div>

										   <div class="form-group">
												 <label class="control-label col-sm-4">State/Province:</label> 
												  <div class="col-sm-4">
												<select class="form-selected form-control" id="find_state" name="data[Customer][state_id]">
													  <option value="">Select State</option>
													  <?php foreach($states as $key=>$val){?>
															  <option <?php if($info['State']['id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
													  <?php } ?>
													</select>
												   </div>
											  </div>
										   <div class="form-group">
											 <label class="control-label col-sm-4">City:</label> 
											  <div class="col-sm-4">
											   
											   <input type="text"   class="form-control form-back" placeholder="Enter City Name" name="data[Customer][city_id]" value="<?php echo $info['Customer']['city_id']; ?>">

											 </div>
											  </div>



										 <div class="form-group">
											  <label class="control-label col-sm-4" for="email">Zip:</label>
											  <div class="col-sm-4">
												<input type="text" class="field text full form-control form-back" maxlength="20" id="BusinessZip" placeholder="Enter zip" name="data[Customer][zip]"   value="<?php echo $info['Customer']['zip'] ?>">
											  </div>
											</div>
											<div class="form-group">
											  <label class="control-label col-sm-4" for="email">Added to Review Sequence</label>
											  <div class="col-sm-4">
												
												<input type="checkbox" name="data[Customer][preview]" value="1" 
												<?php if(($info['Customer']['permission_to_email'] == 1) && ($info['Customer']['preview'] == 1)) { ?> checked disabled="disabled"<?php } ?> >
											  </div>
											</div>
											
										   
										  <div class="form-group">
											  <label class="control-label col-sm-4" for="email">My notes</label>
											  <div class="col-sm-4">
												<textarea class="field text full form-control form-back" name="data[Customer][notes]"><?php echo @$info['Customer']['notes'] ?></textarea>
											  </div>
											</div>


												 <div class="form-group">
													<label class="control-label col-sm-4" for="email">&nbsp;</label>  
														<div class="col-sm-4 submitting"> 
													<input type="submit" class="submit btn btn-primary" value="Update My account">
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
                  options = '<option value="0">Select State</option>';
                  $.each(states.html, function(index, states) {
              options += '<option value="' + index + '">' + states + '</option>';
          });
          options1 = '<option value="0">Select City</option>';
          $('#find_state_business').html(options);
           
                }
            });
            return false;
    
  });
  });
</script>