<div class="users index">
    <?php echo $this->Session->flash('auth'); ?>
    <?php $dataSource = Configure::read('DataSource'); ?>

    <h2><?php echo __('Admin Dashboard');?></h2>
    <p><strong>Host: </strong><?php echo $dataSource['host']; ?></p>
    <p><strong>Database: </strong><?php echo $dataSource['database']; ?></p>

    <p>&nbsp;</p>
    <h3>Current Members</h3>

    <?php
        $total_bca = $table1['Totals']['BCA'] + $table2['Totals']['BCA'];
        $total_bcra = $table1['Totals']['BCRA'] + $table2['Totals']['BCRA'];
        $total_email = $table1['Totals']['EMAIL'] + $table2['Totals']['EMAIL'];
        $total_registered = $table1['Totals']['REGISTERED'] + $table2['Totals']['REGISTERED'];

        $percent_bcra = round($total_bcra/$total_bca * 100, 0);
        $percent_email = round($total_email/$total_bca * 100, 0);
        $percent_registered = round($total_registered/$total_bca * 100, 0);
    ?>
    <p><b>Total BCA Members:&nbsp;<?php echo $total_bca; ?></b></p>
    <p><b>Of which BCRA:&nbsp;<?php echo "$total_bcra ($percent_bcra%)"; ?></b></p>
    <p><b>Has Email:&nbsp;<?php echo "$total_email ($percent_email%)"; ?></b></p>
    <p><b>Registered:&nbsp;<?php echo "$total_registered ($percent_registered%)"?></b></p>

    <table>
    <?php foreach ($table1 as $k => $v){

        echo "<tr>";

        if ($k == 'Title') {
            foreach ($v as $kk => $vv) { echo "<th>$vv</th>"; }

        } else {

            if ($k == 'Totals') $line_type = "th"; else $line_type = "td";

            echo "<$line_type>$k</$line_type>";

            foreach ($v as $kk => $vv) {

                if (empty($table1[$k]['BCA'])) { // Don't devide by zero.
                    $percent = "(-%)";
                } else if ($kk == "BCA") { // Don't have percent for Total BCA column.
                    $percent = "";
                } else if ($vv == 0) { // Don't show 0%.
                    $percent = "";
                } else {
                    $percent = "(". round ($vv/$table1[$k]['BCA'] * 100, 0) ."%)";
                }

                echo "<$line_type>$vv $percent</$line_type>";
            }
        }
        echo "</tr>";
    } ?>
    </table>


    <p>&nbsp;</p>

    <table>
    <?php foreach ($table2 as $k => $v){

        echo "<tr>";

        if ($k == 'Title') {
            foreach ($v as $kk => $vv) { echo "<th>$vv</th>"; }

        } else {

            if ($k == 'Totals') $line_type = "th"; else $line_type = "td";

            echo "<$line_type>$k</$line_type>";

            foreach ($v as $kk => $vv) {

                if (empty($table2[$k]['BCA'])) { // Don't devide by zero.
                    $percent = "(-%)";
                } else if ($kk == "BCA") { // Don't have percent for Total BCA column.
                    $percent = "";
                } else if ($vv == 0) { // Don't show 0%.
                    $percent = "";
                } else {
                    $percent = "(". round ($vv/$table2[$k]['BCA'] * 100, 0) ."%)";
                }

                echo "<$line_type>$vv $percent</$line_type>";
            }
        }
        echo "</tr>";
    } ?>
    </table>


    <p>&nbsp;</p>
    <h3>All Time</h3>

    <p><b>Total Records:&nbsp;<?php echo $table3['Totals']['Total'] + $table3['Totals']['AN']; ?></b></p>

    <table>
    <?php foreach ($table3 as $k => $v){

        echo "<tr>";

        if ($k == 'Title' || $k == 'Totals') {
            if ($k == 'Title') { echo "<th>&nbsp;</th>"; } else { echo "<th>$k</th>"; }
            foreach ($v as $kk => $vv) { echo "<th>$vv</th>"; }
        } else {
            echo "<td>$k</td>";
            foreach ($v as $kk => $vv) { echo "<td>$vv</td>"; }
        }
    } ?>
    </table>


    <p>&nbsp;</p>
    <h3>Aged Last Login</h3>

    <table>
    <tr>
    <th>&nbsp;</th>
    <?php for ($i=1; $i <= 12; $i++) echo "<th>$i</th>"; ?>
    </tr>

    <tr>
    <td>Week</td>
    <?php for ($i=1; $i <= 12; $i++)
        if (empty($table4['week'][$i][0][0]['user_count'])) echo "<td>0</td>"; else echo "<td>". $table4['week'][$i][0][0]['user_count'] ."</td>";
    ?>
    </tr>

    <td>Month</td>
    <?php for ($i=1; $i <= 12; $i++)
        if (empty($table4['month'][$i][0][0]['user_count'])) echo "<td>0</td>"; else echo "<td>". $table4['month'][$i][0][0]['user_count'] ."</td>";
    ?>
    </tr>

    <td>Year</td>
    <?php for ($i=1; $i <= 12; $i++)
        if (empty($table4['year'][$i][0][0]['user_count'])) echo "<td>0</td>"; else echo "<td>". $table4['year'][$i][0][0]['user_count'] ."</td>";
    ?>
    </tr>
    </table>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Menu->item(array('UserEnquiry', 'UserManager', 'UserAdmin'), $this->Html->link(__('Users'), array('controller' => 'Users','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(array('UserEnquiry', 'UserManager', 'UserAdmin'), $this->Html->link(__('User Audit'), array('controller' => 'UserAudits','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Html->link(__('Imported Users'), array('controller' => 'ImportedUsers','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(array('UserEnquiry', 'UserManager', 'UserAdmin'), $this->Html->link(__('Sent Emails'), array('controller' => 'SentEmails','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item('UserAdmin', $this->Html->link(__('Tokens'), array('controller' => 'Tokens','action' => 'index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Members Area'), array('controller' => 'Users','action'=>'members_area', 'admin' => false))); ?>
        <?php echo $this->Menu->item(array('UserAdmin','UserMailingLists','UserBallot'), $this->Html->link(__('Mailing Lists'), array('controller' => 'Users','action'=>'mailing_list_index', 'admin' => true))); ?>
        <?php echo $this->Menu->item(null, $this->Html->link(__('Logout'), array('controller' => 'Users','action'=>'logout', 'admin' => false))); ?>
    </ul>
</div>
