<?php

$repeatedLinesCount = count($repeatedLines);

echo <<<EOT
Dear {$full_name},

These are the repeated lines in the imported user data.

There are ${repeatedLinesCount} row(s).


EOT;

for ($c1 = 0; $c1 < $repeatedLinesCount; $c1++) {
    $forenames = explode(",", $repeatedLines[$c1][0]['forenames']);
    $surnames = explode(",", $repeatedLines[$c1][0]['surnames']);

    for ($c2 = 0; $c2 < $repeatedLines[$c1][0]['row_count']; $c2++) {

        echo $repeatedLines[$c1]['ImportedUser']['bca_no'] . " / " .
            $repeatedLines[$c1]['ImportedUser']['organisation'] . " / " .
            $repeatedLines[$c1]['ImportedUser']['class'] . " - " .
            $forenames[$c2]. " " . $surnames[$c2] . "\n";
    }

    echo "\n";
}


?>