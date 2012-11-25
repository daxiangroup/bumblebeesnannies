<?php
    require_once('common.inc.php');

    sanitize_post('contact');

    $headers  = "From: ".$_POST['con-email'];
    $headers .= "\r\nReply-To: ".$_POST['con-email'];
    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".RANDOM_HASH."\""; 

    $body = '';
    $body .= '--PHP-alt-'.RANDOM_HASH.PHP_EOL;
    $body .= 'Content-Type: text/plain; charset="iso-8859-1"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL;

    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= '| Website Contact Submission'.PHP_EOL;
    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Contact Details'.PHP_EOL;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['con-fullname'].PHP_EOL;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['con-email'].PHP_EOL;
    $body .= SPACER.str_pad('Message: ', PAD).PHP_EOL;
    $body .= $_POST['con-message'].PHP_EOL;
    $body .= PHP_EOL;

    $body .= '--PHP-alt-'.RANDOM_HASH.'--'.PHP_EOL;

    $mail_sent = mail(RICHELLE, 'Website Contact: '.$_POST['con-subject'], $body, $headers);
    
    header('Location: '.THANK_YOU_PAGE);
    die();