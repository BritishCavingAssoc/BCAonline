<?php

$repeatedLinesCount = count($repeatedLines);

echo <<<EOT
Dear {$full_name},

These are the repeated lines of group members in the imported user data.

There are ${repeatedLinesCount} row(s).


EOT;

for ($c1 = 0; $c1 < $repeatedLinesCount; $c1++) {
    $organisations = explode(",", $repeatedLines[$c1][0]['organisations']);

    for ($c2 = 0; $c2 < $repeatedLines[$c1][0]['row_count']; $c2++) {

        echo $repeatedLines[$c1]['ImportedUser']['bca_no'] . " - " . $organisations[$c2] . "\n";
    }

    echo "\n";
}


?>