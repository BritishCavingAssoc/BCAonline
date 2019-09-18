<?php

echo <<<EOT
Dear {$id_name},

This email is to let you know that the following changes have been made to your BCA Online profile.

The changes have been made by the BCA Membership Administrator using the information supplied by you or by your caving club.

If they are incorrect please contact your club in the first instance or the BCA Membership Administrator ({$membership_admin_email}) otherwise.

We may adjust your address in order to harmonize it with the post office address file.

EOT;

echo "\nNOW:-\n";
foreach ($changes as $key => $value) echo "{$key}:  {$value}\n";

echo "\nPREVIOUSLY:-\n";
foreach ($previous as $key => $value) echo "{$key}:  {$value}\n";

echo "\n";
?>