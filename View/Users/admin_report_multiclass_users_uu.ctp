<div class="ImportedUsers form">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Report of Multiclass Users'); ?></h2>

    <p>This report shows the user records that are erroneously in both Individual and Group classes.</p>

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
    <tr><th>BCA No.</th><th>Master</th><th>Master 2</th></tr>
    <?php $last_bca_no = 0; ?>
    <?php for ($c1 = 0; $c1 < $line_count; $c1++) { ?>
        <?php
            // Separate different members with a blank row.
            if ($last_bca_no != $multiclassLines[$c1]['User']['bca_no'] && $last_bca_no != 0 ) {
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            };
            $last_bca_no = $multiclassLines[$c1]['User']['bca_no'];
        ?>
        <tr>
        <td>
            <?php echo $multiclassLines[$c1]['User']['bca_no']; ?>
        </td>
        <td>
        <?php
            echo $multiclassLines[$c1]['User']['class']." - ".
            $multiclassLines[$c1]['User']['forename']." ".
            $multiclassLines[$c1]['User']['surname']." / ".
            $multiclassLines[$c1]['User']['organisation'];
        ?>
        </td>
        <td>
        <?php
            echo $multiclassLines[$c1]['User2']['class']." - ".
            $multiclassLines[$c1]['User2']['forename']." ".
            $multiclassLines[$c1]['User2']['surname']." / ".
            $multiclassLines[$c1]['User2']['organisation'];
        ?>
        </td>
        </tr>
    <?php } ?>
    </table>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Send As Email'), array('action'=>'email_multiclass_users_uu')); ?> </li>
        <li><?php echo $this->Html->link(__('Return'), array('action'=>'index')); ?> </li>
    </ul>
</div>