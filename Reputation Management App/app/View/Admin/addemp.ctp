<script type="text/javascript">
$(document).ready(function(){
 
    $('#BusinessAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[User][email]":
                {
                    required:true,
                    email:true,
                    remote:ajax_url+'admin/validUserEmail'
                },
                
                "data[User][password]":
                {
                    required:true,
                    minlength: 8
                },
               
                "data[User][firstname]":
                {
                    required:true,
                    accept: "[a-zA-Z]+",
                    maxlength:20
                },
                "data[User][lastname]":
                {
                    required:true,
                    accept: "[a-zA-Z]+",
                    maxlength:20
                },
                "data[BusinessEmployee][agency_id]":
                {
                    required:true,
                  
                },
	"data[User][cpassword]":
                {
                    required:true,
                    equalTo:'#pwd'
                },
                "data[BusinessEmployee][business_id]":
                {
                   required:true,
                  
                }
            },
            messages:
            {
                "data[User][email]":
                {
                    required:'Please enter email.',
                    email:'Please enter valid email.',
                    remote:'Email address already exists.'
                },
                "data[User][password]":
                {
                    required:"This field is required.",
                    minlength: 'Password should be atleast 8 characters long.'
                },
               
                "data[User][firstname]":
                {
                    required:"This field is required.",
                     accept :"Please enter only characters "
                },
                "data[User][lastname]":
                {
                    required:"This field is required.",
                   accept :"Please enter only characters "
                },
                "data[BusinessEmployee][agency_id]":
                {
                   required:"This field is required."
                  
                },
                "data[BusinessEmployee][business_id]":
                {
                   required:"This field is required."
                  
                }
            }
        
        
        });
        
        });
</script>

<div class="businesses container">

<h1 class="business-heading">Add New Employee <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/employees">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/addemp">

   
    <div class="form-group">
      <label class="control-label col-sm-4" >First Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[User][firstname]">
      </div>
    </div>


    <!-- <div class="form-group">
      <label class="control-label col-sm-4">Last Login:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Last Login" name="data[User][lastlogin]">
      </div>
    </div> -->


    <div class="form-group">
      <label class="control-label col-sm-4" > Last Name:</label>
      <div class="col-sm-8">
        <input type="text" name="data[User][lastname]" placeholder="Enter Last Name" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email"> Email Id:</label>
      <div class="col-sm-8">
        <input type="email" id="UserEmail" name="data[User][email]" placeholder="Enter Email Id" class="form-control form-back">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Password:</label>
      <div class="col-sm-8">
        <input type="password" class="field text full required form-control form-back" id="pwd"  placeholder="Enter Password" name="data[User][password]" required="required">
      </div>
    </div>

   <div class="form-group">
      <label class="control-label col-sm-4" for="email">Confirm Password:</label>
      <div class="col-sm-8">
        <input type="password" class="field text full required form-control form-back" id="UserPassword" placeholder="Enter Confirm Password" name="data[User][cpassword]">
      </div>
    </div>


    <div class="form-group">
         <label class="control-label col-sm-4">Select Agency:</label> 
         <div class="col-sm-8">
        <select class="form-selected" required="required" id="find_bus" name="data[BusinessEmployee][agency_id]">
              <option value=""><?php echo "Select Agency"?></option>
              <?php foreach ($agnc as $key => $value) { ?>
                   <option value="<?php echo $value['User']['id']?>"><?php echo $value['User']['agencyname']?></option>
              <?php }?>
              
               
      </select>
            </div>
    </div>
    
     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Business Name:</label>
      <div class="col-sm-8">
         <select class="form-selected" required="required" id="find_emp" name="data[BusinessEmployee][business_id]">
            <option value="">Select business name</option>
         </select></div>
    </div>
  
    <div class="form-group">
      <label class="control-label col-sm-4" >Status:</label>
      <div class="col-sm-8">
        <input type="checkbox" name="data[User][status]">
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
<script>
 $("#find_bus").change(function(){
      $.ajax({                   
                url: ajax_url+'admin/findBusiness',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (bus) {
                   var options = '';
                  options = '<option value="0">Select Business</option>';
                  $.each(bus.html, function(index, bus) {
              options += '<option value="' + index + '">' + bus + '</option>';
          });
         // options1 = '<option value="0">Select City</option>';
          $('#find_emp').html(options);
          //$('#find_city').html(options1);
                }
            });
            return false;
    });
</script>
