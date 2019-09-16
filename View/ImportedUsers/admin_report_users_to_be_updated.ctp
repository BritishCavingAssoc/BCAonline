<div class="userAudits index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report Of Uses To Be Updated'); ?></h2>
    <p>This reports shows the changes to be applied to the users in the master file.</p>
    <h3><?php
        $line_count = count($updatedLines);
        if ($line_count == 0) {
            echo "There are no users to be updated.";
        } elseif ($line_count == 1) {
            echo "There is 1 user to be updated.";
        } elseif ($line_count >= 1000) {
            echo "There are more than 1000 users to be updated.";
        } else {
            echo "There are $line_count users to be updated.";
        }
    ?></h3>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo 'Class'; ?></th>
            <th><?php echo 'Organisation'; ?></th>
            <th><?php echo 'BCA No'; ?></th>
            <th><?php echo 'Forename'; ?></th>
            <th><?php echo 'Surname'; ?></th>
            <th><?php echo 'Position'; ?></th>
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
            <th><?php echo 'Telephone'; ?></th>
            <th><?php echo 'Website'; ?></th>
            <th><?php echo 'Gender'; ?></th>
            <th><?php echo 'Year of Birth'; ?></th>
            <th><?php echo 'BCRA Member'; ?></th>
            <th><?php echo 'CCC Member'; ?></th>
            <th><?php echo 'CNCC Member'; ?></th>
            <th><?php echo 'CSCC Member'; ?></th>
            <th><?php echo 'DCA Member'; ?></th>
            <th><?php echo 'DCUC Member'; ?></th>
            <th><?php echo 'Address OK'; ?></th>
    </tr>
    <?php foreach ($updatedLines as $updatedLine): ?>
    <tr>
        <td><?php if(!empty($updatedLine['User']['class'])) echo h($updatedLine['User']['class']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['organisation'])) echo h($updatedLine['User']['organisation']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['bca_no'])) echo h($updatedLine['User']['bca_no']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['forename'])) echo h($updatedLine['User']['forename']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['surname'])) echo h($updatedLine['User']['surname']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['position'])) echo h($updatedLine['User']['position']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['class_code'])) echo h($updatedLine['User']['class_code']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['bca_status'])) echo h($updatedLine['User']['bca_status']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['insurance_status'])) echo h($updatedLine['User']['insurance_status']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['date_of_expiry'])) echo h($updatedLine['User']['date_of_expiry']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['email'])) echo h($updatedLine['User']['email']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['address1'])) echo h($updatedLine['User']['address1']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['address2'])) echo h($updatedLine['User']['address2']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['address3'])) echo h($updatedLine['User']['address3']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['town'])) echo h($updatedLine['User']['town']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['county'])) echo h($updatedLine['User']['county']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['postcode'])) echo h($updatedLine['User']['postcode']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['country'])) echo h($updatedLine['User']['country']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['telephone'])) echo h($updatedLine['User']['telephone']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['website'])) echo h($updatedLine['User']['website']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['gender'])) echo h($updatedLine['User']['gender']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['year_of_birth'])) echo h($updatedLine['User']['year_of_birth']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['bcra_member'])) echo h($updatedLine['User']['bcra_member']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['ccc_member'])) echo h($updatedLine['User']['ccc_member']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['cncc_member'])) echo h($updatedLine['User']['cncc_member']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['cscc_member'])) echo h($updatedLine['User']['cscc_member']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['dca_member'])) echo h($updatedLine['User']['dca_member']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['dcuc_member'])) echo h($updatedLine['User']['dcuc_member']); ?>&nbsp;</td>
        <td><?php if(!empty($updatedLine['User']['address_ok'])) echo h($updatedLine['User']['address_ok']); ?>&nbsp;</td>
    </tr>
    <tr class='bold'>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php if($updatedLine['ImportedUser']['forename'] != $updatedLine['User']['forename'])
            if(!empty($updatedLine['ImportedUser']['forename'])) {
                echo h($updatedLine['ImportedUser']['forename']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['surname'] != $updatedLine['User']['surname'])
            if(!empty($updatedLine['ImportedUser']['surname'])) {
                echo h($updatedLine['ImportedUser']['surname']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['position'] != $updatedLine['User']['position'])
            if(!empty($updatedLine['ImportedUser']['position'])) {
                echo h($updatedLine['ImportedUser']['position']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['class_code'] != $updatedLine['User']['class_code'])
            if(!empty($updatedLine['ImportedUser']['class_code'])) {
                echo h($updatedLine['ImportedUser']['class_code']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if (isset($updatedLine['ImportedUser']['bca_status']) && isset($updatedLine['User']['bca_status'])) {
            if($updatedLine['ImportedUser']['bca_status'] != $updatedLine['User']['bca_status']) {
                if(!empty($updatedLine['ImportedUser']['bca_status'])) {
                    echo h($updatedLine['ImportedUser']['bca_status']);
                } else { echo "Cleared"; }
            }} ?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['insurance_status'] != $updatedLine['User']['insurance_status'])
            if(!empty($updatedLine['ImportedUser']['insurance_status'])) {
                echo h($updatedLine['ImportedUser']['insurance_status']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if (isset($updatedLine['ImportedUser']['date_of_expiry']) && isset($updatedLine['User']['date_of_expiry'])) {
            if($updatedLine['ImportedUser']['date_of_expiry'] != $updatedLine['User']['date_of_expiry']) {
                if(!empty($updatedLine['ImportedUser']['date_of_expiry'])) {
                    echo h($updatedLine['ImportedUser']['date_of_expiry']);
                } else { echo "Cleared"; }
            }} ?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['email'] != $updatedLine['User']['email'])
            if(!empty($updatedLine['ImportedUser']['email'])) {
                echo h($updatedLine['ImportedUser']['email']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['address1'] != $updatedLine['User']['address1'])
            if(!empty($updatedLine['ImportedUser']['address1'])) {
                echo h($updatedLine['ImportedUser']['address1']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['address2'] != $updatedLine['User']['address2'])
            if(!empty($updatedLine['ImportedUser']['address2'])) {
                echo h($updatedLine['ImportedUser']['address2']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['address3'] != $updatedLine['User']['address3'])
            if(!empty($updatedLine['ImportedUser']['address3'])) {
                echo h($updatedLine['ImportedUser']['address3']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['town'] != $updatedLine['User']['town'])
            if(!empty($updatedLine['ImportedUser']['town'])) {
                echo h($updatedLine['ImportedUser']['town']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['county'] != $updatedLine['User']['county'])
            if(!empty($updatedLine['ImportedUser']['county'])) {
                echo h($updatedLine['ImportedUser']['county']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['postcode'] != $updatedLine['User']['postcode'])
            if(!empty($updatedLine['ImportedUser']['postcode'])) {
                echo h($updatedLine['ImportedUser']['postcode']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['country'] != $updatedLine['User']['country'])
            if(!empty($updatedLine['ImportedUser']['country'])) {
                echo h($updatedLine['ImportedUser']['country']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['telephone'] != $updatedLine['User']['telephone'])
            if(!empty($updatedLine['ImportedUser']['telephone'])) {
                echo h($updatedLine['ImportedUser']['telephone']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['website'] != $updatedLine['User']['website'])
            if(!empty($updatedLine['ImportedUser']['website'])) {
                echo h($updatedLine['ImportedUser']['website']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['gender'] != $updatedLine['User']['gender'])
            if(!empty($updatedLine['ImportedUser']['gender'])) {
                echo h($updatedLine['ImportedUser']['gender']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['year_of_birth'] != $updatedLine['User']['year_of_birth'])
            if(!empty($updatedLine['ImportedUser']['year_of_birth'])) {
                echo h($updatedLine['ImportedUser']['year_of_birth']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['bcra_member'] != $updatedLine['User']['bcra_member'])
            if(!empty($updatedLine['ImportedUser']['bcra_member'])) {
                echo h($updatedLine['ImportedUser']['bcra_member']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['ccc_member'] != $updatedLine['User']['ccc_member'])
            if(!empty($updatedLine['ImportedUser']['ccc_member'])) {
                echo h($updatedLine['ImportedUser']['ccc_member']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['cncc_member'] != $updatedLine['User']['cncc_member'])
            if(!empty($updatedLine['ImportedUser']['cncc_member'])) {
                echo h($updatedLine['ImportedUser']['cncc_member']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['cscc_member'] != $updatedLine['User']['cscc_member'])
            if(!empty($updatedLine['ImportedUser']['cscc_member'])) {
                echo h($updatedLine['ImportedUser']['cscc_member']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['dca_member'] != $updatedLine['User']['dca_member'])
            if(!empty($updatedLine['ImportedUser']['dca_member'])) {
                echo h($updatedLine['ImportedUser']['dca_member']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['dcuc_member'] != $updatedLine['User']['dcuc_member'])
            if(!empty($updatedLine['ImportedUser']['dcuc_member'])) {
                echo h($updatedLine['ImportedUser']['dcuc_member']);
            } else { echo "Cleared"; }?>&nbsp;</td>

        <td><?php if($updatedLine['ImportedUser']['address_ok'] != $updatedLine['User']['address_ok'])
            if(!empty($updatedLine['ImportedUser']['address_ok'])) {
                echo h($updatedLine['ImportedUser']['address_ok']);
            } else { echo "Cleared"; }?>&nbsp;</td>
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
