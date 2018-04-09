<div class="importedUsers form">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report of Mismatched Imported User Names vs Master Records'); ?></h2>

    <p>This report shows the lines in the imported file which have different names in the master database.</p>
    <p>In an ideal world there shouldn't be any but different organisations can record names differently.</p>

    <h3><?php
        $line_count = count($mismatchedLines);
        if ($line_count == 0) {
            echo "There are no mismatched names.";
        } elseif ($line_count == 1) {
            echo "There is 1 mismatched name.";
        } else {
            echo "There are $line_count mismatched names.";
        }
    ?></h3>

    <table>
    <tr><th>Action</th><th>BCA No.</th><th>Import</th><th>Master</th></tr>
    <?php for ($c1 = 0; $c1 < $line_count; $c1++) { ?>
        <tr>
        <td class="actions">
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_mismatched_iuu', $mismatchedLines[$c1]['ImportedUser']['id']),
            null, __('Do you want to remove %s %s (%s) from the import?', $mismatchedLines[$c1]['ImportedUser']['forename'],
            $mismatchedLines[$c1]['ImportedUser']['surname'], $mismatchedLines[$c1]['ImportedUser']['bca_no'])); ?>
        </td>
        <td>
            <?php echo $mismatchedLines[$c1]['ImportedUser']['bca_no']; ?>
        </td>
        <td>
            <?php echo $mismatchedLines[$c1]['ImportedUser']['forename'] . " " .
            $mismatchedLines[$c1]['ImportedUser']['surname'] . " - " .
            $mismatchedLines[$c1]['ImportedUser']['organisation'] . "/" .
            $mismatchedLines[$c1]['ImportedUser']['class']. "/" .
            $mismatchedLines[$c1]['ImportedUser']['address1']. "/" .
            $mismatchedLines[$c1]['ImportedUser']['address2']. "/" .
            $mismatchedLines[$c1]['ImportedUser']['email']; ?>
        </td>
        <td>
        <?php echo $mismatchedLines[$c1]['User']['forename'] . " " .
            $mismatchedLines[$c1]['User']['surname'] . " - " .
            $mismatchedLines[$c1]['User']['organisation'] . "/" .
            $mismatchedLines[$c1]['User']['class'] . "/" .
            $mismatchedLines[$c1]['User']['address1']. "/" .
            $mismatchedLines[$c1]['User']['address2']. "/" .
            $mismatchedLines[$c1]['User']['email']; ?>
        </tr>
    <?php } ?>
    </table>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action'=>'index')); ?> </li>
        <li><?php if ($line_count <> 0) { echo $this->Form->postLink(__('Tidy'), array('action' => 'tidy_mismatched_names_iuu'), null,
        __('Are you sure you remove all the mismatched records?'));} ?></li>
    </ul>
</div>