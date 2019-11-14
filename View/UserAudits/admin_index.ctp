<div class="userAudits index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('User Audits'); ?></h2>
    
    <?php echo $this->Filter->filterForm('UserAudit', array('legend' => 'Search')); ?>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th class="actions"><?php echo __('Compare To'); ?></th>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('audit_datetime'); ?></th>
            <th><?php echo $this->Paginator->sort('audit_user'); ?></th>
            <th><?php echo $this->Paginator->sort('audit_type'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_no'); ?></th>
            <th><?php echo $this->Paginator->sort('username'); ?></th>
            <th><?php echo $this->Paginator->sort('email'); ?></th>
            <th><?php echo $this->Paginator->sort('email_status'); ?></th>
            <th><?php echo $this->Paginator->sort('active'); ?></th>
            <th><?php echo $this->Paginator->sort('forename'); ?></th>
            <th><?php echo $this->Paginator->sort('surname'); ?></th>
            <th><?php echo $this->Paginator->sort('organisation'); ?></th>
            <th><?php echo $this->Paginator->sort('short_name'); ?></th>
            <th><?php echo $this->Paginator->sort('position'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_status'); ?></th>
            <th><?php echo $this->Paginator->sort('class'); ?></th>
            <th><?php echo $this->Paginator->sort('class_code'); ?></th>
            <th><?php echo $this->Paginator->sort('insurance_status'); ?></th>
            <th><?php echo $this->Paginator->sort('date_of_expiry'); ?></th>
            <th><?php echo $this->Paginator->sort('address1'); ?></th>
            <th><?php echo $this->Paginator->sort('address2'); ?></th>
            <th><?php echo $this->Paginator->sort('address3'); ?></th>
            <th><?php echo $this->Paginator->sort('town'); ?></th>
            <th><?php echo $this->Paginator->sort('county'); ?></th>
            <th><?php echo $this->Paginator->sort('postcode'); ?></th>
            <th><?php echo $this->Paginator->sort('country'); ?></th>
            <th><?php echo $this->Paginator->sort('telephone'); ?></th>
            <th><?php echo $this->Paginator->sort('website'); ?></th>
            <th><?php echo $this->Paginator->sort('gender'); ?></th>
            <th><?php echo $this->Paginator->sort('year_of_birth'); ?></th>
            <th><?php echo $this->Paginator->sort('address_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('allow_club_updates'); ?></th>
            <th><?php echo $this->Paginator->sort('admin_email_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_email_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('bcra_email_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('bcra_member'); ?></th>
            <th><?php echo $this->Paginator->sort('ccc_member'); ?></th>
            <th><?php echo $this->Paginator->sort('cncc_member'); ?></th>
            <th><?php echo $this->Paginator->sort('cscc_member'); ?></th>
            <th><?php echo $this->Paginator->sort('dca_member'); ?></th>
            <th><?php echo $this->Paginator->sort('dcuc_member'); ?></th>
            <th><?php echo $this->Paginator->sort('forename2'); ?></th>
            <th><?php echo $this->Paginator->sort('surname2'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_no2'); ?></th>
            <th><?php echo $this->Paginator->sort('insurance_status2'); ?></th>
            <th><?php echo $this->Paginator->sort('class_code2'); ?></th>
            <th><?php echo $this->Paginator->sort('roles'); ?></th>
            <th><?php echo $this->Paginator->sort('same_person'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
    </tr>
    <?php foreach ($userAudits as $userAudit): ?>
    <tr>
        <td class="actions">
            <?php echo $this->Html->link(__('Adjacent'), array('action' => 'compare_adjacent', $userAudit['UserAudit']['id'])); ?>
            <?php echo $this->Html->link(__('Current'), array('action' => 'compare_current', $userAudit['UserAudit']['id'])); ?>
        </td>
        <td><?php echo h($userAudit['UserAudit']['id']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['audit_datetime']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['audit_user']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['audit_type']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['user_id']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['bca_no']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['username']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['email']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['email_status']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['active']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['forename']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['surname']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['organisation']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['short_name']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['position']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['bca_status']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['class_code']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['class']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['insurance_status']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['date_of_expiry']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['address1']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['address2']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['address3']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['town']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['county']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['postcode']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['country']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['telephone']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['website']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['gender']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['year_of_birth']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['address_ok']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['allow_club_updates']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['admin_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['bca_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['bcra_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['bcra_member']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['ccc_member']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['cncc_member']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['cscc_member']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['dca_member']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['dcuc_member']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['forename2']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['surname2']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['bca_no2']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['insurance_status2']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['class_code2']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['roles']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['same_person']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['created']); ?>&nbsp;</td>
        <td><?php echo h($userAudit['UserAudit']['modified']); ?>&nbsp;</td>
    </tr>
<?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>	</p>
    <div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Admin Dashboard'), array('controller' => 'Users','action'=>'dashboard', 'admin' => true)); ?> </li>
        <li><?php echo $this->Html->link(__('Changes Report'), array('controller' => 'UserAudits','action'=>'changes_report', 'admin' => true)); ?> </li>
    </ul>
</div>
