<?php

echo <<<EOT
Dear {$full_name},

This email is to confirm that your BCA email address has been changed to '{$new_email}'.

The change might have been initiated by your caving club, by the BCA Membership Administrator or by you.

If it is incorrect please login to your account on the BCA website to correct it.

If you do not recognise the email address, login to your account on the BCA website to correct the email address and update your password as a security measure. Also contact the BCA Online Administrator {$bca_online_admin_email} as soon as possible.

EOT;
?>