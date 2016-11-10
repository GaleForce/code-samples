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
                    minlength:5,
                    maxlength: 20
                },
                "data[Customer][lastname]":
                {
                    required:true,
                    accept: "[a-zA-Z]+",
                },
                "data[Customer][email]":
                {
                    required:true,
                    email:true,
                   // remote:ajax_url+'admin/checkEmail_user'
                },
                "data[Customer][phonenumber]":
                {
                   // required:true
                   number:true
                },
		"data[Customer][business_id]":
                {
                   required:true
                },
		"data[Customer][employee_id]":
                {
                   required:true
                },
                "data[Customer][addressline1]":
                {
                    //required:true
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
                    required:true
                },
                "data[Customer][zip]":
                {
                    required:true,
                    minlength:5,
                    remote:ajax_url+'admin/validatZip'

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
                 "data[Customer][email]":
                {
                    required:'Please enter email.',
                    email:'Please enter valid email.',
                    remote:'Email address already exists.'
                },
	              	"data[Customer][business_id]":
                {
                    required:"This field is required.",
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
<div class="businesses container">

<h1 class="business-heading">Add New Customer <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/customer">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/add_customer">

   
    <div class="form-group">
      <label class="control-label col-sm-4" >First Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[Customer][firstname]">
      </div>
    </div>

   <div class="form-group">
      <label class="control-label col-sm-4" >Last Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Last Name" name="data[Customer][lastname]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" >Email:</label>
      <div class="col-sm-8">
        <input type="email" name="data[Customer][email]" placeholder="Enter email address" class="form-control form-back">
      </div>
    </div>
    
   
   <div class="form-group">
      <label class="control-label col-sm-4" for="email">I have permission to email this address</label>
      <div class="col-sm-8">
        <input type="checkbox" name="data[Customer][permission_to_email]">
      </div>
    </div>

  
  
  <div class="form-group">
      <label class="control-label col-sm-4" >Phone:</label>
      <div class="col-sm-8">
        <input type="text" name="data[Customer][phonenumber]" placeholder="Enter Phone number" class="form-control form-back">
      </div>
    </div>

   <div class="form-group">
     <label class="control-label col-sm-4" for="email">Agency Name:</label>
     <div class="col-sm-8">
        <select class="form-selected" required="required" id="find_bus" name="data[Customer][user_id]">
          <option value=""><?php echo "Select agency name"?></option>
              <?php foreach($agency_list as $val){?>
                  <option value="<?php echo $val['User']['id']?>"><?php echo $val['User']['agencyname'];?></option>
              <?php } ?>
        </select></div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Business Name:</label>
      <div class="col-sm-8">
         <select class="form-selected" required="required" id="find_emp" name="data[Customer][business_id]">
            <option value="">Select business name</option>
         </select></div>
    </div>

    <div class="form-group">
   <label class="control-label col-sm-4" for="email"> Employee Name:</label>
     <div class="col-sm-8">
       <select class="form-selected" required="required" id="employee" name="data[Customer][employee_id]">
        <option value="">Select employee name</option>
        </select></div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Add Line 1:</label>
      <div class="col-sm-8">
        <textarea name="data[Customer][addressline1]" placeholder="Enter address1" class="form-control form-back"></textarea>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" >Add Line 2:</label>
      <div class="col-sm-8">
        <textarea name="data[Customer][addressline2]" placeholder="Enter address2" class="form-control form-back"></textarea>
      </div>
    </div>


   
   <div class="form-group">
       <label class="control-label col-sm-4" for="email">Country:</label>
           <div class="col-sm-8">
               <select class="form-selected" required="required" id="find_country_admin" name="data[Customer][country_id]">
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
      <div class="col-sm-8">
         <select class="form-selected" required="required" id="find_state_admin" name="data[Customer][state_id]">
            <option value="">Select State</option>
         </select></div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >City:</label>
      <div class="col-sm-8">
        <input type="text" name="data[Customer][city_id]" placeholder="Enter city" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Zip:</label>
      <div class="col-sm-8">
        <input type="text" name="data[Customer][zip]" placeholder="Enter zip" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Added to Review Sequence</label>
      <div class="col-sm-8">
        <input type="checkbox" name="data[Customer][preview]" value="1">
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
<SCRIPT TYPE="text/javascript">
$(document).ready(function(){
    $("#find_country_admin").change(function(){
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
          options1 = '<option value="0">Select City</option>';
          $('#find_state_admin').html(options);
          $('#find_city_admin').html(options1);
                }
            });
            return false;
    });
    $("#find_state_admin").change(function(){
      $.ajax({                   
                url: ajax_url+'admin/findCity',
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
          $('#find_city_admin').html(options);
                }
            });
            return false;   
        });

  });
</SCRIPT>
