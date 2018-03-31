<div class="importedUsers index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Imported Users'); ?></h2>
    <h1><?php $dataSource = Configure::read('DataSource'); echo "{$dataSource['host']} / {$dataSource['database']}";?></h1>

    <?php echo $this->Filter->filterForm('ImportedUser', array('legend' => 'Search')); ?>

    <table cellpadding="0" cellspacing="0">
    <tr>
            <th class="actions"><?php echo __('Actions'); ?></th>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('class'); ?></th>
            <th><?php echo $this->Paginator->sort('forename'); ?></th>
            <th><?php echo $this->Paginator->sort('surname'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_no'); ?></th>
            <th><?php echo $this->Paginator->sort('organisation'); ?></th>
            <th><?php echo $this->Paginator->sort('position'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_status'); ?></th>
            <th><?php echo $this->Paginator->sort('insurance_status'); ?></th>
            <th><?php echo $this->Paginator->sort('class_code'); ?></th>
            <th><?php echo $this->Paginator->sort('email'); ?></th>
            <th><?php echo $this->Paginator->sort('date_of_expiry'); ?></th>
            <th><?php echo $this->Paginator->sort('address1'); ?></th>
            <th><?php echo $this->Paginator->sort('address2'); ?></th>
            <th><?php echo $this->Paginator->sort('address3'); ?></th>
            <th><?php echo $this->Paginator->sort('town'); ?></th>
            <th><?php echo $this->Paginator->sort('county'); ?></th>
            <th><?php echo $this->Paginator->sort('postcode'); ?></th>
            <th><?php echo $this->Paginator->sort('country'); ?></th>
            <th><?php echo $this->Paginator->sort('website'); ?></th>
            <th><?php echo $this->Paginator->sort('address_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_email_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('bcra_email_ok'); ?></th>
            <th><?php echo $this->Paginator->sort('forename2'); ?></th>
            <th><?php echo $this->Paginator->sort('surname2'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_no2'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
    </tr>
    <?php foreach ($importedUsers as $importedUser): ?>
    <tr>
        <td class="actions">
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $importedUser['ImportedUser']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $importedUser['ImportedUser']['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $importedUser['ImportedUser']['id']), null, __('Are you sure you want to delete # %s?', $importedUser['ImportedUser']['id'])); ?>
        </td>
        <td><?php echo h($importedUser['ImportedUser']['id']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['class']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['forename']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['surname']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['bca_no']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['organisation']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['position']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['bca_status']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['insurance_status']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['class_code']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['email']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['date_of_expiry']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['address1']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['address2']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['address3']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['town']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['county']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['postcode']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['country']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['website']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['address_ok']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['bca_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['bcra_email_ok']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['forename2']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['surname2']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['bca_no2']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['created']); ?>&nbsp;</td>
        <td><?php echo h($importedUser['ImportedUser']['modified']); ?>&nbsp;</td>
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
        <li><?php echo $this->Form->postLink(__('Delete All'), array('action' => 'delete_all'), null,
            __('Are you sure you want to delete all?')); ?></li>
        <li><?php echo $this->Html->link(__('Upload CSV File'), array('action' => 'upload_file')); ?></li>
        <li><?php echo $this->Html->link(__('Process CSV File'), array('action' => 'process_file')); ?></li>
        <li><?php echo $this->Html->link(__('Show Repeated Lines'), array('action' => 'report_repeated_lines')); ?></li>
        <li><?php echo $this->Html->link(__('Show Mismatched Names'), array('action' => 'report_mismatched_names_iuu')); ?></li>
        <!--<li><?php echo $this->Html->link(__('Show Mismatched Names 2'), array('action' => 'report_mismatched_names_uu')); ?></li>-->
        <li><?php echo $this->Html->link(__('Show To Be Updated'), array('action' => 'report_users_to_be_updated')); ?></li>
        <li><?php echo $this->Html->link(__('Show To Be Added'), array('action' => 'report_users_to_be_added')); ?></li>
        <!-- <li><?php echo $this->Html->link(__('Update Users'), array('action' => 'update_users')); ?></li> -->
        <li><?php echo $this->Form->postLink(__('Update Users'), array('action' => 'update_users'), null,
            __('Are you sure you want to update the users?')); ?></li>
        <li><?php echo $this->Html->link(__('Add Imported User'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Admin Dashboard'), array('controller' => 'Users','action'=>'dashboard', 'admin' => true)); ?> </li>
    </ul>
</div>
