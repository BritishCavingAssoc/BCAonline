<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo __('Update Your Email Preferences'); ?></h2>

<?php echo $this->Form->create('User');?>
    <fieldset>
    <ul>
    <li><?php echo $this->Form->input('admin_email_ok', array('label' => 'I agree to receive administrative email from BCA/BCRA*.')); ?>
        <p>You are giving permission for BCA/BCRA to send you the administrative emails that allows BCA/BCRA to function.
        E.g. membership renewal notification, AGM notifications, ballot notification, etc.</p>
        <p>If you do not want to accept these emails then BCA/BCRA will communicate with you, via your club if you are a CIM (Club Individual Member),
        using traditional post which will cause BCA/BCRA and your club greater expense. <strong>So please tick this box.</strong></p>
        <p>* If you are not a BCRA member you will not receive BCRA email.</p>
    </li>
    <li><?php echo $this->Form->input('bca_email_ok', array('label' => 'I agree to receive general interest email from BCA.')) ?>
    <p>You are giving permission for BCA to send you email that BCA thinks is of general interest to its members including emails promoting its own and third party events and services.
    E.g. links to BCA publications such as the Newsletter and Speleology, event announcements, product safety warnings, access updates, insurance, etc.</p>
    </li>
    </ul>
    <p>&nbsp;</p>
    <p>NB you can opt-out at any time by changing the settings above.</p>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>

</div>
<div class="actions">
    <h3><?php echo __('Options'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Cancel Update'), array('action' => 'members_area'));?></li>
    </ul>
    <p>&nbsp;</p>
    <p>Choose your email preferences and click the 'Submit' button to save them.</p>

</div>
