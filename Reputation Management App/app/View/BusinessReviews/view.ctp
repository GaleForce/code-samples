<div class="businessReviews view">
<h2><?php echo __('Business Review'); ?></h2>
	<dl>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessReview['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessReview['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessReview['User']['id'], array('controller' => 'users', 'action' => 'view', $businessReview['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessReview['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $businessReview['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ratingstar'); ?></dt>
		<dd>
			<?php echo h($businessReview['BusinessReview']['ratingstar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ratingdescription'); ?></dt>
		<dd>
			<?php echo h($businessReview['BusinessReview']['ratingdescription']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ratingdate'); ?></dt>
		<dd>
			<?php echo h($businessReview['BusinessReview']['ratingdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Authorization'); ?></dt>
		<dd>
			<?php echo h($businessReview['BusinessReview']['authorization']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmation'); ?></dt>
		<dd>
			<?php echo h($businessReview['BusinessReview']['confirmation']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business Review'), array('action' => 'edit', $businessReview['BusinessReview']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business Review'), array('action' => 'delete', $businessReview['BusinessReview']['id']), array(), __('Are you sure you want to delete # %s?', $businessReview['BusinessReview']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Reviews'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Review'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
