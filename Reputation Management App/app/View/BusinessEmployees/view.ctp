<div class="businessEmployees view">
<h2><?php echo __('Business Employee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($businessEmployee['BusinessEmployee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessEmployee['User']['id'], array('controller' => 'users', 'action' => 'view', $businessEmployee['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessEmployee['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessEmployee['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($businessEmployee['BusinessEmployee']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($businessEmployee['BusinessEmployee']['updated_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business Employee'), array('action' => 'edit', $businessEmployee['BusinessEmployee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business Employee'), array('action' => 'delete', $businessEmployee['BusinessEmployee']['id']), array(), __('Are you sure you want to delete # %s?', $businessEmployee['BusinessEmployee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Employees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Employee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
