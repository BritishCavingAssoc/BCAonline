<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
	<fieldset>
	<legend><?php echo __('Request Login Details'); ?></legend>
	<p><strong>FOR BCA MEMBERS ONLY</strong></p>
	<p>Please enter the email address you have previously given to the BCA (possibly via your club).</p>
	<p>Then press the 'Submit' button to have your login details emailed to you.</>
	<p>If BCA doesn't have your email address please <?php echo $this->Html->link(__('click here'), array('action' => 'details_not_found')); ?>.</p>
	<?php
		echo $this->Form->input('email', array('label'=> 'Enter your email address:'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>

</div>
<div class="actions">
	<h3><?php echo __('BCA Online'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Cancel Request'), array('action' => 'login'));?></li>
	</ul>
</div>
