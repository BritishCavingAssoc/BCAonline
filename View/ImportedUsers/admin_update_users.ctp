<div class="userUpdateErrors view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('User Update Errors');?></h2>

    <?php //print_r($updateErrors); die(); ?>
    <h3><?php
        if (($no_rows = count($updateErrors)) == 1) {
            echo "There is {$no_rows} row with errors";
        } else {
            echo "There are {$no_rows} rows with errors";
        };
    ?></h3>

    <dl>
    <?php foreach ($updateErrors as $userErrors) { ?>
        <dt>User: <?php echo "Id: {$userErrors['imported_user_id']}, BCA No: {$userErrors['bca_no']}, Name: {$userErrors['full_name']}"; ?></dt>
        <?php foreach ($userErrors['validation_error'] as $field => $errors) { ?>
            <dt><?php echo $field; ?></dt>
            <dd><?php foreach ($errors as $message) {echo $message."<br>";} ?></dd>
        <?php } ?>
    <?php } ?>
    </dl>

</div>
<div class="actions">
    <h3><?php echo __('Options'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
    </ul>
</div>
