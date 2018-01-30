<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('bca_no');
        echo $this->Form->input('username');
        echo $this->Form->input('active');
        echo $this->Form->input('email');
        echo $this->Form->input('forename');
        echo $this->Form->input('surname');
        echo $this->Form->input('organisation');
        echo $this->Form->input('class', array('options'=>array('CIM'=>'CIM', 'DIM'=>'DIM', 'GRP'=>'GRP'), 'empty'=>'Select'));
        echo $this->Form->input('roles');
        echo $this->Form->input('website');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('Cancel'), array('action' => 'index'));?></li>
    </ul>
</div>
