<script type="text/javascript">
$(document).ready(function(){
	$('#ResetPassword').validate({
			rules:
			{
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

<div class="container">
   <div id="login-box" class="reseting">
      <img class="login-arrow" alt="Agency Login" src="/repmgsys//img/login-arrow.png">
      <h2>agency <b>Password</b></h2>
      <form accept-charset="utf-8" method="post" id="ResetPassword" action="<?php echo HTTP_ROOT?>users/resetPassword">
      <input type="hidden" name="data[User][key]" value="<?php echo @$data['key']?>">
       <div class="row">
         <div class="col-md-4">
            <label>New Password:</label>
         </div>
         <div class="col-md-8 loginfield">
            <div class="input password required">
            	<label for="UserPassword">New Password</label>
            	<input type="password" required="required" id="UserPassword" name="data[User][password]">
            </div>        
         </div>
      </div>
      <div class="row pushdown">
         <div class="col-md-4">
            <label>Confirm Password:</label>
         </div>
         <div class="col-md-8 loginfield">
            <div class="input cpassword required">
            	<label for="UserCpassword">Confirm Password</label>
            	<input type="password" required="required" id="cpassword" name="data[User][cpassword]">
            </div>         
          </div>
      </div>
      <div class="row loginbuttons">

		<div class="col-md-4"></div>
        <div class="col-md-8">
            <div class="input submit"><label for="UserSubmit">Submit</label><div class="submit"><input type="submit" value="submit" class="btn btn-primary reset-btn"></div></div>
        </div>
      </div>
   	</form>
   </div>
</div>