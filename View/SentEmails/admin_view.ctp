<div class="sentEmails view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo __('Sent Email'); ?></h2>
    <dl>
        <dt><?php echo __('Date'); ?></dt>
        <dd>
            <?php echo h($sentEmail['SentEmail']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Sent To'); ?></dt>
        <dd>
            <?php echo h($sentEmail['SentEmail']['to']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('BCA No'); ?></dt>
        <dd>
            <?php echo h($sentEmail['SentEmail']['bca_no']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('User Id'); ?></dt>
        <dd>
            <?php echo h($sentEmail['SentEmail']['user_id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Subject'); ?></dt>
        <dd>
            <?php echo h($sentEmail['SentEmail']['subject']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Body'); ?></dt>
        <dd>
            <?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', h($sentEmail['SentEmail']['message'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
    </ul>
</div>
