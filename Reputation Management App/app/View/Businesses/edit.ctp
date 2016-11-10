<div class="businesses form">
<?php echo $this->Form->create('Business'); ?>
	<fieldset>
		<legend><?php echo __('Edit Business'); ?></legend>
	<?php
	  	$feedbackthreshold = Configure::read('feedbackthreshold');
		$automatedenailattempts = Configure::read('automatedenailattempts');
		$emailfrequency = Configure::read('emailfrequency');
		
		echo $this->Form->input('Business.businessname', array('label' => 'Business Name' ));
		echo $this->Form->input('User.firstname', array('label' => 'First Name' ));
		echo $this->Form->input('User.lastname', array('label' => 'Last Name' ));
		echo $this->Form->hidden('user_Id');
		echo $this->Form->input('Business.business_category_id', array('label' => 'Main Business Category' ));
		echo $this->Form->input('Business.addressline1', array('label' => 'Street Address' ));
		echo $this->Form->input('Business.addressline2', array('label' => 'Street Address Line 2' ));
		echo $this->Form->input('Business.country', array('id' =>'find_country','empty' => 'Select Country', 'label' => 'Country' ) );
		echo $this->Form->input('Business.state' , array('type'=>'select','empty' => 'Select State' ,'id' => 'find_state', 'label' => 'State/Province' ) );

		echo $this->Form->input('Business.city' , array('type'=>'select','empty' => 'Select City' , 'id' => 'find_city' , 'label'=>'City') );


		echo $this->Form->input('Business.zip', array('label' => 'Zip' ));
		echo $this->Form->input('Business.phone', array('label' => 'Phone' ));
		echo $this->Form->input('Business.companywebaddress', array('label' => 'Company Web Address' ));
		echo $this->Form->input('Business.companyemailaddress', array('label' => 'Company Email Address' ));

		echo $this->Form->input('Business.feedbackthreshold', array('type'=>'select', 'label' => 'Feedback Threshold'  ,'id' => 'feedbackthreshold' ,'empty' => 'Select' ,"options" => $feedbackthreshold ));
		echo $this->Form->input('Business.automatedenailattempts' , array('type'=>'select','label' => 'Number of automated E-mail attempts ', 'empty' => 'Select' ,'id' => 'automatedenailattempts' ,"options" => $automatedenailattempts ));
		echo $this->Form->input('Business.emailfrequency', array('type'=>'select', 'label'=>'Email Frequency', 'id' => 'emailfrequency', 'empty' => 'Select' ,"options" => $emailfrequency ));


		echo $this->Form->input('Business.socialsharingchecker', array('label' => 'Social Sharing Checker' ));
		echo $this->Form->input('Business.visibilitychecker', array('label' => 'Visibility Checker' ));



	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Business.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Business.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Categories'), array('controller' => 'business_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Category'), array('controller' => 'business_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Employees'), array('controller' => 'business_employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Employee'), array('controller' => 'business_employees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Reviews'), array('controller' => 'business_reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Review'), array('controller' => 'business_reviews', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Social Media'), array('controller' => 'business_social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Social Media'), array('controller' => 'business_social_media', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Templates'), array('controller' => 'email_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Template'), array('controller' => 'email_templates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedback Settings'), array('controller' => 'feedback_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback Setting'), array('controller' => 'feedback_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('controller' => 'visibilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visibility'), array('controller' => 'visibilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<script>
(function($,W,D)
{
    var JQUERY4U = {};
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#BusinessEditForm").validate({
                rules: {
                    "data[Business][businessname]": "required",
                    "data[User][firstname]": "required",
                    "data[User][lastname]": "required",
                    "data[Business][business_category_id]": "required",
                    "data[Business][addressline1]": "required",
                    "data[Business][addressline2]": "required",
                    "data[Business][country]": "required",
                    "data[Business][state]": {
                    	selectcheck: true
                    },
                    "data[Business][city]": {
                    	selectcheck: true
                    },
                    "data[Business][zip]": "required",
                    "data[Business][phone]": "required",
                    "data[Business][companywebaddress]": "required",
                    "data[Business][companyemailaddress]":{
                        required: true,
                        email: true
                    },
                    "data[Business][feedbackthreshold]": {
                    	selectcheck: true
                    },
                    "data[Business][automatedenailattempts]": {
                    	selectcheck: true
                    },
                    "data[Business][emailfrequency]":{
                    	selectcheck: true
                    },
                    "data[Business][socialsharingchecker]": "required",
                    "data[Business][visibilitychecker]": "required"           
                },
                messages: {
                    "data[Business][businessname]": "Please enter your Business Name",
                    "data[User][firstname]": "Please enter your first name",
                    "data[User][lastname]": "Please enter your last name",
                    "data[Business][business_category_id]": "Please select business category ",
                    "data[Business][addressline1]": "Please enter street address",
                    "data[Business][addressline2]": "Please enter street address line 2",
                    "data[Business][country]": "Please select your country",
                    "data[Business][state]": "Please select your state",
                    "data[Business][city]": "Please select your city",
                    "data[Business][zip]": "Please enter your Zipcode",
                    "data[Business][phone]": "Please enter your phone no.",
                    "data[Business][companywebaddress]": "Please enter your company web address",
                    "data[Business][companyemailaddress]": "Please enter your valid company email address",
                    "data[Business][feedbackthreshold]": "Please select feedback threshold",
                    "data[Business][automatedenailattempts]": "Please select automated email attempts",
                    "data[Business][emailfrequency]": "Please select email frequency",
                    "data[Business][socialsharingchecker]": "Please enter social sharing checker",
                    "data[Business][visibilitychecker]": "Please enter visibility checker"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    });

 
})(jQuery, window, document);
</script>
