<div class="trainings form">
<?php echo $this->Form->create('Training'); ?>
	<fieldset>
		<legend><?php echo __('Edit Training'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('url');
		echo $this->Form->input('createdat');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Training.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Training.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Trainings'), array('action' => 'index')); ?></li>
	</ul>
</div>
