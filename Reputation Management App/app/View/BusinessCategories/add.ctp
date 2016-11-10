<div class="businessCategories form">
<?php echo $this->Form->create('BusinessCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Business Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Business Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
