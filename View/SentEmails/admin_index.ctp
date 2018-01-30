<div class="sentEmails index">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Sent Emails'); ?></h2>

    <?php echo $this->Filter->filterForm('SentEmail', array('legend' => 'Search')); ?>

    <table cellpadding="0" cellspacing="0">
    <tr>
            <th class="actions">&nbsp;</th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('to'); ?></th>
            <th><?php echo $this->Paginator->sort('bca_no'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id'); ?></th>
            <th><?php echo $this->Paginator->sort('subject'); ?></th>
    </tr>
    <?php foreach ($sentEmails as $sentEmail): ?>
    <tr>
        <td class="actions">
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $sentEmail['SentEmail']['id'])); ?>
        </td>
        <td><?php echo h($sentEmail['SentEmail']['created']); ?>&nbsp;</td>
        <td><?php echo h($sentEmail['SentEmail']['to']); ?>&nbsp;</td>
        <td><?php echo h($sentEmail['SentEmail']['bca_no']); ?>&nbsp;</td>
        <td><?php echo h($sentEmail['SentEmail']['user_id']); ?>&nbsp;</td>
        <td><?php echo h($sentEmail['SentEmail']['subject']); ?>&nbsp;</td>
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
    </ul>
</div>
