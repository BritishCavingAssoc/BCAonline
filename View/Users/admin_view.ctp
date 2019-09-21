<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('User');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($user['User']['id']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCA No'); ?></dt>
        <dd>
            <?php echo h($user['User']['bca_no']); ?> &nbsp;
        </dd>
        <dt><?php echo __('User Name'); ?></dt>
        <dd>
            <?php echo h($user['User']['username']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd>
            <?php echo h($user['User']['email']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Active?'); ?></dt>
        <dd>
            <?php echo h($user['User']['active']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Last Login'); ?></dt>
        <dd>
            <?php echo h($user['LastLogin']['last_login']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Login Count'); ?></dt>
        <dd>
            <?php echo h($user['LastLogin']['login_count']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('Forename'); ?></dt>
        <dd>
            <?php echo h($user['User']['forename']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Surname'); ?></dt>
        <dd>
            <?php echo h($user['User']['surname']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Short Name'); ?></dt>
        <dd>
            <?php echo h($user['User']['short_name']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Position'); ?></dt>
        <dd>
            <?php echo h($user['User']['position']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Organisation'); ?></dt>
        <dd>
            <?php echo h($user['User']['organisation']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('BCA Status'); ?></dt>
        <dd>
            <?php echo h($user['User']['bca_status']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Class'); ?></dt>
        <dd>
            <?php echo h($user['User']['class']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Class Code'); ?></dt>
        <dd>
            <?php echo h($user['User']['class_code']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Insurance Status'); ?></dt>
        <dd>
            <?php echo h($user['User']['insurance_status']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Date Of Expiry'); ?></dt>
        <dd>
            <?php echo h($user['User']['date_of_expiry']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('Address'); ?></dt>
        <dd>
            <?php echo h($user['User']['address1']); ?> &nbsp;
        </dd>
        <dt><?php echo __('&nbsp;'); ?></dt>
        <dd>
            <?php echo h($user['User']['address2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('&nbsp;'); ?></dt>
        <dd>
            <?php echo h($user['User']['address3']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Town/City'); ?></dt>
        <dd>
            <?php echo h($user['User']['town']); ?> &nbsp;
        </dd>
        <dt><?php echo __('County/Region'); ?></dt>
        <dd>
            <?php echo h($user['User']['county']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Postcode'); ?></dt>
        <dd>
            <?php echo h($user['User']['postcode']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Country'); ?></dt>
        <dd>
            <?php echo h($user['User']['country']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Telephone'); ?></dt>
        <dd>
            <?php echo h($user['User']['telephone']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Website'); ?></dt>
        <dd>
            <?php echo h($user['User']['website']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('Gender'); ?></dt>
        <dd>
            <?php echo h($user['User']['gender']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Year of Birth'); ?></dt>
        <dd>
            <?php echo h($user['User']['year_of_birth']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('Addr OK?'); ?></dt>
        <dd>
            <?php echo h($user['User']['address_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Allow Club Update?'); ?></dt>
        <dd>
            <?php echo h($user['User']['allow_club_updates']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Admin Email OK?'); ?></dt>
        <dd>
            <?php echo h($user['User']['admin_email_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCA Email OK?'); ?></dt>
        <dd>
            <?php echo h($user['User']['bca_email_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCRA Email OK?'); ?></dt>
        <dd>
            <?php echo h($user['User']['bcra_email_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Roles'); ?></dt>
        <dd>
            <?php echo h($user['User']['roles']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Same Person?'); ?></dt>
        <dd>
            <?php echo h($user['User']['same_person']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('BCRA Member'); ?></dt>
        <dd>
            <?php echo h($user['User']['bcra_member']); ?> &nbsp;
        </dd>
        <dt><?php echo __('CCC Member'); ?></dt>
        <dd>
            <?php echo h($user['User']['ccc_member']); ?> &nbsp;
        </dd>
        <dt><?php echo __('CNCC Member'); ?></dt>
        <dd>
            <?php echo h($user['User']['cncc_member']); ?> &nbsp;
        </dd>
        <dt><?php echo __('CSCC Member'); ?></dt>
        <dd>
            <?php echo h($user['User']['cscc_member']); ?> &nbsp;
        </dd>
        <dt><?php echo __('DCA Member'); ?></dt>
        <dd>
            <?php echo h($user['User']['dca_member']); ?> &nbsp;
        </dd>
        <dt><?php echo __('DCUC Member'); ?></dt>
        <dd>
            <?php echo h($user['User']['dcuc_member']); ?> &nbsp;
        </dd>
        <dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($user['User']['created']); ?> &nbsp;
        </dd>

        <dt><?php echo __('Last Modified'); ?></dt>
        <dd>
            <?php echo h($user['User']['modified']); echo __(' GMT'); ?> &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id']))); ?>
        <?php echo $this->Menu->item(null, $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Form->postLink(__('Sync User'), array('action' => 'sync_duplicates', $user['User']['id']), null, __('Are you sure you want to sync duplicate users?'))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Form->postLink(__('Email Update To Admin'), array('action' => 'send_email_update_to_admin', $user['User']['id']), null, __('Are you sure you want to send an email update request to the BCA Membership Admin?'))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Form->postLink(__('Address Update To Admin'), array('action' => 'send_address_update_to_admin', $user['User']['id']), null, __('Are sure you want to send an address update request to the BCA Membership Admin?'))); ?>
        <?php echo $this->Menu->item(null, $this->Form->postLink(__('Mark Deceased'), array('action' => 'mark_deceased', $user['User']['id']), null, __('Are you sure %s (%s) has died?', $user['User']['full_name'], $user['User']['id']))); ?>
        <?php echo $this->Menu->item('Admin', $this->Html->link(__('Become User'), array('action'=>'become_user', $user['User']['id']))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Return'), array('action' => 'index'))); ?>
     </ul>
</div>
