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
                    remote:ajax_url+'users/validUserEmail'
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
                "data[AgencysiteSetting][agencyname]":
                {
                    required:"This field is required."
                },
                "data[User][firstname]":
                {
                    required:"This field is required."
                },
                "data[User][user_type]":
                {
                    required:"This field is required."
                },
                
            }
        
        
        });
        
    
    });
</script>
<div class="businesses container">

<h1 class="business-heading">Edit Business <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/agencyBusiness">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/edit_business">

   <input type="hidden" name="data[Business][id]" value="<?php echo $edit_bus['Business']['id'];?>" />
   <input type="hidden" name="data[Business][user_Id]" value="<?php echo $edit_bus['Business']['user_Id'];?>" />

    <div class="form-group">
     <label class="control-label col-sm-4" for="email">Agency Name:</label>
     <div class="col-sm-8">
        <select class="form-selected" required="required" name="data[Business][agency_id]">
          <option value=""><?php echo "Select agency name"?></option>
              <?php foreach($agency_list as $val){?>
                  <option <?php if($edit_bus['Business']['agency_id']==$val['User']['id']){?> selected="selected"<?php }?>value="<?php echo $val['User']['id']?>"><?php echo $val['User']['agencyname'];?></option>
              <?php } ?>
        </select></div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" >Business Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Business Name"name="data[Business][businessname]" value="<?php echo $edit_bus['Business']['businessname'];?>">
      </div>
    </div>

    <div class="form-group">
       <label class="control-label col-sm-4" for="email">Main Business Category:</label>
       <div class="col-sm-8">
         <select class="form-selected" required="required" id="BusinessBusinessCategoryId" name="data[Business][business_category_id]">
                <option value=""><?php echo "Select Bussiness Category"?></option>
                    <?php foreach($businessCategories as $key=>$val){?>
                        <option <?php if($edit_bus['Business']['business_category_id']==$key) {?>selected='selected' <?php } ?>value="<?php echo $key?>"><?php echo $val?></option>
                    <?php } ?>
        </select></br>
      </div>
    </div>


    <!--<div class="form-group">
      <label class="control-label col-sm-4" >Contact Person:</label>
      <div class="col-sm-8">
        <input type="text" name="data[User][firstname]" placeholder="Enter name" class="form-control form-back" value="<?php echo $edit_bus['User']['firstname'];?>">
      </div>
    </div> -->


     <div class="form-group">
      <label class="control-label col-sm-4" >Status:</label>
      <div class="col-sm-8">
       <input type="checkbox" name="data[User][status]"  <?php if($edit_bus['User']['status']==1){?>checked="checked"<?php } ?> value="1">
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
