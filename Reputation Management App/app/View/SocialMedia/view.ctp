<div class="socialMedia view">
<h2><?php echo __('Social Media'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mediasitename'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['mediasitename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Readrequirelogin'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['readrequirelogin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Writerequirelogin'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['writerequirelogin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activateddate'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['activateddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deactivateddate'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['deactivateddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accounttype'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['accounttype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Createdat'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['createdat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updatedat'); ?></dt>
		<dd>
			<?php echo h($socialMedia['SocialMedia']['updatedat']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Social Media'), array('action' => 'edit', $socialMedia['SocialMedia']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Social Media'), array('action' => 'delete', $socialMedia['SocialMedia']['id']), array(), __('Are you sure you want to delete # %s?', $socialMedia['SocialMedia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Media'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Media'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('controller' => 'visibilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visibility'), array('controller' => 'visibilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Visibilities'); ?></h3>
	<?php if (!empty($socialMedia['Visibility'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Social Media Id'); ?></th>
		<th><?php echo __('Existense'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($socialMedia['Visibility'] as $visibility): ?>
		<tr>
			<td><?php echo $visibility['id']; ?></td>
			<td><?php echo $visibility['business_id']; ?></td>
			<td><?php echo $visibility['social_media_id']; ?></td>
			<td><?php echo $visibility['existense']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'visibilities', 'action' => 'view', $visibility['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'visibilities', 'action' => 'edit', $visibility['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'visibilities', 'action' => 'delete', $visibility['id']), array(), __('Are you sure you want to delete # %s?', $visibility['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Visibility'), array('controller' => 'visibilities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
