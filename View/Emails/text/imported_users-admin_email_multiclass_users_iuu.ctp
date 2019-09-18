<?php

$multiclassLinesCount = count($multiclassLines);

echo <<<EOT
Dear {$full_name},

These are the multiclass users that are erroneously in both Individual and Group classes comparing the imported user data to the master data.

There are ${multiclassLinesCount} row(s).


EOT;

foreach ($multiclassLines as $line => $detail) {

    echo $detail['ImportedUser']['bca_no']." Import: ".
        $detail['ImportedUser']['forename']." ".
        $detail['ImportedUser']['surname']." - ".
        $detail['ImportedUser']['organisation']." / ".
        $detail['ImportedUser']['class']."\n";

    echo $detail['User']['bca_no']." Master: ".
        $detail['User']['forename']." ".
        $detail['User']['surname']." - ".
        $detail['User']['organisation']." / ".
        $detail['User']['class']."\n\n";
}

echo "\n";

?>