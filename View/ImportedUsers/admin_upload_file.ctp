<div class="importedUsers form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('ImportedUser', array('type'=>'file'));?>
    <fieldset>
    <legend><?php echo __('Upload Membership CSV File'); ?></legend>
    <?php
        echo $this->Form->input('import_spreadsheet', array('options'=>array('CIM'=>'CIM', 'DIM'=>'DIM', 'GRP'=>'GRP'), 'empty'=>'Select'));
        echo $this->Form->input('upload', array('type'=>'file'));
    ?>
    </fieldset>
    <?php echo $this->Form->end(__('Import'));?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Cancel'), array('action'=>'index')); ?> </li>
    </ul>
</div>