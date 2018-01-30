<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('member');
		echo $this->Form->input('full_name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('address3');
		echo $this->Form->input('address4');
		echo $this->Form->input('address5');
		echo $this->Form->input('postcode');
		echo $this->Form->input('country');
		echo $this->Form->input('mobile');
		echo $this->Form->input('home_tel');
		echo $this->Form->input('studio_tel');
		echo $this->Form->input('fax');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
	</ul>
</div>
