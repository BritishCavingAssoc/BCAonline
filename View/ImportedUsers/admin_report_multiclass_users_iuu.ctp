<div class="ImportedUsers form">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report of Multiclass Users'); ?></h2>

    <p>This report shows the imported user records that are erroneously in both Individual and Group classes.</p>

    <h3><?php
        $line_count = count($multiclassLines);
        if ($line_count == 0) {
            echo "There are no multiclass names.";
        } elseif ($line_count == 1) {
            echo "There is 1 multiclass name.";
        } else {
            echo "There are $line_count multiclass name records.";
        }
    ?></h3>

    <table>
    <tr><th>Action</th><th>BCA No.</th><th>Import</th><th>Master</th></tr>
    <?php $last_bca_no = 0; ?>
    <?php for ($c1 = 0; $c1 < $line_count; $c1++) { ?>
        <tr>
        <td class="actions">
            <?php
                echo $this->Form->postLink(__('Delete'), array('action' => 'delete_multiclass_users_iuu', $multiclassLines[$c1]['ImportedUser']['bca_no']),
                null, __('Do you want to remove records with BCA# %s from the import?', $multiclassLines[$c1]['ImportedUser']['bca_no']));
            ?>
        </td>
        <td>
            <?php echo $multiclassLines[$c1]['ImportedUser']['bca_no']; ?>
        </td>
        <td>
        <?php
            echo $multiclassLines[$c1]['ImportedUser']['class']." - ".
            $multiclassLines[$c1]['ImportedUser']['forename']." ".
            $multiclassLines[$c1]['ImportedUser']['surname']." / ".
            $multiclassLines[$c1]['ImportedUser']['organisation'];
        ?>
        </td>
        <td>
        <?php
            echo $multiclassLines[$c1]['User']['class']." - ".
            $multiclassLines[$c1]['User']['forename']." ".
            $multiclassLines[$c1]['User']['surname']." / ".
            $multiclassLines[$c1]['User']['organisation'];
        ?>
        </td>
        </tr>
    <?php } ?>
    </table>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php if ($line_count <> 0) {echo $this->Html->link(__('Send As Email'), array('action'=>'email_multiclass_users_iuu'));} ?> </li>
        <li><?php if ($line_count <> 0) {echo $this->Form->postLink(__('Tidy'), array('action' => 'tidy_multiclass_users_iuu'), null,
        __('Are you sure you remove all the multiclass records?'));} ?></li>
        <li><?php echo $this->Html->link(__('Return'), array('action'=>'index')); ?> </li>
    </ul>
</div>