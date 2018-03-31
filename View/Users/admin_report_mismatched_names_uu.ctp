<div class="Users form">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report of Mismatched User Names'); ?></h2>

    <p>This report shows the user records where the name doesn't match their other user records.</p>
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
    <tr><th>BCA No.</th><th>User</th></tr>
    <?php $last_bca_no = 0; ?>
    <?php for ($c1 = 0; $c1 < $line_count; $c1++) { ?>
        <?php
            // Separate different members with a blank row.
            if ($last_bca_no != $mismatchedLines[$c1]['User']['bca_no'] && $last_bca_no != 0 ) {
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
            };
            $last_bca_no = $mismatchedLines[$c1]['User']['bca_no'];
        ?>
        <tr>
        <td>
            <?php echo $mismatchedLines[$c1]['User']['bca_no']; ?>
        </td>
        <td>
        <?php
            echo $mismatchedLines[$c1]['User']['forename'] . " " .
            $mismatchedLines[$c1]['User']['surname'] . " - " .
            $mismatchedLines[$c1]['User']['organisation'] . "/" .
            $mismatchedLines[$c1]['User']['class'] . "/" .
            $mismatchedLines[$c1]['User']['email']. "/" .
            $mismatchedLines[$c1]['User']['address1']. "/" .
            $mismatchedLines[$c1]['User']['address2'];
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
    </ul>
</div>