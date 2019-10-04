<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Mailing List - Ballot');?></h2>

<p>This is the list of current Individual and Group members for a ballot.</p>
<p>Cut and paste into a text file ready to be imported into phpList.</p>
<p>&nbsp;</p>

<?php echo "Number of records = ". count($users); ?>

<textarea readonly rows="30">
<?php
    if ($duplicates) {

        echo "Duplicate Ballot IDs were generated. Please run again.";

    } else {

        echo "email|name|full_name|organisation|ballot_id|address1|address2|address3|town|county|postcode|country|house|occurance\n";

        foreach ($users as $user):

        echo
            //h($user['User']['bca_no'])."|".
            h($user['User']['email'])."|".
            h($user['User']['id_name'])."|".
            h($user['User']['full_name'])."|".
            h($user['User']['organisation'])."|".
            h($user['User']['ballot_id'])."|".
            h($user['User']['address1'])."|".
            h($user['User']['address2'])."|".
            h($user['User']['address3'])."|".
            h($user['User']['town'])."|".
            h($user['User']['county'])."|".
            h($user['User']['postcode'])."|".
            h($user['User']['country'])."|".
            h($user['User']['house'])."|".
            h($user['User']['occurance'])."|".
            "\n";

        endforeach;
    }
?>
</textarea>

</div>

<?php echo $this->element('mailing_list_actions'); ?>
