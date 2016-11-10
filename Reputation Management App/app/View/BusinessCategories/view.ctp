<div class="businessCategories view">
<h2><?php echo __('Business Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($businessCategory['BusinessCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($businessCategory['BusinessCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($businessCategory['BusinessCategory']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($businessCategory['BusinessCategory']['updated_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business Category'), array('action' => 'edit', $businessCategory['BusinessCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business Category'), array('action' => 'delete', $businessCategory['BusinessCategory']['id']), array(), __('Are you sure you want to delete # %s?', $businessCategory['BusinessCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
