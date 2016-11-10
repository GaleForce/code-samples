<div class="customers view">
<h2><?php echo __('Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($customer['User']['id'], array('controller' => 'users', 'action' => 'view', $customer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phonenumber'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['phonenumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feedbackdate'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['feedbackdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($customer['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $customer['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailsentdate'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['emailsentdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailsent'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['emailsent']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), array(), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Reviews'), array('controller' => 'business_reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Review'), array('controller' => 'business_reviews', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Business Reviews'); ?></h3>
	<?php if (!empty($customer['BusinessReview'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Ratingstar'); ?></th>
		<th><?php echo __('Ratingdescription'); ?></th>
		<th><?php echo __('Ratingdate'); ?></th>
		<th><?php echo __('Authorization'); ?></th>
		<th><?php echo __('Confirmation'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($customer['BusinessReview'] as $businessReview): ?>
		<tr>
			<td><?php echo $businessReview['business_id']; ?></td>
			<td><?php echo $businessReview['user_id']; ?></td>
			<td><?php echo $businessReview['customer_id']; ?></td>
			<td><?php echo $businessReview['ratingstar']; ?></td>
			<td><?php echo $businessReview['ratingdescription']; ?></td>
			<td><?php echo $businessReview['ratingdate']; ?></td>
			<td><?php echo $businessReview['authorization']; ?></td>
			<td><?php echo $businessReview['confirmation']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'business_reviews', 'action' => 'view', $businessReview['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'business_reviews', 'action' => 'edit', $businessReview['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'business_reviews', 'action' => 'delete', $businessReview['id']), array(), __('Are you sure you want to delete # %s?', $businessReview['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Business Review'), array('controller' => 'business_reviews', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
