<?php

$mismatchedLinesCount = count($mismatchedLines);

echo <<<EOT
Dear {$full_name},

These are the mismatching names comparing the imported user data to the imported user data.

There are ${mismatchedLinesCount} row(s).


EOT;

$last_bca_no = 0;

foreach ($mismatchedLines as $line => $detail) {

    // Separate different members with a blank row.
    if ($last_bca_no != $detail['ImportedUser']['bca_no'] && $last_bca_no != 0 ) echo "\n";

    $last_bca_no = $detail['ImportedUser']['bca_no'];

    echo $detail['ImportedUser']['bca_no'] . ": " .
        $detail['ImportedUser']['forename'] . " " .
        $detail['ImportedUser']['surname'] . " - " .
        $detail['ImportedUser']['organisation'] . " / " .
        $detail['ImportedUser']['email'] . " / " .
        $detail['ImportedUser']['class']. " / " .
        $detail['ImportedUser']['address1']. " / " .
        $detail['ImportedUser']['address2']. "\n";
}

echo "\n";

?>