<div class="users index">
    <?php echo $this->Session->flash('auth'); ?>
    <?php $dataSource = Configure::read('DataSource'); ?>

    <h2><?php echo __('Admin Dashboard');?></h2>
    <p><strong>Host: </strong><?php echo $dataSource['host']; ?></p>
    <p><strong>Database: </strong><?php echo $dataSource['database']; ?></p>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Users'), array('controller' => 'Users','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('User Audit'), array('controller' => 'UserAudits','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Html->link(__('Imported Users'), array('controller' => 'ImportedUsers','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Sent Emails'), array('controller' => 'SentEmails','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Html->link(__('Tokens'), array('controller' => 'Tokens','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Members Area'), array('controller' => 'Users','action'=>'members_area', 'admin' => false))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Mailing Lists'), array('controller' => 'Users','action'=>'mailing_list_individuals', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Logout'), array('controller' => 'Users','action'=>'logout', 'admin' => false))); ?>
    </ul>
</div>
