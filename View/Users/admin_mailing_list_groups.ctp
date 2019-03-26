<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Mailing List - Groups');?></h2>

<?php echo "Number of records = ". count($users); ?>

<textarea readonly rows="30">
email,FULLNAME
<?php foreach ($users as $user):

    echo h($user['User']['email']).",".h($user['User']['full_name'])."\n";

endforeach; ?>
</textarea>

</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <?php echo $this->Menu->item(array('UserAdmin', 'UserMailingLists'), $this->Html->link(__('Individuals Mailing List'), array('controller' => 'Users','action'=>'mailing_list_individuals', 'admin' => true))); ?>
        <?php echo $this->Menu->item(array('UserAdmin', 'UserMailingLists'), $this->Html->link(__('Groups Mailing List'), array('controller' => 'Users','action'=>'mailing_list_groups', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Admin Dashboard'), array('action'=>'dashboard'))); ?>
    </ul>
    <p>This is the list of current Clubs and Group members who have opted-in to the Newsletter.</p>
    <p>Cut and paste into a text file ready to be imported into phpList.</p>
</div>
