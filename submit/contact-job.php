<?php
    require_once('common.inc.php');

    sanitize_post('contact-job');

    $headers  = "From: ".FROM_ADDRESS;
    $headers .= "\r\nReply-To: ".FROM_ADDRESS; 
    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".RANDOM_HASH."\""; 

    $body = '';
    $body .= '--PHP-alt-'.RANDOM_HASH.PHP_EOL;
    $body .= 'Content-Type: text/plain; charset="iso-8859-1"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL;

    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= '| Job Contact Request'.PHP_EOL;
    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Job Details'.PHP_EOL;
    $body .= SPACER.str_pad('Job ID', PAD).$_POST['jid'].PHP_EOL;
    $body .= SPACER.str_pad('Job Link', PAD).'http://'.$_SERVER['SERVER_NAME'].str_replace('submit/contact-job.php', 'wp-admin/post.php?post='.$_POST['jid'].'&action=edit', $_SERVER['REQUEST_URI']).PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Contact & Details'.PHP_EOL;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['job-fullname'].PHP_EOL;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['job-email'].PHP_EOL;
    $body .= SPACER.str_pad('Intersection: ', PAD).$_POST['job-intersection'].PHP_EOL;
    $body .= SPACER.str_pad('Age of Children: ', PAD).$_POST['job-age'].PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Days / Hours'.PHP_EOL;
    $body .= SPACER.str_pad('Sunday', PAD).'['.(isset($_POST['job-days'][1]) ? 'X' : ' ').'] '.$_POST['job-hours'][1].PHP_EOL;
    $body .= SPACER.str_pad('Monday', PAD).'['.(isset($_POST['job-days'][2]) ? 'X' : ' ').'] '.$_POST['job-hours'][2].PHP_EOL;
    $body .= SPACER.str_pad('Tuesday', PAD).'['.(isset($_POST['job-days'][3]) ? 'X' : ' ').'] '.$_POST['job-hours'][3].PHP_EOL;
    $body .= SPACER.str_pad('Wednesday', PAD).'['.(isset($_POST['job-days'][4]) ? 'X' : ' ').'] '.$_POST['job-hours'][4].PHP_EOL;
    $body .= SPACER.str_pad('Thursday', PAD).'['.(isset($_POST['job-days'][5]) ? 'X' : ' ').'] '.$_POST['job-hours'][5].PHP_EOL;
    $body .= SPACER.str_pad('Friday', PAD).'['.(isset($_POST['job-days'][6]) ? 'X' : ' ').'] '.$_POST['job-hours'][6].PHP_EOL;
    $body .= SPACER.str_pad('Saturday', PAD).'['.(isset($_POST['job-days'][7]) ? 'X' : ' ').'] '.$_POST['job-hours'][7].PHP_EOL;
    $body .= PHP_EOL;

    $body .= '--PHP-alt-'.RANDOM_HASH.'--'.PHP_EOL;
die('<pre>'.$body);
/*
    $attachment = chunk_split(base64_encode(file_get_contents($_FILES['crf-resume']['tmp_name'])));
    $body .= '--PHP-mixed-'.RANDOM_HASH.PHP_EOL;
    $body .= 'Content-Type: application/zip; name="attachment.zip"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: base64'.PHP_EOL;
    $body .= 'Content-Disposition: attachment'.PHP_EOL;
    $body .= $attachment;
    $body .= '--PHP-mixed-'.RANDOM_HASH.'--'.PHP_EOL;
*/
    $mail_sent = mail(RICHELLE, 'Job Contact Request', $body, $headers);
    
    header('Location: '.THANK_YOU_PAGE);
    die();