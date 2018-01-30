<div class="tokens index">
    <h2><?php echo __('Tokens'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th class="actions"><?php echo __('Actions');?></th>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('token_code'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id'); ?></th>
            <th><?php echo $this->Paginator->sort('action'); ?></th>
            <th><?php echo $this->Paginator->sort('expires'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($tokens as $token): ?>
    <tr>
        <td class="actions">
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $token['Token']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $token['Token']['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $token['Token']['id']), null, __('Are you sure you want to delete # %s?', $token['Token']['id'])); ?>
        </td>
        <td><?php echo h($token['Token']['id']); ?>&nbsp;</td>
        <td><?php echo h($token['Token']['token_code']); ?>&nbsp;</td>
        <td><?php echo h($token['Token']['user_id']); ?>&nbsp;</td>
        <td><?php echo h($token['Token']['action']); ?>&nbsp;</td>
        <td><?php echo h($token['Token']['expires']); ?>&nbsp;</td>
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
