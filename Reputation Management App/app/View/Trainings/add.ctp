<div class="trainings form">
<?php echo $this->Form->create('Training'); ?>
	<fieldset>
		<legend><?php echo __('Add Training'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Trainings'), array('action' => 'index')); ?></li>
	</ul>
</div>
