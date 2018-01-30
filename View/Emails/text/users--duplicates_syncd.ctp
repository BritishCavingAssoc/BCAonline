<?php

$email_changed = ($primary_email != $email);

echo <<<EOT
Dear {$full_name},

You have multiple BCA Online profiles. This email is to let you know that your other profiles have been updated as well as the primary one.

Multiple profiles could indicate a problem. You should logon to your BCA Online account to review your profiles to makes sure they all relate to you.

The change might have been initiated by your caving club, by the BCA Membership Administrator or by you.

EOT;

if ($password_changed) {
    if ($email_changed) {

//******* Password & email address have changed.
echo <<<EOT

Your email address has been changed to '{$primary_email}'.

If you recognise the email address but it is wrong please login to your account on the BCA website to correct it. Please inform your club as well if that is appropriate.

Your password has been changed.

If you did not change your password or do not recognise the email address, please contact the BCA Online Administrator {$bca_online_admin_email} as soon as possible.

EOT;

    } else {

//******* Only password has changed.
echo <<<EOT

Your password has been changed.

If you did not change your password, please contact the BCA Online Administrator {$bca_online_admin_email} as soon as possible.

EOT;

    }
} else {
    if ($email_changed) {

//******* Password hasn't but email address has changed.
echo <<<EOT

Your email address has been changed to '{$primary_email}'.

If you recognise the email address but it is wrong please login to your account on the BCA website to correct it. Please inform your club as well if that is appropriate.

If you do not recognise the email address, login to your account on the BCA website to correct the email address and update your password as a security measure. Also contact the BCA Online Administrator {$bca_online_admin_email} as soon as possible.

EOT;

    } else {

//*******Neither password or email address have changed.
echo <<<EOT

If you are concerned about this update, please login to your account on the BCA website to check all is correct.

EOT;

    }
}
?>

