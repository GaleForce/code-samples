<div class="visibilities index">
	<h2><?php echo __('Visibilities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('social_media_id'); ?></th>
			<th><?php echo $this->Paginator->sort('existense'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($visibilities as $visibility): ?>
	<tr>
		<td><?php echo h($visibility['Visibility']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($visibility['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $visibility['Business']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($visibility['SocialMedia']['id'], array('controller' => 'social_media', 'action' => 'view', $visibility['SocialMedia']['id'])); ?>
		</td>
		<td><?php echo h($visibility['Visibility']['existense']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $visibility['Visibility']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $visibility['Visibility']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $visibility['Visibility']['id']), array(), __('Are you sure you want to delete # %s?', $visibility['Visibility']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Visibility'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('controller' => 'social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('controller' => 'social_media', 'action' => 'add')); ?> </li>
	</ul>
</div>
