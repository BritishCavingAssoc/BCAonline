<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <?php echo $this->Menu->item(array('UserAdmin', 'UserMailingLists'), $this->Html->link(__('Newsletter Individuals'), array('controller' => 'Users','action'=>'mailing_list_individuals', 'admin' => true))); ?>
        <?php echo $this->Menu->item(array('UserAdmin', 'UserMailingLists'), $this->Html->link(__('Newsletter Groups'), array('controller' => 'Users','action'=>'mailing_list_groups', 'admin' => true))); ?>
        <?php echo $this->Menu->item(array('UserAdmin', 'UserMailingLists'), $this->Html->link(__('Ballot'), array('controller' => 'Users','action'=>'mailing_list_ballot', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Admin Dashboard'), array('action'=>'dashboard'))); ?>
    </ul>
</div>