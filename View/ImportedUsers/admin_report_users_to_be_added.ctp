<div class="userAudits index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report Of Users To Be Added'); ?></h2>
    <p>This reports lists the new users to be added to the master file.</p>
    <h3><?php
        $line_count = count($addedLines);
        if ($line_count == 0) {
            echo "There are no users to be added.";
        } elseif ($line_count == 1) {
            echo "There is 1 user to be added.";
        } elseif ($line_count >= 250) {
            echo "There are more than 250 users to be added.";
        } else {
            echo "There are $line_count users to be added.";
        }
    ?></h3>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo 'class'; ?></th>
            <th><?php echo 'organisation'; ?></th>
            <th><?php echo 'bca_no'; ?></th>
            <th><?php echo 'forename'; ?></th>
            <th><?php echo 'surname'; ?></th>
            <th><?php echo 'class_code'; ?></th>
            <th><?php echo 'insurance_status'; ?></th>
            <th><?php echo 'date_of_expiry'; ?></th>
            <th><?php echo 'email'; ?></th>
            <th><?php echo 'address1'; ?></th>
            <th><?php echo 'address2'; ?></th>
            <th><?php echo 'address3'; ?></th>
            <th><?php echo 'town'; ?></th>
            <th><?php echo 'county'; ?></th>
            <th><?php echo 'postcode'; ?></th>
            <th><?php echo 'country'; ?></th>
            <th><?php echo 'gender'; ?></th>
            <th><?php echo 'year_of_birth'; ?></th>
    </tr>
    <?php foreach ($addedLines as $addedLine): ?>
    <tr>
        <td><?php if(!empty($addedLine['ImportedUser']['class'])) echo h($addedLine['ImportedUser']['class']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['organisation'])) echo h($addedLine['ImportedUser']['organisation']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['bca_no'])) echo h($addedLine['ImportedUser']['bca_no']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['forename'])) echo h($addedLine['ImportedUser']['forename']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['surname'])) echo h($addedLine['ImportedUser']['surname']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['class_code'])) echo h($addedLine['ImportedUser']['class_code']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['insurance_status'])) echo h($addedLine['ImportedUser']['insurance_status']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['date_of_expiry'])) echo h($addedLine['ImportedUser']['date_of_expiry']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['email'])) echo h($addedLine['ImportedUser']['email']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['address1'])) echo h($addedLine['ImportedUser']['address1']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['address2'])) echo h($addedLine['ImportedUser']['address2']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['address3'])) echo h($addedLine['ImportedUser']['address3']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['town'])) echo h($addedLine['ImportedUser']['town']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['county'])) echo h($addedLine['ImportedUser']['county']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['postcode'])) echo h($addedLine['ImportedUser']['postcode']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['country'])) echo h($addedLine['ImportedUser']['country']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['gender'])) echo h($addedLine['ImportedUser']['gender']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['year_of_birth'])) echo h($addedLine['ImportedUser']['year_of_birth']); ?>&nbsp;</td>
    </tr>
    <?php endforeach; ?>
    </table>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('controller' => 'ImportedUsers','action'=>'index')); ?> </li>
    </ul>
</div>
