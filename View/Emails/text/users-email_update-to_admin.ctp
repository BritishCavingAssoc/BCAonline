<?php

echo <<<EOT
Dear Administrator,

This email is to let you know that the email address for member {$bca_no} ({$id_name} / {$organisation} / ${class}) has been updated to:

{$new_email}

Please update your records accordingly.

EOT;
?>