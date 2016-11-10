<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                
                "data[Business][businessname]":
                {
                    required:true
                },
                "data[User][firstname]":
                {
                    required:true
                },
                "data[Business][status]":
                {
                    required:true
                },
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
                "data[User][cpassword]":
                {
                    required:true,
                    equalTo:'#pwd'
                }
                
            },
            messages:
            {
                "data[Business][businessname]":
                {
                    required:"This field is required."
                },
                "data[User][firstname]":
                {
                    required:"This field is required."
                },
                "data[User][email]":
                {
                    required:'Please enter email.',
                    email:'Please enter valid email.',
                    remote:'Email address already exists.'
                },
                
            }
        
        
        });
        
    
    });
</script>
<div class="businesses container">

<h1 class="business-heading">Add New Business <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/agencyBusiness">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/add_business">

    <div class="form-group">
     <label class="control-label col-sm-4" for="email">Agency Name:</label>
     <div class="col-sm-8">
        <select class="form-selected" required="required" id="find_bus" name="data[Business][agency_id]">
          <option value=""><?php echo "Select agency name"?></option>
              <?php foreach($agency_list as $val){?>
                  <option value="<?php echo $val['User']['id']?>"><?php echo $val['User']['agencyname'];?></option>
              <?php } ?>
        </select></div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" >Business Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Business Name" name="data[Business][businessname]">
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


    <!--<div class="form-group">
      <label class="control-label col-sm-4" >Contact Person:</label>
      <div class="col-sm-8">
        <input type="text" name="data[User][firstname]" placeholder="Enter name" class="form-control form-back">
      </div>
    </div> -->

    <div class="form-group">
      <label class="control-label col-sm-4" >Email:</label>
      <div class="col-sm-8">
        <input type="email" name="data[User][email]" placeholder="Enter email address" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Password:</label>
      <div class="col-sm-8">
        <input type="password" id="pwd" name="data[User][password]" placeholder="Enter password" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Confirm Password:</label>
      <div class="col-sm-8">
        <input type="password" id="UserPassword" name="data[User][cpassword]" placeholder="Enter password" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Status:</label>
      <div class="col-sm-8">
       <input type="checkbox" name="data[User][status]" value="1">
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
