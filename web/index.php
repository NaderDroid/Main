
<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once 'Twilio/autoload.php'; // Loads the library

use Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "ACc2d739e84d677db9f286438ec8441bc2";
$token = "149c5535473312e2e75c2023d6fbe6cb";
$client = new Client($sid,$token);

$client->messages
    ->create(
        "+19173885926",
        array(
            "from" => "+17732577791",
            "body" => "This Message is being sent from Nader using Twilio!"
        )
    );
echo "Massage has been sent successfully";


