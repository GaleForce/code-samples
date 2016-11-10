<div class="visibilities form">
<?php echo $this->Form->create('Visibility'); ?>
	<fieldset>
		<legend><?php echo __('Edit Visibility'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('business_id');
		echo $this->Form->input('social_media_id');
		echo $this->Form->input('existense');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Visibility.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Visibility.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('controller' => 'social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('controller' => 'social_media', 'action' => 'add')); ?> </li>
	</ul>
</div>
