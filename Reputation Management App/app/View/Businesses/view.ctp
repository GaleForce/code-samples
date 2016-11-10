<div class="businesses view">
<h2><?php echo __('Business'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($business['Business']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($business['Business']['user_Id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($business['ParentBusiness']['id'], array('controller' => 'businesses', 'action' => 'view', $business['ParentBusiness']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feedbackthreshold'); ?></dt>
		<dd>
			<?php echo h($business['Business']['feedbackthreshold']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Automatedenailattempts'); ?></dt>
		<dd>
			<?php echo h($business['Business']['automatedenailattempts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailfrequency'); ?></dt>
		<dd>
			<?php echo h($business['Business']['emailfrequency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Automatedpostfeedbackenailattempts'); ?></dt>
		<dd>
			<?php echo h($business['Business']['automatedpostfeedbackenailattempts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postfeedbackemailfrequency'); ?></dt>
		<dd>
			<?php echo h($business['Business']['postfeedbackemailfrequency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Businessname'); ?></dt>
		<dd>
			<?php echo h($business['Business']['businessname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($business['BusinessCategory']['name'], array('controller' => 'business_categories', 'action' => 'view', $business['BusinessCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Addressline1'); ?></dt>
		<dd>
			<?php echo h($business['Business']['addressline1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Addressline2'); ?></dt>
		<dd>
			<?php echo h($business['Business']['addressline2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($business['Business']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($business['Business']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($business['Business']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($business['Business']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($business['Business']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Companywebaddress'); ?></dt>
		<dd>
			<?php echo h($business['Business']['companywebaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Socialsharingchecker'); ?></dt>
		<dd>
			<?php echo h($business['Business']['socialsharingchecker']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Visibilitychecker'); ?></dt>
		<dd>
			<?php echo h($business['Business']['visibilitychecker']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Createdat'); ?></dt>
		<dd>
			<?php echo h($business['Business']['createdat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updatedat'); ?></dt>
		<dd>
			<?php echo h($business['Business']['updatedat']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business'), array('action' => 'edit', $business['Business']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business'), array('action' => 'delete', $business['Business']['id']), array(), __('Are you sure you want to delete # %s?', $business['Business']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Categories'), array('controller' => 'business_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Category'), array('controller' => 'business_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Employees'), array('controller' => 'business_employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Employee'), array('controller' => 'business_employees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Reviews'), array('controller' => 'business_reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Review'), array('controller' => 'business_reviews', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Social Media'), array('controller' => 'business_social_media', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Social Media'), array('controller' => 'business_social_media', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Templates'), array('controller' => 'email_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Template'), array('controller' => 'email_templates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedback Settings'), array('controller' => 'feedback_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback Setting'), array('controller' => 'feedback_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Visibilities'), array('controller' => 'visibilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visibility'), array('controller' => 'visibilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Business Employees'); ?></h3>
	<?php if (!empty($business['BusinessEmployee'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['BusinessEmployee'] as $businessEmployee): ?>
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
	<?php if (!empty($business['BusinessReview'])): ?>
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
	<?php foreach ($business['BusinessReview'] as $businessReview): ?>
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
	<h3><?php echo __('Related Business Social Media'); ?></h3>
	<?php if (!empty($business['BusinessSocialMedia'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Social Media Id'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Inactive'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['BusinessSocialMedia'] as $businessSocialMedia): ?>
		<tr>
			<td><?php echo $businessSocialMedia['business_id']; ?></td>
			<td><?php echo $businessSocialMedia['social_media_id']; ?></td>
			<td><?php echo $businessSocialMedia['url']; ?></td>
			<td><?php echo $businessSocialMedia['active']; ?></td>
			<td><?php echo $businessSocialMedia['inactive']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'business_social_media', 'action' => 'view', $businessSocialMedia['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'business_social_media', 'action' => 'edit', $businessSocialMedia['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'business_social_media', 'action' => 'delete', $businessSocialMedia['id']), array(), __('Are you sure you want to delete # %s?', $businessSocialMedia['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Business Social Media'), array('controller' => 'business_social_media', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Businesses'); ?></h3>
	<?php if (!empty($business['ChildBusiness'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Feedbackthreshold'); ?></th>
		<th><?php echo __('Automatedenailattempts'); ?></th>
		<th><?php echo __('Emailfrequency'); ?></th>
		<th><?php echo __('Automatedpostfeedbackenailattempts'); ?></th>
		<th><?php echo __('Postfeedbackemailfrequency'); ?></th>
		<th><?php echo __('Businessname'); ?></th>
		<th><?php echo __('Business Category Id'); ?></th>
		<th><?php echo __('Addressline1'); ?></th>
		<th><?php echo __('Addressline2'); ?></th>
		<th><?php echo __('Country'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Companywebaddress'); ?></th>
		<th><?php echo __('Socialsharingchecker'); ?></th>
		<th><?php echo __('Visibilitychecker'); ?></th>
		<th><?php echo __('Createdat'); ?></th>
		<th><?php echo __('Updatedat'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['ChildBusiness'] as $childBusiness): ?>
		<tr>
			<td><?php echo $childBusiness['id']; ?></td>
			<td><?php echo $childBusiness['user_Id']; ?></td>
			<td><?php echo $childBusiness['parent_id']; ?></td>
			<td><?php echo $childBusiness['feedbackthreshold']; ?></td>
			<td><?php echo $childBusiness['automatedenailattempts']; ?></td>
			<td><?php echo $childBusiness['emailfrequency']; ?></td>
			<td><?php echo $childBusiness['automatedpostfeedbackenailattempts']; ?></td>
			<td><?php echo $childBusiness['postfeedbackemailfrequency']; ?></td>
			<td><?php echo $childBusiness['businessname']; ?></td>
			<td><?php echo $childBusiness['business_category_id']; ?></td>
			<td><?php echo $childBusiness['addressline1']; ?></td>
			<td><?php echo $childBusiness['addressline2']; ?></td>
			<td><?php echo $childBusiness['country']; ?></td>
			<td><?php echo $childBusiness['state']; ?></td>
			<td><?php echo $childBusiness['city']; ?></td>
			<td><?php echo $childBusiness['zip']; ?></td>
			<td><?php echo $childBusiness['phone']; ?></td>
			<td><?php echo $childBusiness['companywebaddress']; ?></td>
			<td><?php echo $childBusiness['socialsharingchecker']; ?></td>
			<td><?php echo $childBusiness['visibilitychecker']; ?></td>
			<td><?php echo $childBusiness['createdat']; ?></td>
			<td><?php echo $childBusiness['updatedat']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'businesses', 'action' => 'view', $childBusiness['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'businesses', 'action' => 'edit', $childBusiness['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'businesses', 'action' => 'delete', $childBusiness['id']), array(), __('Are you sure you want to delete # %s?', $childBusiness['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Customers'); ?></h3>
	<?php if (!empty($business['Customer'])): ?>
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
	<?php foreach ($business['Customer'] as $customer): ?>
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
	<h3><?php echo __('Related Email Templates'); ?></h3>
	<?php if (!empty($business['EmailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Emailtemplatename'); ?></th>
		<th><?php echo __('Emailsubject'); ?></th>
		<th><?php echo __('Sendername'); ?></th>
		<th><?php echo __('Senderemail'); ?></th>
		<th><?php echo __('Emailcontent'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['EmailTemplate'] as $emailTemplate): ?>
		<tr>
			<td><?php echo $emailTemplate['id']; ?></td>
			<td><?php echo $emailTemplate['business_id']; ?></td>
			<td><?php echo $emailTemplate['emailtemplatename']; ?></td>
			<td><?php echo $emailTemplate['emailsubject']; ?></td>
			<td><?php echo $emailTemplate['sendername']; ?></td>
			<td><?php echo $emailTemplate['senderemail']; ?></td>
			<td><?php echo $emailTemplate['emailcontent']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'email_templates', 'action' => 'view', $emailTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'email_templates', 'action' => 'edit', $emailTemplate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'email_templates', 'action' => 'delete', $emailTemplate['id']), array(), __('Are you sure you want to delete # %s?', $emailTemplate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Email Template'), array('controller' => 'email_templates', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Feedback Settings'); ?></h3>
	<?php if (!empty($business['FeedbackSetting'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Displayvideo'); ?></th>
		<th><?php echo __('Embedcodemalepostivevideo'); ?></th>
		<th><?php echo __('Embedcodefemalepostivevideo'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['FeedbackSetting'] as $feedbackSetting): ?>
		<tr>
			<td><?php echo $feedbackSetting['business_id']; ?></td>
			<td><?php echo $feedbackSetting['displayvideo']; ?></td>
			<td><?php echo $feedbackSetting['embedcodemalepostivevideo']; ?></td>
			<td><?php echo $feedbackSetting['embedcodefemalepostivevideo']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'feedback_settings', 'action' => 'view', $feedbackSetting['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'feedback_settings', 'action' => 'edit', $feedbackSetting['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'feedback_settings', 'action' => 'delete', $feedbackSetting['id']), array(), __('Are you sure you want to delete # %s?', $feedbackSetting['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Feedback Setting'), array('controller' => 'feedback_settings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Visibilities'); ?></h3>
	<?php if (!empty($business['Visibility'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Social Media Id'); ?></th>
		<th><?php echo __('Existense'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['Visibility'] as $visibility): ?>
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
