<div class="businessSocialMedia form">
<?php echo $this->Form->create('BusinessSocialMedia'); ?>
	<fieldset>
		<legend><?php echo __('Edit Business Social Media'); ?></legend>
	<?php
		echo $this->Form->input('business_id');
		echo $this->Form->input('social_media_id');
		echo $this->Form->input('url');
		echo $this->Form->input('active');
		echo $this->Form->input('inactive');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BusinessSocialMedia.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('BusinessSocialMedia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Business Social Media'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('controller' => 'social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('controller' => 'social_media', 'action' => 'add')); ?> </li>
	</ul>
</div>
