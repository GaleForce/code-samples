<div class="emailTemplates view">
<h2><?php echo __('Email Template'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($emailTemplate['EmailTemplate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($emailTemplate['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $emailTemplate['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailtemplatename'); ?></dt>
		<dd>
			<?php echo h($emailTemplate['EmailTemplate']['emailtemplatename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailsubject'); ?></dt>
		<dd>
			<?php echo h($emailTemplate['EmailTemplate']['emailsubject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sendername'); ?></dt>
		<dd>
			<?php echo h($emailTemplate['EmailTemplate']['sendername']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Senderemail'); ?></dt>
		<dd>
			<?php echo h($emailTemplate['EmailTemplate']['senderemail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailcontent'); ?></dt>
		<dd>
			<?php echo h($emailTemplate['EmailTemplate']['emailcontent']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Email Template'), array('action' => 'edit', $emailTemplate['EmailTemplate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Email Template'), array('action' => 'delete', $emailTemplate['EmailTemplate']['id']), array(), __('Are you sure you want to delete # %s?', $emailTemplate['EmailTemplate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Templates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Template'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
	</ul>
</div>
