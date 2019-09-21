<?php

echo <<<EOT
Dear {$id_name},

The login details for your BCA Online account were requested from the BCA website.

If you did not request these details, please contact the BCA Online Administrator ({$bca_online_admin_email}).

Your Username is '{$username}'

To set your Password follow this link:

{$token_url}

Once you have set your password you will be able to login using your Username and Password.

EOT;
?>

