<div class="businessEmployees index">
	<h2><?php echo __('Business Employees'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created_at'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($businessEmployees as $businessEmployee): ?>
	<tr>
		<td><?php echo h($businessEmployee['BusinessEmployee']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($businessEmployee['User']['id'], array('controller' => 'users', 'action' => 'view', $businessEmployee['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($businessEmployee['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessEmployee['Business']['id'])); ?>
		</td>
		<td><?php echo h($businessEmployee['BusinessEmployee']['created_at']); ?>&nbsp;</td>
		<td><?php echo h($businessEmployee['BusinessEmployee']['updated_at']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $businessEmployee['BusinessEmployee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $businessEmployee['BusinessEmployee']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $businessEmployee['BusinessEmployee']['id']), array(), __('Are you sure you want to delete # %s?', $businessEmployee['BusinessEmployee']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Business Employee'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
