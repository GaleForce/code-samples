<div class="businesses index">
	<h2><?php echo __('Businesses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_Id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('feedbackthreshold'); ?></th>
			<th><?php echo $this->Paginator->sort('automatedenailattempts'); ?></th>
			<th><?php echo $this->Paginator->sort('emailfrequency'); ?></th>
			<th><?php echo $this->Paginator->sort('automatedpostfeedbackenailattempts'); ?></th>
			<th><?php echo $this->Paginator->sort('postfeedbackemailfrequency'); ?></th>
			<th><?php echo $this->Paginator->sort('businessname'); ?></th>
			<th><?php echo $this->Paginator->sort('business_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('addressline1'); ?></th>
			<th><?php echo $this->Paginator->sort('addressline2'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('companywebaddress'); ?></th>
			<th><?php echo $this->Paginator->sort('socialsharingchecker'); ?></th>
			<th><?php echo $this->Paginator->sort('visibilitychecker'); ?></th>
			<th><?php echo $this->Paginator->sort('createdat'); ?></th>
			<th><?php echo $this->Paginator->sort('updatedat'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($businesses as $business): ?>
	<tr>
		<td><?php echo h($business['Business']['id']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['user_Id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($business['ParentBusiness']['id'], array('controller' => 'businesses', 'action' => 'view', $business['ParentBusiness']['id'])); ?>
		</td>
		<td><?php echo h($business['Business']['feedbackthreshold']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['automatedenailattempts']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['emailfrequency']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['automatedpostfeedbackenailattempts']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['postfeedbackemailfrequency']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['businessname']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($business['BusinessCategory']['name'], array('controller' => 'business_categories', 'action' => 'view', $business['BusinessCategory']['id'])); ?>
		</td>
		<td><?php echo h($business['Business']['addressline1']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['addressline2']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['country']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['state']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['city']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['zip']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['phone']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['companywebaddress']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['socialsharingchecker']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['visibilitychecker']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['createdat']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['updatedat']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $business['Business']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $business['Business']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $business['Business']['id']), array(), __('Are you sure you want to delete # %s?', $business['Business']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Business'), array('action' => 'add')); ?></li>
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
