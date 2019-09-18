<div class="users index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Users');?></h2>

    <?php echo $this->Filter->filterForm('User', array('legend' => 'Search')); ?>

    <table cellpadding="0" cellspacing="0">
    <tr>
            <th class="actions"><?php echo __('Actions');?></th>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('bca_no');?></th>
            <th><?php echo $this->Paginator->sort('username');?></th>

            <th><?php echo $this->Paginator->sort('email');?></th>
            <th><?php echo $this->Paginator->sort('active');?></th>
            <th><?php echo $this->Paginator->sort('last_login');?></th>
            <th><?php echo $this->Paginator->sort('login_count');?></th>

            <th><?php echo $this->Paginator->sort('forename');?></th>
            <th><?php echo $this->Paginator->sort('surname');?></th>
            <th><?php echo $this->Paginator->sort('short_name');?></th>
            <th><?php echo $this->Paginator->sort('position');?></th>
            <th><?php echo $this->Paginator->sort('organisation');?></th>

            <th><?php echo $this->Paginator->sort('bca_status');?></th>
            <th><?php echo $this->Paginator->sort('class');?></th>
            <th><?php echo $this->Paginator->sort('class_code');?></th>
            <th><?php echo $this->Paginator->sort('insurance_status');?></th>
            <th><?php echo $this->Paginator->sort('date_of_expiry');?></th>

            <th><?php echo $this->Paginator->sort('address1');?></th>
            <th><?php echo $this->Paginator->sort('address2');?></th>
            <th><?php echo $this->Paginator->sort('address3');?></th>
            <th><?php echo $this->Paginator->sort('town');?></th>
            <th><?php echo $this->Paginator->sort('county');?></th>
            <th><?php echo $this->Paginator->sort('postcode');?></th>
            <th><?php echo $this->Paginator->sort('country');?></th>
            <th><?php echo $this->Paginator->sort('telephone');?></th>
            <th><?php echo $this->Paginator->sort('website');?></th>
            <th><?php echo $this->Paginator->sort('Gender');?></th>
            <th><?php echo $this->Paginator->sort('Year Of Birth');?></th>

            <th><?php echo $this->Paginator->sort('address_ok');?></th>
            <th><?php echo $this->Paginator->sort('allow_club_updates');?></th>
            <th><?php echo $this->Paginator->sort('admin_email_ok');?></th>
            <th><?php echo $this->Paginator->sort('bca_email_ok');?></th>
            <th><?php echo $this->Paginator->sort('bcra_email_ok');?></th>
            <th><?php echo $this->Paginator->sort('roles');?></th>
            <th><?php echo $this->Paginator->sort('same_person');?></th>

            <th><?php echo $this->Paginator->sort('bcra_member');?></th>
            <th><?php echo $this->Paginator->sort('ccc_member');?></th>
            <th><?php echo $this->Paginator->sort('cncc_member');?></th>
            <th><?php echo $this->Paginator->sort('cscc_member');?></th>
            <th><?php echo $this->Paginator->sort('dca_member');?></th>
            <th><?php echo $this->Paginator->sort('dcuc_member');?></th>

            <th><?php echo $this->Paginator->sort('created');?></th>
            <th><?php echo $this->Paginator->sort('modified');?></th>
    </tr>
    <?php
    foreach ($users as $user): ?>
    <tr>
        <td class="actions">
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
        </td>
        <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['bca_no']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['username']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['active']); ?>&nbsp;</td>
        <td><?php echo h($user['LastLogin']['last_login']); ?>&nbsp;</td>
        <td><?php echo h($user['LastLogin']['login_count']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['forename']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['surname']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['short_name']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['position']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['organisation']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['bca_status']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['class']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['class_code']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['insurance_status']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['date_of_expiry']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['address1']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['address2']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['address3']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['town']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['county']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['postcode']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['country']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['telephone']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['website']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['gender']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['year_of_birth']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['address_ok']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['allow_club_updates']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['admin_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['bca_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['bcra_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['roles']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['same_person']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['bcra_member']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['ccc_member']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['cncc_member']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['cscc_member']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['dca_member']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['dcuc_member']); ?>&nbsp;</td>

        <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
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
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Add User'), array('action' => 'add'))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Show Mismatched Names'), array('action' => 'report_ind_mismatched_names_uu'))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Show Multiclass Users'), array('action' => 'report_multiclass_users_uu'))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Form->postLink(__('Lapse CIM & DIM Users'), array('action' => 'lapse_users'),
            null, __('Are you sure you want to lapse the CIM & DIM users?'))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Admin Dashboard'), array('controller' => 'Users','action'=>'dashboard', 'admin' => true))); ?>
    </ul>
</div>
