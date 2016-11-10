<script type="text/javascript">
$(document).ready(function(){
   $('#UserForgotForm').validate({
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
<div class="container">
   <div id="login-box">
      <img src="<?php echo $this->webroot; ?>/img/login-arrow.png" alt="Business User Login" class="login-arrow" />
      <h2>Forgot Password</h2>
      <?php
         echo $this->Form->create('User', array('url'=>array('controller'=>'users', 'action'=>'businessUserForgot'))); ?>
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

      <div class="col-md-3"></div>

         <div class="col-md-9">
            <?php echo $this->Form->input('submit', array('type'=>'submit', 'class' =>'btn explore-submit btn-primary')); ?>
         </div>
      </div>
   </div>
</div>
