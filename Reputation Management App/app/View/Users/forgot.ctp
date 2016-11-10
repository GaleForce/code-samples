<script type="text/javascript">
$(document).ready(function(){

   $('#UserForgotForm').validate({
       onfocusout: function (element) {
             $(element).valid();
            },
         rules:
         {
            "data[User][email]":
            {
               required:true,
               email:true,
               remote:ajax_url+'users/checkUserEmail'
            }
            
            
         },
         messages:
         {
            "data[User][email]":
            {
               required:'Please enter email.',
               email:'Please enter valid email.',
               remote:'Email does not exists.'
            }
            
            
         }
      
      
      });
      
   
   });
</script>

<?php /*
<div class="container">
   <div id="login-box" class="forgetting">
      <img src="<?php echo $this->webroot; ?>/img/login-arrow.png" alt="Agency Login" class="login-arrow" />
      <h2>Forgot Password</h2>
      <?php
         echo $this->Form->create('User', array('url'=>array('controller'=>'users', 'action'=>'forgot'))); ?>
      <div class="row">
         <div class="col-md-3">
            <label>email address:</label>
         </div>
         <div class="col-md-9 loginfield">
           <div class="input email required">
            <label for="UserEmail">Email</label>
            <input type="email" required="required" id="UserEmail" name="data[User][email]">
           </div>
         </div>
      </div>
      
      <div class="row loginbuttons">
         <div class="col-md-3">
         </div>


         <div class="col-md-9" id="forgot_address">
            <?php echo $this->Form->input('submit', array('type'=>'submit', 'class' =>'btn explore-submit btn-primary')); ?>
            <a href="<?php echo HTTP_ROOT.'users/login'?>"><div class="bk_button">back to login</div></a>

         </div>


      </div>
   </div>
</div>

*/ ?>

<!-- BEGIN LOGIN FORM -->
   <?php echo $this->Form->create('User', array('url'=>array('controller'=>'users', 'action'=>'forgot'))); ?>
      <h3 class="form-title">Forgot Password</h3>
      <div class="alert alert-danger display-hide">
         <button class="close" data-close="alert"></button>
         <span>Enter Your Registered Email Id. </span>
      </div>
      <div class="form-group">
         <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
         <label class="control-label visible-ie8 visible-ie9">Username</label>
         <?php echo $this->Form->input('email', array('type'=>'email','class' =>'form-control form-control-solid placeholder-no-fix')); ?>
      </div>
      
      <div class="form-actions">
     <div class="col-sm-6">
         <?php echo $this->Form->submit('submit', array('type'=>'submit', 'class' =>'btn btn-success uppercase')); ?>
      </div>
      <div class="col-sm-6">
         <?php echo $this->Html->link(__('back to login'), array('controller' => 'users','action' => 'login'), array('class' => 'btn explore-btn btn-warning forgot-password')); ?>
      </div>
      </div>
<style type="text/css">
   div.error {
    background: none repeat scroll 0 0 #f9e5e6;
    border: 1px solid #e8aaad;
    color: #b50007;
}
.response-msg {
    cursor: pointer;
    font-size: 13px;
    margin: 10px 0;
    padding: 6px 7px 7px 10px;
} 
div.success {
    background: none repeat scroll 0 0 #d3f2c6;
    border: 1px solid #195600;
    color: #195600;
}
</style>