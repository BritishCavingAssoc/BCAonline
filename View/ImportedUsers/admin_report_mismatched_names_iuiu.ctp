<div class="ImportedUsers form">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report of Mismatched Imported User Names'); ?></h2>

    <p>This report shows the imported user records where the name doesn't match their other imported user records.</p>
    <p>In an ideal world there shouldn't be any but different organisations can record names differently.</p>

    <h3><?php
        $line_count = count($mismatchedLines);
        if ($line_count == 0) {
            echo "There are no mismatched names.";
        } elseif ($line_count == 1) {
            echo "There is 1 mismatched name.";
        } else {
            echo "There are $line_count mismatched name records.";
        }
    ?></h3>

    <table>
    <tr><th>Action</th><th>BCA No.</th><th>User</th></tr>
    <?php $last_bca_no = 0; ?>
    <?php for ($c1 = 0; $c1 < $line_count; $c1++) { ?>
        <?php
            // Separate different members with a blank row.
            if ($last_bca_no != $mismatchedLines[$c1]['ImportedUser']['bca_no'] && $last_bca_no != 0 ) {
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            };
            $last_bca_no = $mismatchedLines[$c1]['ImportedUser']['bca_no'];
        ?>
        <tr>
        <td class="actions">
            <?php
                echo $this->Form->postLink(__('Delete'), array('action' => 'delete_mismatched_iuiu', $mismatchedLines[$c1]['ImportedUser']['bca_no']),
                null, __('Do you want to remove records with BCA# %s from the import?', $mismatchedLines[$c1]['ImportedUser']['bca_no']));
            ?>
        </td>
        <td>
            <?php echo $mismatchedLines[$c1]['ImportedUser']['bca_no']; ?>
        </td>
        <td>
        <?php
            echo $mismatchedLines[$c1]['ImportedUser']['forename'] . " " .
            $mismatchedLines[$c1]['ImportedUser']['surname'] . " - " .
            $mismatchedLines[$c1]['ImportedUser']['organisation'] . "/" .
            $mismatchedLines[$c1]['ImportedUser']['class'] . "/" .
            $mismatchedLines[$c1]['ImportedUser']['email']. "/" .
            $mismatchedLines[$c1]['ImportedUser']['address1']. "/" .
            $mismatchedLines[$c1]['ImportedUser']['address2'];
        ?>
        </td>
        </tr>
    <?php } ?>
    </table>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action'=>'index')); ?> </li>
        <li><?php if ($line_count <> 0) { echo $this->Form->postLink(__('Tidy'), array('action' => 'tidy_mismatched_names_iuiu'), null,
        __('Are you sure you remove all the mismatched records?'));} ?></li>
    </ul>
</div>