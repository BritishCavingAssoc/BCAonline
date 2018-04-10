<?php

$mismatchedLinesCount = count($mismatchedLines);

echo <<<EOT
Dear {$full_name},

These are the mismatching names comparing the master user data to the master user data.

There are ${mismatchedLinesCount} row(s).


EOT;

$last_bca_no = 0;

foreach ($mismatchedLines as $line => $detail) {

    // Separate different members with a blank row.
    if ($last_bca_no != $detail['User']['bca_no'] && $last_bca_no != 0 ) echo "\n";

    $last_bca_no = $detail['User']['bca_no'];

    echo $detail['User']['bca_no'] . ": " .
        $detail['User']['forename'] . " " .
        $detail['User']['surname'] . " - " .
        $detail['User']['organisation'] . " / " .
        $detail['User']['class']. " / " .
        $detail['User']['email']. " / " .
        $detail['User']['address1']. " / " .
        $detail['User']['address2'] . "\n";
}

echo "\n";

?>