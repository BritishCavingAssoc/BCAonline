<div class="userAudits index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report Of Individual Members To Be Added'); ?></h2>
    <p>This reports lists the new individual members to be added to the master file.</p>
    <h3><?php
        $line_count = count($addedLines);
        if ($line_count == 0) {
            echo "There are no individual members to be added.";
        } elseif ($line_count == 1) {
            echo "There is 1 individual member to be added.";
        } elseif ($line_count >= 250) {
            echo "There are more than 250 individual members to be added.";
        } else {
            echo "There are $line_count individual members to be added.";
        }
    ?></h3>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo 'Class'; ?></th>
            <th><?php echo 'Organisation'; ?></th>
            <th><?php echo 'BCA No'; ?></th>
            <th><?php echo 'Forename'; ?></th>
            <th><?php echo 'Surname'; ?></th>
            <th><?php echo 'Class Code'; ?></th>
            <th><?php echo 'BCA Status'; ?></th>
            <th><?php echo 'Insurance Status'; ?></th>
            <th><?php echo 'Date of Expiry'; ?></th>
            <th><?php echo 'Email'; ?></th>
            <th><?php echo 'Address1'; ?></th>
            <th><?php echo 'Address2'; ?></th>
            <th><?php echo 'Address3'; ?></th>
            <th><?php echo 'Town'; ?></th>
            <th><?php echo 'County'; ?></th>
            <th><?php echo 'Postcode'; ?></th>
            <th><?php echo 'Country'; ?></th>
            <th><?php echo 'Gender'; ?></th>
            <th><?php echo 'Year of Birth'; ?></th>
            <th><?php echo 'BCRA Member'; ?></th>
            <th><?php echo 'Address OK'; ?></th>
    </tr>
    <?php foreach ($addedLines as $addedLine): ?>
    <tr>
        <td><?php if(!empty($addedLine['ImportedUser']['class'])) echo h($addedLine['ImportedUser']['class']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['organisation'])) echo h($addedLine['ImportedUser']['organisation']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['bca_no'])) echo h($addedLine['ImportedUser']['bca_no']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['forename'])) echo h($addedLine['ImportedUser']['forename']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['surname'])) echo h($addedLine['ImportedUser']['surname']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['class_code'])) echo h($addedLine['ImportedUser']['class_code']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['bca_status'])) echo h($addedLine['ImportedUser']['bca_status']); ?>&nbsp;</td>
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
        <td><?php if(!empty($addedLine['ImportedUser']['bcra_member'])) echo h($addedLine['ImportedUser']['bcra_member']); ?>&nbsp;</td>
        <td><?php if(!empty($addedLine['ImportedUser']['address_ok'])) echo h($addedLine['ImportedUser']['address_ok']); ?>&nbsp;</td>
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
