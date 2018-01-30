<div class="userAudits view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('User Audits Compare To Adjacent');?></h2>

<table>
<tr><th>Field</th><th>Selected</th><th>Next</th></tr>
<?php

    foreach ($lines as $line) {
        echo "<tr>";
        echo "<td>{$line[0]}:</td><td><div class='show_old'>{$line[1]}</div></td><td><div class='show_new'>{$line[1]}</div></td>";
        echo "</tr>";
    }
?>
</table>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Next'), array('action' => 'compare_adjacent', $next_id)); ?><li>
        <li><?php echo $this->Html->link(__('Previous'), array('action' => 'compare_adjacent', $previous_id)); ?><li>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index')); ?> </li>
     </ul>
</div>
