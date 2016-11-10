<div class="feedbackSettings index">
	<h2><?php echo __('Feedback Settings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('displayvideo'); ?></th>
			<th><?php echo $this->Paginator->sort('embedcodemalepostivevideo'); ?></th>
			<th><?php echo $this->Paginator->sort('embedcodefemalepostivevideo'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($feedbackSettings as $feedbackSetting): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($feedbackSetting['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $feedbackSetting['Business']['id'])); ?>
		</td>
		<td><?php echo h($feedbackSetting['FeedbackSetting']['displayvideo']); ?>&nbsp;</td>
		<td><?php echo h($feedbackSetting['FeedbackSetting']['embedcodemalepostivevideo']); ?>&nbsp;</td>
		<td><?php echo h($feedbackSetting['FeedbackSetting']['embedcodefemalepostivevideo']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $feedbackSetting['FeedbackSetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $feedbackSetting['FeedbackSetting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $feedbackSetting['FeedbackSetting']['id']), array(), __('Are you sure you want to delete # %s?', $feedbackSetting['FeedbackSetting']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Feedback Setting'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
