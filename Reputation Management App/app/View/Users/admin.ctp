<script type="text/javascript">
$(document).ready(function(){
   $('#UserLoginForm').validate({
         rules:
         {
            "data[User][email]":
            {
               required: 
                {
                    depends:function()
                    {
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
               email:true,
               remote:ajax_url+'users/checkUserEmail'
            },
            
            "data[User][password]":
            {
               required:true,
               minlength: 8
            }
         },
         messages:
         {
            "data[User][email]":
            {
               required:'Please enter email.',
               email:'Please enter valid email.',
               remote:'Email does not exists.'
            },
            "data[User][password]":
            {
               required:"This field is required.",
               minlength: 'Password should be atleast 8 characters long.'
            }
            
         }
      
      
      });
   });
</script>
<!-- BEGIN LOGIN FORM -->
  <?php echo $this->Form->create('User', array('url'=>array('controller'=>'users', 'action'=>'admin'))); ?>
    <h3 class="form-title">Admin Dashboard</h3>
    <div class="alert alert-danger display-hide">
      <button class="close" data-close="alert"></button>
      <span>
      Enter any username and password. </span>
    </div>
    <div class="form-group">
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Username</label>
      <?php echo $this->Form->input('email', array('type'=>'email','class' =>'form-control form-control-solid placeholder-no-fix')); ?>
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Password</label>
      <?php  echo $this->Form->input('password', array('type'=>'password' ,'class' =>'form-control form-control-solid placeholder-no-fix'));  ?>
    </div>
    <div class="form-actions">
    <div class="col-sm-6">
      <?php echo $this->Form->submit('login', array('type'=>'submit', 'class' =>'btn btn-success uppercase')); ?>
    </div>
    <div class="col-sm-6">
      <?php echo $this->Html->link(__('forgot password'), array('controller' => 'users','action' => 'forgot'), array('class' => 'btn explore-btn btn-warning forgot-password')); ?>
    </div>
    </div>

    <!-- <div class="create-account">
      <p>
        <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
      </p>
    </div> -->
  
<?php echo $this->Form->end(); ?>
