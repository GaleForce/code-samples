<div class="socialMedia index">
	<h2><?php echo __('Social Media'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('mediasitename'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('readrequirelogin'); ?></th>
			<th><?php echo $this->Paginator->sort('writerequirelogin'); ?></th>
			<th><?php echo $this->Paginator->sort('activateddate'); ?></th>
			<th><?php echo $this->Paginator->sort('deactivateddate'); ?></th>
			<th><?php echo $this->Paginator->sort('accounttype'); ?></th>
			<th><?php echo $this->Paginator->sort('createdat'); ?></th>
			<th><?php echo $this->Paginator->sort('updatedat'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($socialMedia as $socialMedia): ?>
	<tr>
		<td><?php echo h($socialMedia['SocialMedia']['id']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['mediasitename']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['url']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['readrequirelogin']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['writerequirelogin']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['activateddate']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['deactivateddate']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['accounttype']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['createdat']); ?>&nbsp;</td>
		<td><?php echo h($socialMedia['SocialMedia']['updatedat']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $socialMedia['SocialMedia']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $socialMedia['SocialMedia']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $socialMedia['SocialMedia']['id']), array(), __('Are you sure you want to delete # %s?', $socialMedia['SocialMedia']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Social Media'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('controller' => 'visibilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visibility'), array('controller' => 'visibilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
