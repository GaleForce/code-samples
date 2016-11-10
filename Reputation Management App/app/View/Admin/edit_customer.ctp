<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                
                "data[Customer][firstname]":
                {
                    required:true,
                    accept: "[a-zA-Z]+",
                   // minlength:5,
                    maxlength: 20
                },
                "data[Customer][lastname]":
                {
                    required:true,
		    accept: "[a-zA-Z]+",
		    maxlength: 20
                },
                "data[Customer][email]":
                {
                    required:true,
                    email:true
                    //remote:ajax_url+'admin/validUserEmail'
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
                "data[Customer][addressline2]":
                {
                    //required:true
                },
                "data[Customer][country_id]":
                {
                    required:true
                },
                "data[Customer][state_id]":
                {
                    required:true
                },
                "data[Customer][city]":
                {
                    required:true,
		    accept: "[a-zA-Z]+"
                },
                "data[Customer][zip]":
                {
                    required:true,
                    minlength:5,
		    number:true
                   // remote:ajax_url+'admin/validatZip'
                },
                
            },
            messages:
            {
                "data[Customer][firstname]":
                {
                    required:"This field is required.",
                    accept:"Please enter only characters."
                },
		"data[Customer][lastname]":
                {
                    required:"This field is required.",
                    accept:"Please enter only characters."
                },
		"data[Customer][city]":
                {
                    required:'This is required field.',
                    accept :"Please enter only characters "
                },
                "data[Customer][zip]":
               {
                    required:"This field is required.",
                    remote :"Please enter Either numeric or alphanumeric Zip Code"
               },
                
            }
        
        
        });
        
    
    });
</script>
 

<div class="businesses container">

