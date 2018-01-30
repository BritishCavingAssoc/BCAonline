<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo __('Set / Reset Your Password'); ?></h2>
<h3><?php if (isset($full_name)) echo $full_name; ?></h3>

<?php echo $this->Form->create('User');?>
    <fieldset>
        <?php
        echo $this->Form->input('passwd_new', array('type'=> 'password', 'label'=> 'New Password'));
        echo $this->Form->input('passwd_confirm', array('type'=> 'password', 'label'=> 'Confirm New Password'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>

</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Cancel Update'), array('action' => 'index'));?></li>
    </ul>
    <p>&nbsp;</p>
    <p>To change your password, enter it twice and click the 'Submit' button.</p>
    
</div>
