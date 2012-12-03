<?php
    require_once('common.inc.php');

    $headers  = "From: ".FROM_ADDRESS;
    $headers .= "\r\nReply-To: ".FROM_ADDRESS; 
    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".RANDOM_HASH."\""; 

    $body = '';
    $body .= '--PHP-alt-'.RANDOM_HASH.PHP_EOL;
    $body .= 'Content-Type: text/plain; charset="iso-8859-1"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL;

    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= '| Family Registration Submission'.PHP_EOL;
    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Contact Details'.PHP_EOL;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['frf-fullname'].PHP_EOL;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['frf-email'].PHP_EOL;
    $body .= SPACER.str_pad('Postal Code: ', PAD).$_POST['frf-postal-code'].PHP_EOL;
    $body .= SPACER.str_pad('Contact Number: ', PAD).$_POST['frf-contact-number'].PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Requirements'.PHP_EOL;
    $body .= SPACER.str_pad('Nany', POS_PAD).'['.($_POST['frf-cbx-position']['nanny'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Nany Share', POS_PAD).'['.($_POST['frf-cbx-position']['nanny-share'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('After School Care', POS_PAD).'['.($_POST['frf-cbx-position']['after-school'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Emergency Babysitting', POS_PAD).'['.($_POST['frf-cbx-position']['emergency-babysitting'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Live Out', POS_PAD).'['.($_POST['frf-cbx-position']['live-out'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Permanent', POS_PAD).'['.($_POST['frf-cbx-position']['permanent'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Temporary', POS_PAD).'['.($_POST['frf-cbx-position']['temporary'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Full-time', POS_PAD).'['.($_POST['frf-cbx-position']['full-time'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Part-time', POS_PAD).'['.($_POST['frf-cbx-position']['part-time'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Details'.PHP_EOL;
    $body .= SPACER.str_pad('Age of Children', POS_PAD).$_POST['frf-age-of-children'].PHP_EOL;
    $body .= SPACER.str_pad('Start Date', POS_PAD).$_POST['frf-start-date'].PHP_EOL;
    $body .= SPACER.str_pad('Experience', POS_PAD).$_POST['frf-years-experience'].PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Where did you hear about us'.PHP_EOL;
    $body .= SPACER.str_pad('Today\'s Parent', HEARD_PAD).'['.($_POST['frf-cbx-heard']['todays-parent'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('The Little Paper', HEARD_PAD).'['.($_POST['frf-cbx-heard']['little-paper'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Help We\'ve Got Kids', HEARD_PAD).'['.($_POST['frf-cbx-heard']['help-kids'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Yelp', HEARD_PAD).'['.($_POST['frf-cbx-heard']['yelp'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Google Search', HEARD_PAD).$_POST['frf-google-search'].PHP_EOL;
    $body .= SPACER.str_pad('Recommendation', HEARD_PAD).$_POST['frf-recommendation'].PHP_EOL;
    $body .= SPACER.str_pad('Other', HEARD_PAD).$_POST['frf-other'].PHP_EOL;

    $body .= '--PHP-alt-'.RANDOM_HASH.'--'.PHP_EOL;

    $mail_sent = mail(RICHELLE, 'Family Registration', $body, $headers);
    
    header('Location: '.THANK_YOU_PAGE);
    die();