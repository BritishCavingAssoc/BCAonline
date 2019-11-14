<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Your Group Membership Profile');?></h2>

    <?php
    if ($user_count > 1) {
        echo "<p>You have multiple profiles.</p>";
        echo "<p>For more information see ". $this->Html->link(__('Profiles Explained'), array('action'=>'profiles_explained')) .".</p>";
        echo "<p>If you have any questions please contact the " . $this->Html->link(__('Members\'s Area Administrator'),
            'mailto:members.area@british-caving.org.uk?subject=Members Area query from ' .
            $id_name . ' (Ref: ' . $bca_no . ')', array('class' =>'view')) . ".</p>";
    }
    ?>
    <?php
    foreach ($users as $user): ?>
        <hr>
        <dl>
            <!-- <dt><?php echo __('Id'); ?></dt>
            <dd>
                <?php echo h($user['User']['id']); ?> &nbsp;
            </dd> -->
            <dt><?php echo __('Member No.'); ?></dt>
            <dd>
                <?php echo h($user['User']['bca_no']); ?> &nbsp;
            </dd>
            <!-- <dt><?php echo __('User Name'); ?></dt>
            <dd>
                <?php echo h($user['User']['username']); ?> &nbsp;
            </dd> -->
            <dt><?php echo __('Organisation'); ?></dt>
            <dd>
                <?php echo h($user['User']['organisation']); ?> &nbsp;
            </dd>
            <dt><?php echo __('Full Name'); ?></dt>
            <dd>
                <?php echo h($user['User']['full_name']); ?> &nbsp;
            </dd>
            <dt><?php echo __('Position'); ?></dt>
            <dd>
                <?php echo h($user['User']['position']); ?> &nbsp;
            </dd>
            <dt><?php echo __('Email'); ?></dt>
            <dd>
                <?php echo h($user['User']['email']); ?> &nbsp;
            </dd>
            <dt>&nbsp;</dt>
            <dd>&nbsp;</dd>
            <dt><?php echo __('BCA Status'); ?></dt>
            <dd>
                <?php echo h($user['User']['bca_status']); ?> &nbsp;
            </dd>
            <dt><?php echo __('Class Code'); ?></dt>
            <dd>
                <?php echo h($user['User']['class_code']); ?> &nbsp;
            </dd>
            <dt><?php echo __('Insurance Status'); ?></dt>
            <dd>
                <?php echo h($user['User']['insurance_status']); ?> &nbsp;
            </dd>
            <dt><?php echo __('Expiry Date'); ?></dt>
            <dd>
                <?php
                    list($y, $m, $d) = sscanf($user['User']['date_of_expiry'], '%d-%d-%d');
                    echo h("$d/$m/$y");
                ?> &nbsp;
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
            <dt>&nbsp;</dt>
            <dd><strong>Regional Council Join/Renewal Requests:</strong></dd>
            <!-- <dt><?php echo __('BCRA Member'); ?></dt>
            <dd>
                <?php echo h($user['User']['bcra_member']); ?> &nbsp;
            </dd> -->
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
        </dl>
    <?php
    endforeach; ?>
</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Update Email'), array('action' => 'email_update')); ?> </li>
        <li><?php echo $this->Html->link(__('Update Password'), array('action' => 'password_update')); ?> </li>
        <li><?php echo $this->Html->link(__("Profile FAQ"), array('action'=>'profile_faq')); ?> </li>
        <li><?php echo $this->Html->link(__("Return"), array('action'=>'members_area')); ?> </li>
    </ul>
    <p>These are the details we hold for you. Please check they are correct.</p>
</div>
