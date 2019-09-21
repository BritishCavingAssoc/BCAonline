<div class="importedUsers form">
    <?php echo $this->Form->create('ImportedUser'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Imported User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('class', array('options'=>array('CIM'=>'CIM', 'DIM'=>'DIM', 'GRP'=>'GRP'), 'empty'=>'Select'));
		echo $this->Form->input('forename');
		echo $this->Form->input('surname');
		echo $this->Form->input('bca_no');
		echo $this->Form->input('organisation');
		echo $this->Form->input('position');
        echo $this->Form->input('bca_status', array('options'=>array('Current'=>'Current', 'Overdue'=>'Overdue', 'Lapsed'=>'Lapsed',
            'Resigned'=>'Resigned', 'Expelled'=>'Expelled', 'Deceased'=>'Deceased'), 'empty'=>'Select'));
        echo $this->Form->input('insurance_status', array('options'=>array('C'=>'Caver', 'NC'=>'Non-Caver', 'STU'=>'Full Time Student', 'U18'=>'Under 18',
            'AN'=>'Another Route', 'Y'=>'Yes', 'N'=>'No'), 'empty'=>'Select'));
		echo $this->Form->input('class_code');
		echo $this->Form->input('email');
		echo $this->Form->input('date_of_expiry');
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('address3');
		echo $this->Form->input('town');
		echo $this->Form->input('county');
		echo $this->Form->input('postcode');
		echo $this->Form->input('country');
		echo $this->Form->input('telephone');
		echo $this->Form->input('website');
		echo $this->Form->input('gender');
		echo $this->Form->input('year_of_birth');
		echo $this->Form->input('address_ok');
		echo $this->Form->input('bca_email_ok');
		echo $this->Form->input('bcra_email_ok');
		echo $this->Form->input('bcra_member');
		echo $this->Form->input('ccc_member');
		echo $this->Form->input('cncc_member');
		echo $this->Form->input('cscc_member');
		echo $this->Form->input('dca_member');
		echo $this->Form->input('dcuc_member');
		echo $this->Form->input('forename2');
		echo $this->Form->input('surname2');
		echo $this->Form->input('bca_no2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Cancel'), array('action' => 'index')); ?></li>
	</ul>
</div>
