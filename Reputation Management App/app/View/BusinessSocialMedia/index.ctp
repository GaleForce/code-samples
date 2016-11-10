<div class="businessSocialMedia index">
	<h2><?php echo __('Business Social Media'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('social_media_id'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('inactive'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($businessSocialMedia as $businessSocialMedia): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($businessSocialMedia['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessSocialMedia['Business']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($businessSocialMedia['SocialMedia']['id'], array('controller' => 'social_media', 'action' => 'view', $businessSocialMedia['SocialMedia']['id'])); ?>
		</td>
		<td><?php echo h($businessSocialMedia['BusinessSocialMedia']['url']); ?>&nbsp;</td>
		<td><?php echo h($businessSocialMedia['BusinessSocialMedia']['active']); ?>&nbsp;</td>
		<td><?php echo h($businessSocialMedia['BusinessSocialMedia']['inactive']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $businessSocialMedia['BusinessSocialMedia']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $businessSocialMedia['BusinessSocialMedia']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $businessSocialMedia['BusinessSocialMedia']['id']), array(), __('Are you sure you want to delete # %s?', $businessSocialMedia['BusinessSocialMedia']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Business Social Media'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('controller' => 'social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('controller' => 'social_media', 'action' => 'add')); ?> </li>
	</ul>
</div>
