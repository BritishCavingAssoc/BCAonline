<?php

$multiclassLinesCount = count($multiclassLines);

echo <<<EOT
Dear {$full_name},

These are the multiclass members in the master database.

There are ${multiclassLinesCount} row(s).


EOT;

foreach ($multiclassLines as $line => $detail) {

    echo $detail['User']['bca_no']." Master: ".
        $detail['User']['forename']." ".
        $detail['User']['surname']." - ".
        $detail['User']['organisation']." / ".
        $detail['User']['class']."\n";

    echo $detail['User2']['bca_no']." Master2: ".
        $detail['User2']['forename']." ".
        $detail['User2']['surname']." - ".
        $detail['User2']['organisation']." / ".
        $detail['User2']['class']."\n\n";
}

echo "\n";

?>