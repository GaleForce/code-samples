<div class="emailTemplates index">
	<h2><?php echo __('Email Templates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('emailtemplatename'); ?></th>
			<th><?php echo $this->Paginator->sort('emailsubject'); ?></th>
			<th><?php echo $this->Paginator->sort('sendername'); ?></th>
			<th><?php echo $this->Paginator->sort('senderemail'); ?></th>
			<th><?php echo $this->Paginator->sort('emailcontent'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($emailTemplates as $emailTemplate): ?>
	<tr>
		<td><?php echo h($emailTemplate['EmailTemplate']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($emailTemplate['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $emailTemplate['Business']['id'])); ?>
		</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['emailtemplatename']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['emailsubject']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['sendername']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['senderemail']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['emailcontent']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $emailTemplate['EmailTemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emailTemplate['EmailTemplate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emailTemplate['EmailTemplate']['id']), array(), __('Are you sure you want to delete # %s?', $emailTemplate['EmailTemplate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Email Template'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
