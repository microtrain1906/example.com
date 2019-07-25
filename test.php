<?php
# Include the Autoloader (see "Libraries" for install instructions)
require '../config/keys.php';
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun(MG_KEY);
$domain = MG_DOMAIN;

# Make the call to the client.
$from = "Mailgun Sandbox <postmaster@{$domain}>";
$to = 'Chad Svastisalee <chad@killer-sites.com>';
$subject = 'Hello Chad';
$text = 'Congratulations Chad, you just sent an email with Mailgun! You are truly awesome!';

$result = $mgClient->sendMessage(
  $domain,
  array('from'    => $from,
        'to'      => $to,
        'subject' => $subject,
        'text'    => $text
    )
);