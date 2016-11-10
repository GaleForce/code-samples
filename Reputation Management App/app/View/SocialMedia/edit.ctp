<div class="socialMedia form">
<?php echo $this->Form->create('SocialMedia'); ?>
	<fieldset>
		<legend><?php echo __('Edit Social Media'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mediasitename');
		echo $this->Form->input('url');
		echo $this->Form->input('readrequirelogin');
		echo $this->Form->input('writerequirelogin');
		echo $this->Form->input('activateddate');
		echo $this->Form->input('deactivateddate');
		echo $this->Form->input('accounttype');
		echo $this->Form->input('createdat');
		echo $this->Form->input('updatedat');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SocialMedia.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SocialMedia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('controller' => 'visibilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visibility'), array('controller' => 'visibilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
