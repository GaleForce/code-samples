<div class="businessSocialMedia view">
<h2><?php echo __('Business Social Media'); ?></h2>
	<dl>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessSocialMedia['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessSocialMedia['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Social Media'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessSocialMedia['SocialMedia']['id'], array('controller' => 'social_media', 'action' => 'view', $businessSocialMedia['SocialMedia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($businessSocialMedia['BusinessSocialMedia']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($businessSocialMedia['BusinessSocialMedia']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inactive'); ?></dt>
		<dd>
			<?php echo h($businessSocialMedia['BusinessSocialMedia']['inactive']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business Social Media'), array('action' => 'edit', $businessSocialMedia['BusinessSocialMedia']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business Social Media'), array('action' => 'delete', $businessSocialMedia['BusinessSocialMedia']['id']), array(), __('Are you sure you want to delete # %s?', $businessSocialMedia['BusinessSocialMedia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Social Media'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Social Media'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('controller' => 'social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('controller' => 'social_media', 'action' => 'add')); ?> </li>
	</ul>
</div>
