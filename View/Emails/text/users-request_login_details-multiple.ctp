<?php
 
echo <<<EOT
Dear {$users[0]['full_name']},

The login details for your BCA Online account were requested from the BCA website.

There is more than one account with your email address. The details for each account are given below. 

If you did not request or recognise these details, please contact the BCA Online Administrator ({$users[0]['bca_online_admin_email']}).


To set the password for each account follow each link in turn. Once set you will be able to login using the Usernames and corresponding Password.

If you no longer wish to share the same email address between these accounts you can change the email address for an account by logging into that account and selecting 'Your Profile' and then 'Update Email'.


EOT;

foreach ($users as $user) { 

echo <<<EOT
Name: {$user['full_name']}
Username: {$user['username']}
Password link: {$user['token_url']}


EOT;
}
?>

