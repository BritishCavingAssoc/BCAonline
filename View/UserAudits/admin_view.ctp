<div class="userAudits view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('User Audits');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['id']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Audit Datetime'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['audit_datetime']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Audit User'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['audit_user']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Audit Type'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['audit_type']); ?> &nbsp;
        </dd>
        <dt><?php echo __('User Name'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['username']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Active'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['active']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['email']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Email Status'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['email_status']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Forename'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['forename']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Surname'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['surname']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Organisation'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['organisation']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Short Name'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['short_name']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Position'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['position']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCA Status'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['bca_status']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCA No'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['bca_no']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Class'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['class']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Class Code'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['class_code']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Insurance Status'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['insurance_status']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Date Of Expiry'); ?></dt>
        <dd>
        <?php echo h($userAudit['UserAudit']['date_of_expiry']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Address'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['address1']); ?> &nbsp;
        </dd>
        <dt><?php echo __('&nbsp;'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['address2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('&nbsp;'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['address3']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Town/City'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['town']); ?> &nbsp;
        </dd>
        <dt><?php echo __('County/Region'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['county']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Postcode'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['postcode']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Country'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['country']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Telephone'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['telephone']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Addr OK?'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['address_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Allow Club Update?'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['allow_club_updates']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Admin Email OK?'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['admin_email_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCA Email OK?'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['bca_email_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCRA Email OK?'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['bcra_email_ok']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Forename 2'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['forename2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Surname 2'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['surname2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('BCA No 2'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['bca_no2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Insurance Status 2'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['insurance_status2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Class Code 2'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['class_code2']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['created']); ?> &nbsp;
        </dd>
        <dt><?php echo __('Last Modified'); ?></dt>
        <dd>
            <?php echo h($userAudit['UserAudit']['modified']); echo __(' GMT'); ?> &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php if ($task_admin) echo $this->Html->link(__('Compare'), array('action' => 'compare', $userAudit['UserAudit']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
     </ul>
</div>
