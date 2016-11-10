<div class="main-change-password">
    <form accept-charset="utf-8" class="form-horizontal" method="post" id="changepass" action="<?php echo HTTP_ROOT?>dashboard/businessUserChangePassword/<?php echo $busid; ?>">
        <h1 class="account-heading">Change Password</h1>
        <div class="form-group">
        <label class="control-label col-sm-4" for="email">Cuurent Password:</label>
        <div class="col-sm-4">
        <input class="form-control account-back" type="password" id="oldpass" name="data[User][oldpass]">
        </div>
        </div>


        <div class="form-group">
        <label class="control-label col-sm-4" for="email">New Password:</label>
        <div class="col-sm-4">
        <input class="form-control account-back" type="password" required="required" id="UserPassword" name="data[User][password]">
        </div>
        </div>

        <div class="form-group">
        <label class="control-label col-sm-4" for="email">Confirm Password:</label>
        <div class="col-sm-4">
        <input class="form-control account-back" type="password" required="required" id="cpass" name="data[User][cpassword]">
        </div>
        </div>

        <div class="form-group">
        <label class="control-label col-sm-6" for="email">&nbsp;</label>
        <div class="col-sm-6 submitting">
        <input type="submit" class="submit btn btn-primary" value="Submit">
        </div>
        </div>

    </form>    
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#changepass').validate({
        onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[User][oldpass]":
                {
                    required:true,
                    //remote:ajax_url+'dashboard/checkValidPass'
                  
                },
                "data[User][password]":
                {
                    required:true,
                    minlength: 8
                },
                "data[User][cpassword]":
                {
                    required:true,
                    equalTo:'#UserPassword'
                }
            },
            messages:
            {
                "data[User][oldpass]":
                {
                    required:'Please enter current password.',
                    //remote:'Please enter valid current password'
                    
                },
                "data[User][password]":
                {
                    required:"This field is required.",
                    minlength: 'Password should be atleast 8 characters long.'
                },
                "data[User][cpassword]":
                {
                    required:"This field is required.",
                    equalTo:'Password and confirm password does not match.'
                }
            }
        
        
        });
        


});

</script>