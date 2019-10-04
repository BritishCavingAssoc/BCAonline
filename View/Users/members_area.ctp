<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo $id_name;?></h2>

  <p>Welcome to your personal area of the BCA website.</p>
  <p>Currently we are focusing on using email to improve communications with our members.</p>
  <p><strong>Please check that your <?php echo $this->Html->link(__('Email Preferences'), array('action'=>'email_preferences')) ?> are set as you wish.</strong></p>
  <p>You can also check the details we hold for you are correct by looking at <?php echo $this->Html->link(__('Your Profile'), array('action'=>'view')) ?>.</p>
  <p>&nbsp;</p>
  <p>Watch this space, we will be adding other features in the future.</p>

</div>
<div class="actions">
  <h3><?php echo __('BCA Online'); ?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('Your Profile'), array('action' => 'view')); ?> </li>
    <li><?php echo $this->Html->link(__('Email Preferences'), array('action' => 'email_preferences')); ?> </li>
    <?php echo $this->Menu->item('DiaryAdmin', $this->Html->link(__('Diary Admin'), array('controller' => 'Events', 'action' => 'index', 'admin' => true))); ?>
    <?php echo $this->Menu->item(array('UserEnquiry', 'UserManager', 'UserAdmin', 'ImportUserAdmin'), $this->Html->link(__('Admin Dashboard'), array('controller' => 'Users', 'action' => 'dashboard', 'admin' => true))); ?>
    <?php if ($this->Session->check('Auth.Admin.id')) { //Show button if an Admin currently acting as a user.
        echo $this->Menu->item(null, $this->Html->link(__('Become Admin'), array('action'=>'become_admin')));}
    ?>
    <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'Users','action'=>'logout')); ?> </li>
  </ul>
</div>