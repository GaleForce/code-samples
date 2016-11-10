 

<script type="text/javascript">
$(document).ready(function(){
    $('#EmployeeAddForm').validate({
           onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
            	"data[BusinessEmployee][emp_name]":
                {
                    required:true
                },
                "data[BusinessEmployee][last_name]":
                {
                      required:true,
		                  accept: "[a-zA-Z]+",
                      minlength:5,
		                  maxlength: 20
                },
                "data[BusinessEmployee][agency_id]":
                {
                	required:true
                	 
                },
                "data[BusinessEmployee][business_id]":
                {
                   required:true
                },

               
                 
                
            },
            messages:
            {
            	 
                "data[BusinessEmployee][emp_name]":
                {
                    required:"Please enter the first name.",
		                accept :"Please enter only characters "
                    
			      	},
              "data[BusinessEmployee][last_name]":
              {
                required:"Please enter the last name."
              },
				     "data[BusinessEmployee][agency_id]":
              {
                required:"Please Select The Ageny Name"
              },
              "data[BusinessEmployee][business_id]":
              {
                 required:"Please Select The Business Name"
              }

            }
        
        
        });
        
    
    });
</script>

<div class="businesses container">

<div>/
 
<h1 class="business-heading">Add Business Employee<span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/employees">Go Back</a></span></h1>

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="EmployeeAddForm" action="<?php echo HTTP_ROOT?>admin/addNewEmployee/<?php echo $busid; ?>">
 

       <div class="form-group">
      <label class="control-label col-sm-4">Employee First Name:</label>
      <div class="col-sm-8">
        <input type="text" required="required" class="form-control form-back" id="CustomerFirstname" placeholder="Enter First Name" name="data[BusinessEmployee][emp_name]">
      </div>
    </div>


   <div class="form-group">
      <label class="control-label col-sm-4">Employee Last Name:</label>
      <div class="col-sm-8">
        <input type="text"  class="form-control form-back" id="CustomerLastname" placeholder="Enter Last Name" name="data[BusinessEmployee][last_name]">
      </div>
    </div>
 <div class="form-group">
       <label class="control-label col-sm-4" for="email">Select Agency</label>
           <div class="col-sm-8">
               <select class="form-selected" id="find_country_business" name="data[BusinessEmployee][user_id]">
                           <option value=""><?php echo "Select Agency"?></option>
                                  <?php foreach($agencyiesname as $key=>$val){?>
                                      <option value="<?php echo $key?>"><?php echo $val?></option>
                                  <?php } ?>
                  </select></div>
         </div>

<div class="form-group">
     <label class="control-label col-sm-4" for="email">Select Business</label>
      <div class="col-sm-8">
          <select class="form-selected" id="find_state_business" name="data[BusinessEmployee][business_id]">
                  <option value="">Select Business</option>
                </select></div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4">Is Active</label>
      <div class="col-sm-8">
        <input type="checkbox" class="form-control form-back" checked="checked" value="1" name="data[BusinessEmployee][status]">
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
                url: ajax_url+'Admin/findagencyBusiness',
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
    

  });
</script>


