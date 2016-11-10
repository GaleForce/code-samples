<div class="visibilities view">
<h2><?php echo __('Visibility'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($visibility['Visibility']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($visibility['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $visibility['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Social Media'); ?></dt>
		<dd>
			<?php echo $this->Html->link($visibility['SocialMedia']['id'], array('controller' => 'social_media', 'action' => 'view', $visibility['SocialMedia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Existense'); ?></dt>
		<dd>
			<?php echo h($visibility['Visibility']['existense']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Visibility'), array('action' => 'edit', $visibility['Visibility']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Visibility'), array('action' => 'delete', $visibility['Visibility']['id']), array(), __('Are you sure you want to delete # %s?', $visibility['Visibility']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visibility'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('controller' => 'social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('controller' => 'social_media', 'action' => 'add')); ?> </li>
	</ul>
</div>
