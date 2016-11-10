 

<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessUserAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[Business][agency_id]":
              {
                required:true
              },
            	"data[Business][businessname]":
                {
                    required:true
                },
                "data[User][firstname]":
                {
                    required:true,
		    accept: "[a-zA-Z]+",
		    maxlength: 20,	
                    minlength:5,
                    remote:ajax_url+'users/validate_first_name'
				},
                "data[Business][companywebaddress]":
                {
                    required:true,
                    email:true,
                    remote:ajax_url+'users/checkEmail_user'
                },

                "data[Business][phone]":
                {
                	required:true,
                    number:true
                },
                "data[Business][addressline1]":
                {
                   required:true
                },
                "data[Business][country]":
                {
                  required:true	
                },
                "data[Business][state]":
                {
                	required:true
                },
                 "data[Business][city]":
                {
                    required:true
                },
                "data[Business][zip]":
                {
                	required:true,
                	//remote:ajax_url+'users/validatZip'
                  number:true
                },
                "data[User][password]":
                {
                  required:true,
                  minlength: 6,
                  remote:ajax_url+'users/chk_password'
                },
		"data[User][cpassword]":
                {
                    required:true,
                    equalTo:'#pwd'
                },
                "data[Business][business_category_id]":
                {
                  required:true
                },

                
            },
            messages:
            {
            	 "data[Business][businessname]":
                {
                    required:"Please enter the business name."
                },
                "data[Business][agency_id]":
                {
                 required:"Please Select the Agency Name first." 
                }, 
                "data[User][firstname]":
                {
                    required:"Please enter the first name.",
		     accept :"Please enter only characters ",
                     remote:"Only alphabets."
				},
		"data[Business][companywebaddress]":
                {
                    required:"Please enter the company Email address",
                    email:"Please enter a valid email.",
                    remote:"This Web Address already exist."
                },
                "data[Business][phone]":
                {
                    required:"Please enter the Company Phone number",
                    number:"Please enter a valid number"
                },
                "data[Business][addressline1]":
                {
                    required:"Please enter the address"
                     
                },
                "data[Business][country]":
                {
                	required:"Please Select The country name"
                },
                "data[Business][state]":
                {
                  required:"Please Select The state Name"	
                },
                "data[Business][city]":
                {
                	required:"Please Enter the city name."
                },
                "data[Business][zip]":
                {
                 required:"Please enter the Zip code",
                 number:"Please enter numeric zip code"
                },
                "data[User][password]":
                {
                    required:"PLease enter the password.",
                    minlength: 'Password should be atleast 6 characters long.',
                    remote:"Enter alphaNumeric value"
                },
		"data[User][cpassword]":
                {
                    required:"Please enter the password",
                    equalTo:"Please enter the same password again."
                },
                "data[Business][business_category_id]":
                {
                   required:"Please select the main business category"
                },

            }
        
        
        });
        
    
    });
</script>

<div class="businesses container">
  <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>users/businessUserLogin">Go Back</a></span></h1>
<h1 class="business-heading">Register Business User Now</h1>

<div class="add-business">



<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessUserAddForm" action="<?php echo HTTP_ROOT?>users/registerBusinessUser">


    

 <div class="form-group">
     <label class="control-label col-sm-4" for="email">Agency Name:</label>
     <div class="col-sm-8">
        <select class="form-selected" required="required" id="find_bus" name="data[Business][agency_id]">
          <option value=""><?php echo "Select agency name"?></option>
              <?php foreach($agency_list as $key=>$val){?>
                  <option value="<?php echo $val['User']['id']?>"><?php echo $val['User']['agencyname'];?></option>
              <?php } ?>
        </select></div>
    </div>
    
    
     
  <div class="form-group">
      <label class="control-label col-sm-4" for="email">Business Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" required="required" id="BusinessName" placeholder="Enter Business Name" name="data[Business][businessname]">
      </div>
    </div>


 <div class="form-group">
       <label class="control-label col-sm-4" for="email">Main Business Category:</label>
         <div class="col-sm-8">
            <select class="form-selected" required="required" id="BusinessBusinessCategoryId" name="data[Business][business_category_id]">
                            <option value=""><?php echo "Select Bussiness Category"?></option>
                                <?php foreach($businessCategories as $key=>$val){?>
                                    <option value="<?php echo $key?>"><?php echo $val?></option>
                                <?php } ?>
                        </select></br>
                   </div>
                  </div>





    

   <div class="form-group">
      <label class="control-label col-sm-4">First Name:</label>
      <div class="col-sm-8">
        <input type="text" required="required" class="form-control form-back" id="UserFirstname" placeholder="Enter First Name" name="data[User][firstname]">
      </div>
    </div>



     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Company Email Address:</label>
      <div class="col-sm-8">
        <input type="text" class="field text full required form-control form-back" maxlength="100" id="BusinessCompanyemailaddress" placeholder="Enter Company Email Address" name="data[Business][companywebaddress]" required="required">
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Company Phone Number:</label>
      <div class="col-sm-8">
        <input type="tel" class="field text full required form-control form-back" maxlength="255" id="ComapanyPhone" placeholder="Enter Company Phone Number" name="data[Business][phone]" required="required">
      </div>
    </div>



     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Street Address:</label>
      	<div class="col-sm-8">

     <!--   <input type="text" class="field text full required form-control form-back" maxlength="255" id="BusinessAddressline" placeholder="Enter Street Address" name="data[Business][addressline1]" required="required"> -->
      	<textarea class="field text full required form-control form-back" maxlength="255" id="BusinessAddressline" placeholder="Enter Street Address" name="data[Business][addressline1]" required="required"></textarea>
	</div>
    </div>


 

 <div class="form-group">
       <label class="control-label col-sm-4" for="email">Country:</label>
           <div class="col-sm-8">
               <select class="form-selected" required="required" id="find_country_business" name="data[Business][country]">
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
    			<select class="form-selected" required="required" id="find_state_business" name="data[Business][state]">
                	<option value="">Select State</option>
                </select></div>
    </div>

 <div class="form-group">
	 <label class="control-label col-sm-4" for="email"> City:</label>
	 	<div class="col-sm-8">
      <input type="text" class="field text full required form-control form-back" placeholder="Enter City" name="data[Business][city]" required="required">
	   
</div>
</div>



 <div class="form-group">
      <label class="control-label col-sm-4" for="email">Zip:</label>
      <div class="col-sm-8">
        <input type="text" class="field text full required form-control form-back" maxlength="20" id="BusinessZip" placeholder="Enter zip" name="data[Business][zip]" required="required">
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
	    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
	    		<div class="col-sm-8 submitting"> 
	        <input type="submit" class="submit btn btn-primary" value="Create My account">
		 </div> 
		</div>

		</form>
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
                  options = '<option value="0">Select City</option>';
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

