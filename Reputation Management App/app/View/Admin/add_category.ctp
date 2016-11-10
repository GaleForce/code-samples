<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                
                "data[BusinessCategory][name]":
                {
                    required:true
                },
               
                
            },
            messages:
            {
                "data[BusinessCategory][name]":
                {
                    required:"This field is required."
                },
               
            }
        
        
        });
        
    
    });
</script>
<div class="businesses container">

<h1 class="business-heading">Add New Category <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/category">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/add_category">

   
    <div class="form-group">
      <label class="control-label col-sm-4" >Category Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Category Name" name="data[BusinessCategory][name]">
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
