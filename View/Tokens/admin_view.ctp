<div class="tokens view">
<h2><?php echo __('Token'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($token['Token']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Token Code'); ?></dt>
        <dd>
            <?php echo h($token['Token']['token_code']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('User Id'); ?></dt>
        <dd>
            <?php echo h($token['Token']['user_id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Action'); ?></dt>
        <dd>
            <?php echo h($token['Token']['action']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Expires'); ?></dt>
        <dd>
            <?php echo h($token['Token']['expires']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Token'), array('action' => 'edit', $token['Token']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Token'), array('action' => 'delete', $token['Token']['id']), null, __('Are you sure you want to delete # %s?', $token['Token']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
    </ul>
</div>
