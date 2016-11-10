     <?php echo $this->Form->create('User',['action' => 'login']);  ?>
        <div id="login-box">
          <?php echo $this->Html->image('login-arrow.png',['alt' => 'Agency Login','class'=>'login-arrow']); ?>
          <h2>agency <b>login</b></h2>
          <div class="row">
            <div class="col-md-4">
              <label>email address:</label>
            </div>
            <div class="col-md-8 loginfield">
              <?php echo $this->Form->input('email', array('div'=>false, 'label'=>false ,'required' => true)); ?>
            </div>
          </div>
          
          <div class="row pushdown">
            <div class="col-md-4">
              <label>password:</label>
            </div>
            <div class="col-md-8 loginfield">
              <?php echo $this->Form->input('password', array('div'=>false, 'label'=>false,'required' => true)); ?>
            </div>
          </div>
                    
          <div class="row loginbuttons">
            <div class="col-md-6">
              <button type="button" class="btn btn-forgot">forgot password</button>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->submit('submit',array('class'=>'btn btn-submit')); ?>
            </div>
          </div>
        </div>
     <?php echo $this->Form->end(); ?>