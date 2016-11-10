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
                    remote:ajax_url+"admin/checkUserEmail/<?php echo @$emp['User']['id'];?>"
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

<h1 class="business-heading">Edit Employee <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/employees">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/editEmployee">

   <input type="hidden" name="data[User][id]" value="<?php echo $emp['User']['id'] ?>"/>
   <input type="hidden" name="data[BusinessEmployee][id]" value="<?php echo $emp['BusinessEmployee']['id'] ?>"/>
    <div class="form-group">
      <label class="control-label col-sm-4" >First Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[User][firstname]" value="<?php echo $emp['User']['firstname'] ?>">
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
        <input type="text" value="<?php echo $emp['User']['lastname'] ?>" name="data[User][lastname]" placeholder="Enter Last name" class="form-control form-back">
   <input type="hidden" name="data[Business][id]" value="<?php echo @$emp['BusinessEmployee']['business_id'] ?>">      
</div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email"> Email Id:</label>
      <div class="col-sm-8">
        <input type="email" id="UserEmail" name="data[User][email]" value="<?php echo $emp['User']['email'] ?>" placeholder="Enter Email" class="form-control form-back">
      </div>
    </div>

     
     <div class="form-group">
         <label class="control-label col-sm-4">Select Agency:</label> 
         <div class="col-sm-8">
        <select class="form-selected" required="required" id="find_bus" name="data[Business][agency_id]">
              <option value=""><?php echo "Select Agency"?></option>
              <?php foreach ($agnc as $key => $value) { ?>
                   <option <?php if($emp['Business']['agency_id']==$value['User']['id']){?>selected="selected"<?php }?> value="<?php echo $value['User']['id']?>"><?php echo $value['User']['agencyname']?></option>
              <?php }?>
              
               
      </select>
            </div>
    </div>
    
     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Business Name:</label>
      <div class="col-sm-8">
         <select class="form-selected" required="required" id="agency_bus" name="data[BusinessEmployee][business_id]">
              <option value=""><?php echo "Select Agency"?></option>
              <?php foreach ($buss as $bussiness) { ?>
                   <option <?php if($bussiness['Business']['id']==$emp['BusinessEmployee']['business_id']){?>selected="selected"<?php }?> value="<?php echo $bussiness['Business']['id']?>"><?php echo $bussiness['Business']['businessname']?></option>
              <?php }?>
      </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" >Status:</label>
      <div class="col-sm-8">
        <input type="checkbox" name="data[User][status]" <?php if($emp['User']['status']==1){?>checked="checked"<?php }?>/>
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
                  options = '<option value="">Select Business</option>';
                  $.each(bus.html, function(index, bus) {
              options += '<option value="' + index + '">' + bus + '</option>';
          });
         // options1 = '<option value="0">Select City</option>';
          $('#agency_bus').html(options);
          //$('#find_city').html(options1);
                }
            });
            return false;
    });
</script>
