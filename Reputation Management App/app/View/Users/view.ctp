<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usertype'); ?></dt>
		<dd>
			<?php echo h($user['User']['usertype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($user['User']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Createdat'); ?></dt>
		<dd>
			<?php echo h($user['User']['createdat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updatedat'); ?></dt>
		<dd>
			<?php echo h($user['User']['updatedat']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agencysite Settings'), array('controller' => 'agencysite_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agencysite Setting'), array('controller' => 'agencysite_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Employees'), array('controller' => 'business_employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Employee'), array('controller' => 'business_employees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Reviews'), array('controller' => 'business_reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Review'), array('controller' => 'business_reviews', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Histories'), array('controller' => 'user_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User History'), array('controller' => 'user_histories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Agencysite Settings'); ?></h3>
	<?php if (!empty($user['AgencysiteSetting'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Sitetitle'); ?></th>
		<th><?php echo __('Siteheadcolor'); ?></th>
		<th><?php echo __('Sitebarcolor'); ?></th>
		<th><?php echo __('Sitebackgroundcolor'); ?></th>
		<th><?php echo __('Sitebackgroundimageurl'); ?></th>
		<th><?php echo __('Faviconimageurl'); ?></th>
		<th><?php echo __('Effectivedate'); ?></th>
		<th><?php echo __('Terminationdate'); ?></th>
		<th><?php echo __('Settingsdescription'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['AgencysiteSetting'] as $agencysiteSetting): ?>
		<tr>
			<td><?php echo $agencysiteSetting['id']; ?></td>
			<td><?php echo $agencysiteSetting['user_id']; ?></td>
			<td><?php echo $agencysiteSetting['sitetitle']; ?></td>
			<td><?php echo $agencysiteSetting['siteheadcolor']; ?></td>
			<td><?php echo $agencysiteSetting['sitebarcolor']; ?></td>
			<td><?php echo $agencysiteSetting['sitebackgroundcolor']; ?></td>
			<td><?php echo $agencysiteSetting['sitebackgroundimageurl']; ?></td>
			<td><?php echo $agencysiteSetting['faviconimageurl']; ?></td>
			<td><?php echo $agencysiteSetting['effectivedate']; ?></td>
			<td><?php echo $agencysiteSetting['terminationdate']; ?></td>
			<td><?php echo $agencysiteSetting['settingsdescription']; ?></td>
			<td><?php echo $agencysiteSetting['created_at']; ?></td>
			<td><?php echo $agencysiteSetting['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'agencysite_settings', 'action' => 'view', $agencysiteSetting['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'agencysite_settings', 'action' => 'edit', $agencysiteSetting['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'agencysite_settings', 'action' => 'delete', $agencysiteSetting['id']), array(), __('Are you sure you want to delete # %s?', $agencysiteSetting['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Agencysite Setting'), array('controller' => 'agencysite_settings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Business Employees'); ?></h3>
	<?php if (!empty($user['BusinessEmployee'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['BusinessEmployee'] as $businessEmployee): ?>
		<tr>
			<td><?php echo $businessEmployee['id']; ?></td>
			<td><?php echo $businessEmployee['user_id']; ?></td>
			<td><?php echo $businessEmployee['business_id']; ?></td>
			<td><?php echo $businessEmployee['created_at']; ?></td>
			<td><?php echo $businessEmployee['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'business_employees', 'action' => 'view', $businessEmployee['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'business_employees', 'action' => 'edit', $businessEmployee['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'business_employees', 'action' => 'delete', $businessEmployee['id']), array(), __('Are you sure you want to delete # %s?', $businessEmployee['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Business Employee'), array('controller' => 'business_employees', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Business Reviews'); ?></h3>
	<?php if (!empty($user['BusinessReview'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Ratingstar'); ?></th>
		<th><?php echo __('Ratingdescription'); ?></th>
		<th><?php echo __('Ratingdate'); ?></th>
		<th><?php echo __('Authorization'); ?></th>
		<th><?php echo __('Confirmation'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['BusinessReview'] as $businessReview): ?>
		<tr>
			<td><?php echo $businessReview['business_id']; ?></td>
			<td><?php echo $businessReview['user_id']; ?></td>
			<td><?php echo $businessReview['customer_id']; ?></td>
			<td><?php echo $businessReview['ratingstar']; ?></td>
			<td><?php echo $businessReview['ratingdescription']; ?></td>
			<td><?php echo $businessReview['ratingdate']; ?></td>
			<td><?php echo $businessReview['authorization']; ?></td>
			<td><?php echo $businessReview['confirmation']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'business_reviews', 'action' => 'view', $businessReview['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'business_reviews', 'action' => 'edit', $businessReview['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'business_reviews', 'action' => 'delete', $businessReview['id']), array(), __('Are you sure you want to delete # %s?', $businessReview['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Business Review'), array('controller' => 'business_reviews', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Customers'); ?></h3>
	<?php if (!empty($user['Customer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Phonenumber'); ?></th>
		<th><?php echo __('Feedbackdate'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Emailsentdate'); ?></th>
		<th><?php echo __('Emailsent'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Customer'] as $customer): ?>
		<tr>
			<td><?php echo $customer['id']; ?></td>
			<td><?php echo $customer['firstname']; ?></td>
			<td><?php echo $customer['email']; ?></td>
			<td><?php echo $customer['user_id']; ?></td>
			<td><?php echo $customer['phonenumber']; ?></td>
			<td><?php echo $customer['feedbackdate']; ?></td>
			<td><?php echo $customer['business_id']; ?></td>
			<td><?php echo $customer['emailsentdate']; ?></td>
			<td><?php echo $customer['emailsent']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'customers', 'action' => 'view', $customer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'customers', 'action' => 'edit', $customer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'customers', 'action' => 'delete', $customer['id']), array(), __('Are you sure you want to delete # %s?', $customer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Histories'); ?></h3>
	<?php if (!empty($user['UserHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Lastlogin'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserHistory'] as $userHistory): ?>
		<tr>
			<td><?php echo $userHistory['id']; ?></td>
			<td><?php echo $userHistory['user_id']; ?></td>
			<td><?php echo $userHistory['lastlogin']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_histories', 'action' => 'view', $userHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_histories', 'action' => 'edit', $userHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_histories', 'action' => 'delete', $userHistory['id']), array(), __('Are you sure you want to delete # %s?', $userHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User History'), array('controller' => 'user_histories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
