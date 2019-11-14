<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
	<?php echo $this->Form->end(__('Login'));?>
</div>
<div class="actions">
	<h3><?php echo __('BCA Online'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Request Login Details'), array('action' => 'request_login_details')); ?> </li>
		<li><?php echo $this->Html->link(__('Main Website'), 'http://british-caving.org.uk'); ?> </li>
		<p>&nbsp;</p>
		<p><strong>Welcome to the members' area.</strong></p>
		<p>Within you can update your contact details.</p>
		<p>You can also check your details held by BCA.</p>
        <p>New user? Forgotten your password? Click on the Request button above.</p>
	</ul>
</div>