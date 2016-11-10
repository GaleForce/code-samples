  
 <?php echo $this->Html->script('jquery'); ?>
 <?php echo $this->Html->script('jquery.validate.min'); ?>
 <?php echo $this->Html->css('bootstrap.min.css'); ?>
 <?php echo $this->Html->css('bootstrap-theme.min.css'); ?>
 <?php echo $this->Html->css('repelev.css'); ?>

 
<div class="rating-container"><!--===main-container start here===-->

<div class="row">

<div class="col-md-6 logo-style">
 <div class="co-logo"><a href="javascript:void(0)"><?php if(isset($address)){?><img style="width:30%; height:100px;" src="<?php echo HTTP_ROOT;?>img/<?php echo @$address['Business']['business_logo'] ?>" alt="Company Logo"/><?php }?></a></div>
</div>

<div class="col-md-6 logo-non-style">  
  <div class="co-logo"><b>Address:</b>&nbsp;<?php echo @$address['Business']['addressline1'].' '. @$address['Business']['addressline2'] ?></br>
    City:<label><?php echo @$address['City']['city_name'];?></label></br>
    State:<label> <?php echo @$address['State']['stateName'];?></label></br>
    Country: <label><?php echo @$address['Country']['country_name'];?></label></br>
  </div>
</div>

</div>


<div class="row">
<div class="col-md-12">

  <div class="negative-feedback">
      <p>We're sorry to hear about your recent experience.</p>
      <p><strong>Dear <?php echo @$customer_name['Customer']['firstname'].' '.@$customer_name['Customer']['lastname'] ?>,</strong></p>
      <p>Thank you so much for taking the time to let us know about your recent experience at marketing, your input is invaluable to us.</p>
      <p>We are constantly striving to deliver an outstanding experience and exeed our customer expectation's it is only through your comments that we have the oppourtunity to recognise a situation that to be improved. I am taking steps to correction immidiatly.</p>
      <p>Thank for your input.</p>
  </div>

</div>
</div>  


  <form class="negative-form"  accept-charset="utf-8" method="post" action="<?php echo HTTP_ROOT?>Employee/thanksToNegativeCustomer"> 
    <div class="row">
      <div class="col-md-12">
        <div>
          <input type="hidden" name ="data[Customer][id]" value="<?php echo @$customer_id; ?>">
         <!-- <input type="hidden" name ="data[Customer][business_id]" value="<?php echo @$business_id; ?>">-->
          <label>Where did we go wrong</label>
            <textarea class="copy-comment form-control" name="data[Customer][suggestion_1]"></textarea>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-md-12">
        <div>
          <label>How can we avoid this in the future</label>
            <textarea class="copy-comment form-control" name="data[Customer][suggestion_2]"></textarea>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div>
          <label>What suggestion do you have to help us improve ?</label>
           <textarea class="copy-comment form-control" name="data[Customer][suggestion_3]"></textarea>
      </div>
    </div>
  </div>
   <div class="row">
      <div class="col-md-12">
        <div>
          <label>Any additional comment</label>
           <textarea class="copy-comment form-control" name="data[Customer][suggestion_4]"></textarea>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4 negative-btned" for="email"><input type="submit" class="submit btn btn-primary" value="Submit"></label>  
    <div class="col-sm-8 submitting">&nbsp;</div> 
    </div>


 
</form>




</div><!--===main-container close here===-->
 
 

