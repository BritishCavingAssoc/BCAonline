<div class="tokens form">
<?php echo $this->Form->create('Token'); ?>
    <fieldset>
        <legend><?php echo __('Admin Edit Token'); ?></legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('token_code');
        echo $this->Form->input('user_id', array('type' => 'text'));
        echo $this->Form->input('action');
        echo $this->Form->input('expires');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Cancel'), array('action' => 'index')); ?></li>
    </ul>
</div>
