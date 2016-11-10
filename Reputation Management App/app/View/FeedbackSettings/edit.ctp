<div class="feedbackSettings form">
<?php echo $this->Form->create('FeedbackSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Feedback Setting'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FeedbackSetting.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('FeedbackSetting.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Feedback Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
