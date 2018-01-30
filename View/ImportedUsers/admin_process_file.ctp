<div class="importedUsers form">
    <?php echo $this->Session->flash('auth'); ?>
    <h2><?php echo __('Process Imported Users File'); ?></h2>
    
    <?php //print_r($importedUser); die(); ?>
    <h3>There are <?php echo count($importedUserErrors); ?> row(s) with errors.</h3>
    
    <dl>
        <?php foreach ($importedUserErrors as $line => $errors) { ?>
        <dt>Line: <?php echo $line + 2; ?>
            <?php
            if ($importedUser[$line]['class'] == 'GRP'){
                echo " - " . $importedUser[$line]['organisation'] . " (" . $importedUser[$line]['bca_no'] . ")"; 
            }
            else { //else 'CIM' or 'DIM'
                echo " - " . $importedUser[$line]['forename'] . " " . $importedUser[$line]['surname'] . " (" .
                    $importedUser[$line]['bca_no'] . ")"; 
            }
            ?>
        </dt>
        <dd><?php
            foreach ($errors as $error => $message) {
                echo $error." - ".$message[0]."<br>";
            } 
            ?> &nbsp;
        </dd>
        <?php } ?>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action'=>'index')); ?> </li>
    </ul>
</div>