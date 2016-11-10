<div class="businessReviews form">
<?php echo $this->Form->create('BusinessReview'); ?>
	<fieldset>
		<legend><?php echo __('Add Business Review'); ?></legend>
	<?php
		echo $this->Form->input('business_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('ratingstar');
		echo $this->Form->input('ratingdescription');
		echo $this->Form->input('ratingdate');
		echo $this->Form->input('authorization');
		echo $this->Form->input('confirmation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Business Reviews'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
