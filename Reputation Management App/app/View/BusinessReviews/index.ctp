<div class="businessReviews index">
	<h2><?php echo __('Business Reviews'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ratingstar'); ?></th>
			<th><?php echo $this->Paginator->sort('ratingdescription'); ?></th>
			<th><?php echo $this->Paginator->sort('ratingdate'); ?></th>
			<th><?php echo $this->Paginator->sort('authorization'); ?></th>
			<th><?php echo $this->Paginator->sort('confirmation'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($businessReviews as $businessReview): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($businessReview['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessReview['Business']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($businessReview['User']['id'], array('controller' => 'users', 'action' => 'view', $businessReview['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($businessReview['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $businessReview['Customer']['id'])); ?>
		</td>
		<td><?php echo h($businessReview['BusinessReview']['ratingstar']); ?>&nbsp;</td>
		<td><?php echo h($businessReview['BusinessReview']['ratingdescription']); ?>&nbsp;</td>
		<td><?php echo h($businessReview['BusinessReview']['ratingdate']); ?>&nbsp;</td>
		<td><?php echo h($businessReview['BusinessReview']['authorization']); ?>&nbsp;</td>
		<td><?php echo h($businessReview['BusinessReview']['confirmation']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $businessReview['BusinessReview']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $businessReview['BusinessReview']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $businessReview['BusinessReview']['id']), array(), __('Are you sure you want to delete # %s?', $businessReview['BusinessReview']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Business Review'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
