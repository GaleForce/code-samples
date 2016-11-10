<div class="agencysiteSettings form">
<?php echo $this->Form->create('AgencysiteSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Agencysite Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('sitetitle');
		echo $this->Form->input('siteheadcolor');
		echo $this->Form->input('sitebarcolor');
		echo $this->Form->input('sitebackgroundcolor');
		echo $this->Form->input('sitebackgroundimageurl');
		echo $this->Form->input('faviconimageurl');
		echo $this->Form->input('effectivedate');
		echo $this->Form->input('terminationdate');
		echo $this->Form->input('settingsdescription');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AgencysiteSetting.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('AgencysiteSetting.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Agencysite Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
