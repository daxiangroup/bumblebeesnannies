<?php
    require_once('../wp-load.php');
    require_once('common.inc.php');

    bbn_sanitize_post('contact');

    $headers[] = "From: ".$_POST['con-email']." <".$_POST['con-email'].">\r\n";

    $body = '';
    $body .= '-----------------------------------------------------'.BR;
    $body .= '| Website Contact Submission'.BR;
    $body .= '-----------------------------------------------------'.BR;
    $body .= BR;
    $body .= '<strong>Contact Details</strong>'.BR;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['con-fullname'].BR;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['con-email'].BR;
    $body .= SPACER.str_pad('Message: ', PAD).BR;
    $body .= $_POST['con-message'].BR;
    $body .= BR;

    $mail_sent = bbn_mail(RICHELLE, 'Website Contact: '.$_POST['con-subject'], $body, $headers);
    
    header('Location: '.THANK_YOU_PAGE);
    die();