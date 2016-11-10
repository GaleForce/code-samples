<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                
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
                },
                 "data[agency][agencyname]":
                {
                  required:true
                },
                
            },
            messages:
            {
                "data[User][firstname]":
                {
                    required:"Please Enter The First Name",
                     accept :"Please enter only characters "
                },
                 "data[User][email]":
                {
                    required:'Please enter email.',
                    email:'Please enter valid email.',
                    remote:'Email address already exists.'
                },
                "data[User][lastname]":
                {
                     required:"Please Enter The Last Name",
                     accept :"Please enter only characters "
                },
               "data[agency][agencyname]":
                {
                  required:"Please Enter The Agency Name"
                },
                
                
            }
        
        
        });
        
    
    }); 
</script> 

<div class="businesses container">

<h1 class="business-heading">Add New Agency <span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>admin/index">Go Back</a></span></h1>

<div class="add-business">

<div class="main-form-start">
<form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>admin/add">

   
   <div class="form-group">
      <label class="control-label col-sm-4" >First Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[User][firstname]">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Last Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Last Name" name="data[User][lastname]">
      </div>
    </div>

 <div class="form-group">
      <label class="control-label col-sm-4" >Agency Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-back" placeholder="Enter Agency Name" name="data[agency][agencyname]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" >Email:</label>
      <div class="col-sm-8">
        <input type="email" name="data[User][email]" placeholder="Enter email" class="form-control form-back">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Password:</label>
      <div class="col-sm-8">
        <input type="password" class="field text full required form-control form-back" id="pwd"  placeholder="Enter Password" name="data[User][password]">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" for="email">Confirm Password:</label>
      <div class="col-sm-8">
        <input type="password" class="field text full required form-control form-back" id="UserPassword" placeholder="Enter Confirm Password" name="data[User][cpassword]">
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
