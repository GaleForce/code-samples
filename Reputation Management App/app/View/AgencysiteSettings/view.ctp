<div class="agencysiteSettings view">
<h2><?php echo __('Agencysite Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($agencysiteSetting['User']['id'], array('controller' => 'users', 'action' => 'view', $agencysiteSetting['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sitetitle'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['sitetitle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Siteheadcolor'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['siteheadcolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sitebarcolor'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['sitebarcolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sitebackgroundcolor'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['sitebackgroundcolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sitebackgroundimageurl'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['sitebackgroundimageurl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Faviconimageurl'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['faviconimageurl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Effectivedate'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['effectivedate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terminationdate'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['terminationdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Settingsdescription'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['settingsdescription']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($agencysiteSetting['AgencysiteSetting']['updated_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Agencysite Setting'), array('action' => 'edit', $agencysiteSetting['AgencysiteSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Agencysite Setting'), array('action' => 'delete', $agencysiteSetting['AgencysiteSetting']['id']), array(), __('Are you sure you want to delete # %s?', $agencysiteSetting['AgencysiteSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Agencysite Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agencysite Setting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
