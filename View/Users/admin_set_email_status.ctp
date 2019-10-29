<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Set Email Status Flag');?></h2>

<p>Cut and paste lists of email addesses, one per line, into the appropriate box.</p>
<p>&nbsp;</p>

<?php echo $this->Form->create('User');?>
    <fieldset>
    <?php
        echo $this->Form->input('hard_bounced_emails', array('type' => 'textarea', 'label' => 'To Be Marked Hard Bounced:'));
        echo $this->Form->input('soft_bounced_emails', array('type' => 'textarea', 'label' => 'To Be Marked Soft Bounced:'));
        echo $this->Form->input('black_listed_emails', array('type' => 'textarea', 'label' => 'To Be Marked Black Listed By Mailing Provider:'));
        echo $this->Form->input('ok_emails', array('type' => 'textarea', 'label' => 'To Be Marked OK:'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>


</div>

<?php echo $this->element('mailing_list_actions'); ?>
