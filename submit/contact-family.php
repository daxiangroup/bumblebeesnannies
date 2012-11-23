<?php

    define('SPACER', '   ');
    define('PAD', 20);

    $random_hash = md5(date('r', time()));

    echo '<pre>';
    print_r($_POST);
    print_r($_SERVER);
    echo '</pre>';

    $headers  = "From: web@bumblebeesnannies.com";
    $headers .= "\r\nReply-To: web@bumblebeesnannies.com"; 
    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 

    $body = '';
    $body .= '--PHP-alt-'.$random_hash.PHP_EOL;
    $body .= 'Content-Type: text/plain; charset="iso-8859-1"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL;

    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= '| Family Contact Submission'.PHP_EOL;
    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Family Details'.PHP_EOL;
    $body .= SPACER.str_pad('Family ID', PAD).$_POST['fid'].PHP_EOL;
    $body .= SPACER.str_pad('Family Link', PAD).'http://'.$_SERVER['SERVER_NAME'].str_replace('submit/contact-family.php', 'wp-admin/post.php?post='.$_POST['fid'].'&action=edit', $_SERVER['REQUEST_URI']).PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Contact & Details'.PHP_EOL;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['ns-fullname'].PHP_EOL;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['ns-email'].PHP_EOL;
    $body .= SPACER.str_pad('Intersection: ', PAD).$_POST['ns-intersection'].PHP_EOL;
    $body .= SPACER.str_pad('Age of Children: ', PAD).$_POST['ns-age'].PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Days / Hours'.PHP_EOL;
    $body .= SPACER.str_pad('Sunday', PAD).'['.(isset($_POST['ns-days'][1]) ? 'X' : ' ').'] '.$_POST['ns-hours'][1].PHP_EOL;
    $body .= SPACER.str_pad('Monday', PAD).'['.(isset($_POST['ns-days'][2]) ? 'X' : ' ').'] '.$_POST['ns-hours'][2].PHP_EOL;
    $body .= SPACER.str_pad('Tuesday', PAD).'['.(isset($_POST['ns-days'][3]) ? 'X' : ' ').'] '.$_POST['ns-hours'][3].PHP_EOL;
    $body .= SPACER.str_pad('Wednesday', PAD).'['.(isset($_POST['ns-days'][4]) ? 'X' : ' ').'] '.$_POST['ns-hours'][4].PHP_EOL;
    $body .= SPACER.str_pad('Thursday', PAD).'['.(isset($_POST['ns-days'][5]) ? 'X' : ' ').'] '.$_POST['ns-hours'][5].PHP_EOL;
    $body .= SPACER.str_pad('Friday', PAD).'['.(isset($_POST['ns-days'][6]) ? 'X' : ' ').'] '.$_POST['ns-hours'][6].PHP_EOL;
    $body .= SPACER.str_pad('Saturday', PAD).'['.(isset($_POST['ns-days'][7]) ? 'X' : ' ').'] '.$_POST['ns-hours'][7].PHP_EOL;
    $body .= PHP_EOL;

    $body .= '--PHP-alt-'.$random_hash.'--'.PHP_EOL;

    $mail_sent = mail('ts@daxiangroup.com', 'test message', $body, $headers ); 
    
    header('Location: /bumblebees/thank-you');
    die();