<h1 class="business-heading">Edit Customer <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/customer">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/edit_customer">

    <input type="hidden" name="data[Customer][id]" value="<?php echo $edit_cus['Customer']['id']?>" />
   
    <div class="form-group">
      <label class="control-label col-sm-4" >First Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[Customer][firstname]" value="<?php echo $edit_cus['Customer']['firstname']?>">
      </div>
    </div>

   <div class="form-group">
      <label class="control-label col-sm-4" >Last Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Last Name" name="data[Customer][lastname]" value="<?php echo $edit_cus['Customer']['lastname']?>">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" >Email:</label>
      <div class="col-sm-8">
        <input type="email" name="data[Customer][email]" placeholder="Enter email address" class="form-control form-back" value="<?php echo $edit_cus['Customer']['email']?>" >
      </div>
    </div>

      <div class="form-group">
      <label class="control-label col-sm-4" for="email">I have permission to email this address</label>
      <div class="col-sm-8">
        <input type="checkbox" name="data[Customer][permission_to_email]" 
        <?php if(($edit_cus['Customer']['permission_to_email'] == 1) && ($edit_cus['Customer']['preview'] == 1)) { ?> checked disabled="disabled"<?php } ?> >
       </div>
    </div>




  <div class="form-group">
      <label class="control-label col-sm-4" >Phone:</label>
      <div class="col-sm-8">
        <input type="text" name="data[Customer][phonenumber]" placeholder="Enter Phone number" class="form-control form-back" value="<?php echo $edit_cus['Customer']['phonenumber']?>">
      </div>
    </div>

   <div class="form-group">
     <label class="control-label col-sm-4" for="email">Agency Name:</label>
     <div class="col-sm-8">
        <select class="form-selected" required="required" id="find_bus" name="data[Customer][user_id]">
          <option value=""><?php echo "Select agency name"?></option>
              <?php foreach($agency_list as $key=>$val){?>
                  <option <?php if($edit_cus['Business']['agency_id']==$val['User']['id']){?> selected="selected"<?php }?>value="<?php echo $val['User']['id']?>"><?php echo $val['User']['agencyname'];?></option>
              <?php } ?>
        </select></div>
    </div>
    
      <div class="form-group">
      <label class="control-label col-sm-4" for="email">Business Name:</label>
      <div class="col-sm-8">
         <select class="form-selected" required="required" id="find_emp" name="data[Customer][business_id]">
          <option value="">Select business name</option>
           <?php foreach($bus_list as $key=>$val){?>
                  <option <?php if($edit_cus['Customer']['business_id']==$val['Business']['id']){?> selected="selected"<?php }?>value="<?php echo $val['Business']['id']?>"><?php echo $val['Business']['businessname'];?></option>
              <?php } ?>
         </select></div>
    </div>

     <div class="form-group">
   <label class="control-label col-sm-4" for="email"> Employee Name:</label>
     <div class="col-sm-8">
       <select class="form-selected" required="required" id="employee" name="data[Customer][employee_id]">
        <option value="">Select employee name</option>
        <?php foreach($emp_list as $key=>$val){?>
                  <option <?php if($edit_cus['Customer']['employee_id']==$val['BusinessEmployee']['id']){?> selected="selected"<?php }?>value="<?php echo $val['BusinessEmployee']['id']?>"><?php echo $val['BusinessEmployee']['emp_name'];?></option>
              <?php } ?>
        </select></div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Add Line 1:</label>
      <div class="col-sm-8">
        <textarea name="data[Customer][addressline1]" placeholder="Enter address1" class="form-control form-back"><?php echo $edit_cus['Customer']['addressline1']?></textarea>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" >Add Line 2:</label>
      <div class="col-sm-8">
        <textarea name="data[Customer][addressline2]" placeholder="Enter address2" class="form-control form-back"><?php echo $edit_cus['Customer']['addressline1']?></textarea>
      </div>
    </div>

    

   <div class="form-group">
       <label class="control-label col-sm-4">Country:</label> 
        	<div class="col-sm-8">
	   			 <select class="form-selected" required="required" id="find_country_customer" name="data[Customer][country_id]">
					<option value=""><?php echo "Select Country"?></option>
                     <?php
                     if($edit_cus['Customer']['country_id']== 1)
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





								<?php foreach($countries as $key=>$val){?>
								    <option <?php if($edit_cus['Customer']['country_id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
								<?php } ?>
				</select>
        </div>
    </div>

 
   <div class="form-group">
	       <label class="control-label col-sm-4">State/Province:</label> 
	        <div class="col-sm-8">
				<select class="form-selected" required="required" id="find_state_customer" name="data[Customer][state_id]">
							<option value="">Select State</option>
							<?php foreach($states as $key=>$val){?>
									    <option <?php if($edit_cus['Customer']['state_id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
							<?php } ?>
						</select>
	    		 </div>
	    </div>



 
    <div class="form-group">
      <label class="control-label col-sm-4" >City:</label>
      <div class="col-sm-8">
        <input type="text" name="data[Customer][city_id]" placeholder="Enter city" class="form-control form-back" value="<?php echo $edit_cus['Customer']['city_id']?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Zip:</label>
      <div class="col-sm-8">
        <input type="text" name="data[Customer][zip]" placeholder="Enter zip" class="form-control form-back" value="<?php echo $edit_cus['Customer']['zip']?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Added to Review Sequence</label>
      <div class="col-sm-8">
        
        <input type="checkbox" name="data[Customer][preview]" value="1" 
        <?php if(($edit_cus['Customer']['permission_to_email'] == 1) && ($edit_cus['Customer']['preview'] == 1)) { ?> checked disabled="disabled"<?php } ?> >
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">&nbsp;</label>  
      <div class="col-sm-8 submitting"> 
        <input type="submit" class="submit btn btn-primary" value="Submit">
     </div> 
    </div>


 
</form>
</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#find_country_customer").change(function(){
          $.ajax({                   
                url: ajax_url+'admin/findState',
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
          $('#find_state_customer').html(options);
           
                }
            });
            return false;
    
  });
  });
</script>

<script type="text/javascript">
 $(document).ready(function(){
   $("#find_bus").change(function(){
      $.ajax({                   
                url: ajax_url+'admin/findBusiness',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (bus) {
                   var options = '';
                  options = '<option value="">Select Business</option>';
                  $.each(bus.html, function(index, bus) {
              options += '<option value="' + index + '">' + bus + '</option>';
          });
           $('#find_emp').html(options);
           $('#employee').html('');
                }
            });
            return false;
    });

    $("#find_emp").change(function(){
      $.ajax({                   
                url: ajax_url+'admin/findEmployee',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (emp) {
                  var options = '';
                  options = '<option value="">Select Employee</option>';
                  $.each(emp.html, function(index, emp) {
              options += '<option value="' + index + '">' + emp + '</option>';
          });
          $('#employee').html(options);
                }
            });
            return false;   
        });

 });
</script>
