<div class="userAudits index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('User Audits'); ?></h2>

    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo 'user_id'; ?></th>
            <th><?php echo 'id'; ?></th>
            <th><?php echo 'audit_datetime'; ?></th>
            <th><?php echo 'audit_user'; ?></th>
            <th><?php echo 'audit_type'; ?></th>
            <th><?php echo 'username'; ?></th>
            <th><?php echo 'active'; ?></th>
            <th><?php echo 'email'; ?></th>
            <th><?php echo 'forename'; ?></th>
            <th><?php echo 'surname'; ?></th>
            <th><?php echo 'organisation'; ?></th>
            <th><?php echo 'short_name'; ?></th>
            <th><?php echo 'position'; ?></th>
            <th><?php echo 'bca_status'; ?></th>
            <th><?php echo 'bca_no'; ?></th>
            <th><?php echo 'class'; ?></th>
            <th><?php echo 'class_code'; ?></th>
            <th><?php echo 'insurance_status'; ?></th>
            <th><?php echo 'date_of_expiry'; ?></th>
            <th><?php echo 'address1'; ?></th>
            <th><?php echo 'address2'; ?></th>
            <th><?php echo 'address3'; ?></th>
            <th><?php echo 'town'; ?></th>
            <th><?php echo 'county'; ?></th>
            <th><?php echo 'postcode'; ?></th>
            <th><?php echo 'country'; ?></th>
            <th><?php echo 'telephone'; ?></th>
            <th><?php echo 'address_ok'; ?></th>
            <th><?php echo 'allow_club_updates'; ?></th>
            <th><?php echo 'admin_email_ok'; ?></th>
            <th><?php echo 'bca_email_ok'; ?></th>
            <th><?php echo 'bcra_email_ok'; ?></th>
            <th><?php echo 'forename2'; ?></th>
            <th><?php echo 'surname2'; ?></th>
            <th><?php echo 'bca_no2'; ?></th>
            <th><?php echo 'created'; ?></th>
            <th><?php echo 'modified'; ?></th>
    </tr>
    <?php
        $last_userAudit = array('UserAudit' => array('user_id' => 0));

        foreach ($userAudits as $userAudit):

        //If new user_id show all values.
        if ($userAudit['UserAudit']['user_id'] != $last_userAudit['UserAudit']['user_id']) {
            $userAudit2 = $userAudit;
            $class='';
        } else { //Show only changes.
            $userAudit2['UserAudit'] = array_diff_assoc($userAudit['UserAudit'], $last_userAudit['UserAudit']);
            //Show values that have become empty.
            $userAudit2['UserAudit'] = array_merge($userAudit2['UserAudit'], array_fill_keys(array_keys($userAudit2['UserAudit'], ''), 'Emptied'));
            $class='bold';
        }
        $last_userAudit = $userAudit;
    ?>
    <tr class='<?php echo $class?>'>
        <td><?php if(!empty($userAudit2['UserAudit']['user_id'])) echo h($userAudit2['UserAudit']['user_id']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['id'])) echo h($userAudit2['UserAudit']['id']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['audit_datetime'])) echo h($userAudit2['UserAudit']['audit_datetime']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['audit_user'])) echo h($userAudit2['UserAudit']['audit_user']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['audit_type'])) echo h($userAudit2['UserAudit']['audit_type']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['username'])) echo h($userAudit2['UserAudit']['username']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['active'])) echo h($userAudit2['UserAudit']['active']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['email'])) echo h($userAudit2['UserAudit']['email']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['forename'])) echo h($userAudit2['UserAudit']['forename']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['surname'])) echo h($userAudit2['UserAudit']['surname']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['organisation'])) echo h($userAudit2['UserAudit']['organisation']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['short_name'])) echo h($userAudit2['UserAudit']['short_name']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['position'])) echo h($userAudit2['UserAudit']['position']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['bca_status'])) echo h($userAudit2['UserAudit']['bca_status']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['bca_no'])) echo h($userAudit2['UserAudit']['bca_no']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['class_code'])) echo h($userAudit2['UserAudit']['class_code']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['class'])) echo h($userAudit2['UserAudit']['class']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['insurance_status'])) echo h($userAudit2['UserAudit']['insurance_status']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['date_of_expiry'])) echo h($userAudit2['UserAudit']['date_of_expiry']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['address1'])) echo h($userAudit2['UserAudit']['address1']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['address2'])) echo h($userAudit2['UserAudit']['address2']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['address3'])) echo h($userAudit2['UserAudit']['address3']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['town'])) echo h($userAudit2['UserAudit']['town']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['county'])) echo h($userAudit2['UserAudit']['county']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['postcode'])) echo h($userAudit2['UserAudit']['postcode']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['country'])) echo h($userAudit2['UserAudit']['country']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['telephone'])) echo h($userAudit2['UserAudit']['telephone']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['address_ok'])) echo h($userAudit2['UserAudit']['address_ok']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['allow_club_updates'])) echo h($userAudit2['UserAudit']['allow_club_updates']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['admin_email_ok'])) echo h($userAudit2['UserAudit']['admin_email_ok']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['bca_email_ok'])) echo h($userAudit2['UserAudit']['bca_email_ok']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['bcra_email_ok'])) echo h($userAudit2['UserAudit']['bcra_email_ok']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['forename2'])) echo h($userAudit2['UserAudit']['forename2']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['surname2'])) echo h($userAudit2['UserAudit']['surname2']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['bca_no2'])) echo h($userAudit2['UserAudit']['bca_no2']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['created'])) echo h($userAudit2['UserAudit']['created']); ?>&nbsp;</td>
        <td><?php if(!empty($userAudit2['UserAudit']['modified'])) echo h($userAudit2['UserAudit']['modified']); ?>&nbsp;</td>
    </tr>
<?php endforeach; ?>
    </table>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('controller' => 'UserAudits','action'=>'index')); ?> </li>
    </ul>
</div>
