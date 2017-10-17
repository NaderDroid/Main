<?php
// Code for Twilio Support Document: https://support.twilio.com/hc/en-us/articles/223134267-Building-an-SMS-Keyword-Response-Application
// Get the PHP helper library from twilio.com/docs/php/install
require '../vendor/autoload.php'; // Loads the library. This may vary depending on how you installed the library.
use Twilio\Rest\Client;

/*
** Your Account Sid and Auth Token from twilio.com/user/account
*/
$sid = "ACc2d739e84d677db9f286438ec8441bc2";
$token = "149c5535473312e2e75c2023d6fbe6cb";
$client = new Client($sid, $token);

/*
** Array of response messages, to represent the function of a database.
*/
$responseMessages = array(
    'monkey'    => array('body' => 'Monkey. A small to medium-sized primate that typically has a long tail, most kinds of which live in trees in tropical countries.',
        'media' => 'https://cdn.pixabay.com/photo/2016/02/12/23/49/scented-monkey-1197100_960_720.jpg'),
    'dog'       => array('body' => 'Dog. A domesticated carnivorous mammal that typically has a long snout, an acute sense of smell, and a barking, howling, or whining voice.',
        'media' => 'https://cdn.pixabay.com/photo/2016/10/15/12/01/dog-1742295_960_720.jpg'),
    'pigeon'   => array('body' => 'Pigeon. A stout seed- or fruit-eating bird with a small head, short legs, and a cooing voice, typically having gray and white plumage.',
        'media' => 'https://cdn.pixabay.com/photo/2016/11/17/21/12/pigeon-1832742_960_720.jpg'),
    'owl'       => array('body' => 'Owl. A nocturnal bird of prey with large forward-facing eyes surrounded by facial disks, a hooked beak, and typically a loud call.',
        'media' => 'https://cdn.pixabay.com/photo/2013/02/04/20/48/owl-77894_960_720.jpg')
);

/*
** Default response message when receiving a message without key words.
*/
$defaultMessage = "Reply with one of the following keywords: monkey, dog, pigeon, owl.";

/*
** Read the contents of the incoming message fields.
*/
$body = $_REQUEST['Body'];
$to = $_REQUEST['+13479719279'];
$from = $_REQUEST['+17732577791'];

/*
** Remove formatting from $body until it is just lowercase
** characters without punctuation or spaces.
*/
$result = preg_replace("/[^A-Za-z0-9]/u", " ", $body);
$result = trim($result);
$result = strtolower($result);
$sendDefault = true; // Default message is sent unless key word is found in following loop.

/*
** Choose the correct message response and set default to false.
*/
foreach ($responseMessages as $animal => $messages) {
    if ($animal == $result) {
        $body = $messages['body'];
        $media = $messages['media'];
        $sendDefault = false;
    }
}

// Send the correct response message.
if ($sendDefault != false) {
    $client->messages->create(
        $to,
        array(
            'from' => $from,
            'body' => $defaultMessage,
        )
    );
} else {
    $client->messages->create(
        $to,
        array(
            'from' => $from,
            'body' => $body,
            'mediaUrl' => $media,
        )
    );
}
echo "Here for needy";
