<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Validation Errors');?></h2>

    <?php echo print_r($this->validationErrors); ?>

</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
    </ul>
</div>
