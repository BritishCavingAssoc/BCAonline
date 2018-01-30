<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo __('Update Your Email Address'); ?></h2>

<?php echo $this->Form->create('User');?>
	<fieldset>
		<?php
		echo $this->Form->input('email_old', array('type' => 'hidden'));	//Here so value is preserved for the email.
		echo $this->Form->input('email', array('label' => 'New Email Address'));
		echo $this->Form->input('email_confirm', array('type' => 'email', 'label' => 'Confirm Email Address'));
		?>
        <!-- <p>Two confirmation emails will be sent - one to your new and one to your old email address.</p> -->
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>

</div>
<div class="actions">
	<h3><?php echo __('BCA Online'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Cancel Update'), array('action' => 'view'));?></li>
	</ul>
	<p>&nbsp;</p>
	<p>To change your email address, enter it twice and click the 'Submit' button.</p>
	
</div>
