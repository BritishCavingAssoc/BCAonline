<?php

$importedUserCount = count($importedUserErrors);

echo <<<EOT
Dear {$full_name},

These are the validation errors from attempting to process the Imported User file.

There are ${importedUserCount} row(s) with errors.


EOT;

foreach ($importedUserErrors as $line => $errors) {

    $lineNo = $line + 2;

    if ($importedUser[$line]['class'] == 'GRP') {
        echo "\nLine: ${lineNo} - " . $importedUser[$line]['organisation'] . " (" . $importedUser[$line]['bca_no'] . ")\n";
    } 
    else { //else 'CIM' or 'DIM'.
        echo "\nLine: ${lineNo} - " . $importedUser[$line]['forename'] . " " . $importedUser[$line]['surname'] . " (" .
        $importedUser[$line]['bca_no'] . ")\n";
    }
        
    foreach ($errors as $error => $message) {
        echo "    ${error} - ${message[0]}\n";
    }
}

echo "\n";

?>