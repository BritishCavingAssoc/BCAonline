<?php

echo <<<EOT
Dear Administrator,

This email is to let you know that the address for member {$bca_no} ({$id_name} / {$organisation} / ${class}) has been updated to:

Address1/Building: {$new_address['address1']}
Address2/Street:   {$new_address['address2']}
Address3/Local:    {$new_address['address3']}
Town:              {$new_address['town']}
County:            {$new_address['county']}
Postcode:          {$new_address['postcode']}
Country:           {$new_address['country']}

Please update your records accordingly.

EOT;
?>