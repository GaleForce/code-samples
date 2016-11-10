<div class="feedbackSettings view">
<h2><?php echo __('Feedback Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($feedbackSetting['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $feedbackSetting['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Displayvideo'); ?></dt>
		<dd>
			<?php echo h($feedbackSetting['FeedbackSetting']['displayvideo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Embedcodemalepostivevideo'); ?></dt>
		<dd>
			<?php echo h($feedbackSetting['FeedbackSetting']['embedcodemalepostivevideo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Embedcodefemalepostivevideo'); ?></dt>
		<dd>
			<?php echo h($feedbackSetting['FeedbackSetting']['embedcodefemalepostivevideo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Feedback Setting'), array('action' => 'edit', $feedbackSetting['FeedbackSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Feedback Setting'), array('action' => 'delete', $feedbackSetting['FeedbackSetting']['id']), array(), __('Are you sure you want to delete # %s?', $feedbackSetting['FeedbackSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedback Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback Setting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
