<?php
    require_once('../wp-load.php');
    require_once('common.inc.php');

    bbn_sanitize_post('contact-family');

    $headers[] = "From: ".$_POST['ns-email']." <".$_POST['ns-email'].">\r\n";

    $body = '';
    $body .= '-----------------------------------------------------'.BR;
    $body .= '| Family Contact Request'.BR;
    $body .= '-----------------------------------------------------'.BR;
    $body .= BR;
    $body .= '<strong>Family Details</strong>'.BR;
    $body .= SPACER.str_pad('Family ID: ', PAD).$_POST['fid'].BR;
    $body .= SPACER.str_pad('Family Link: ', PAD).'http://'.$_SERVER['SERVER_NAME'].str_replace('submit/contact-family.php', 'wp-admin/post.php?post='.$_POST['fid'].'&action=edit', $_SERVER['REQUEST_URI']).BR;
    $body .= BR;
    $body .= '<strong>Contact & Details</strong>'.BR;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['ns-fullname'].BR;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['ns-email'].BR;
    $body .= SPACER.str_pad('Intersection: ', PAD).$_POST['ns-intersection'].BR;
    $body .= SPACER.str_pad('Age of Children: ', PAD).$_POST['ns-age'].BR;
    $body .= BR;
    $body .= '<strong>Days / Hours</strong>'.BR;
    $body .= SPACER.str_pad('Monday', PAD).'['.(isset($_POST['ns-days'][2]) ? 'X' : ' ').'] '.$_POST['ns-hours'][2].BR;
    $body .= SPACER.str_pad('Tuesday', PAD).'['.(isset($_POST['ns-days'][3]) ? 'X' : ' ').'] '.$_POST['ns-hours'][3].BR;
    $body .= SPACER.str_pad('Wednesday', PAD).'['.(isset($_POST['ns-days'][4]) ? 'X' : ' ').'] '.$_POST['ns-hours'][4].BR;
    $body .= SPACER.str_pad('Thursday', PAD).'['.(isset($_POST['ns-days'][5]) ? 'X' : ' ').'] '.$_POST['ns-hours'][5].BR;
    $body .= SPACER.str_pad('Friday', PAD).'['.(isset($_POST['ns-days'][6]) ? 'X' : ' ').'] '.$_POST['ns-hours'][6].BR;
    $body .= BR;

    $mail_sent = bbn_mail(RICHELLE, 'Family Contact Request', $body, $headers);
    
    header('Location: '.THANK_YOU_PAGE);
    die();