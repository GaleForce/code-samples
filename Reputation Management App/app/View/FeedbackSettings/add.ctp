<div class="feedbackSettings form">
<?php echo $this->Form->create('FeedbackSetting'); ?>
	<fieldset>
		<legend><?php echo __('Add Feedback Setting'); ?></legend>
	<?php
		echo $this->Form->input('business_id');
		echo $this->Form->input('displayvideo');
		echo $this->Form->input('embedcodemalepostivevideo');
		echo $this->Form->input('embedcodefemalepostivevideo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Feedback Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
