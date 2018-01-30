<?php

echo <<<EOT
Dear {$full_name},

This email is to let you know that your BCA email address has been changed to '{$new_email}'.

If you recognise the email address but it is wrong please login to your account on the BCA website to correct it. Please inform your club as well if that is appropriate.

If you do not recognise the email address, login to your account on the BCA website to correct the email address and update your password as a security measure. Also contact the BCA Online Administrator {$bca_online_admin_email} as soon as possible.

EOT;

?>