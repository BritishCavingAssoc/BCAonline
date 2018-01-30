<div class="importedUsers view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo __('Imported User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Class'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['class']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forename'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['forename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BCA No'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['bca_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organisation'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['organisation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BCA Status'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['bca_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Insurance Status'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['insurance_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Class Code'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['class_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Of Expiry'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['date_of_expiry']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address3'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['address3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['town']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['county']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postcode'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['postcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Ok'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['address_ok']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BCA Email Ok'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['bca_email_ok']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BCRA Email Ok'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['bcra_email_ok']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forename2'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['forename2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname2'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['surname2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BCA No2'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['bca_no2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($importedUser['ImportedUser']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Imported User'), array('action' => 'edit', $importedUser['ImportedUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Imported User'), array('action' => 'delete', $importedUser['ImportedUser']['id']), null, __('Are you sure you want to delete # %s?', $importedUser['ImportedUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
	</ul>
</div>
