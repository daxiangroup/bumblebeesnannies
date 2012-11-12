<?php
    define('SPACER', '   ');
    define('PAD', 16);
    define('POS_PAD', 28);
    define('QUAL_PAD', 24);
    define('HEARD_PAD', 28);

    $random_hash = md5(date('r', time()));

    /*
    echo '<pre>';
    print_r($_POST);
    print_r($_FILES);
    echo '</pre>';
    */

    $headers  = "From: web@bumblebeesnannies.com";
    $headers .= "\r\nReply-To: web@bumblebeesnannies.com"; 
    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 

    $body = '';
    $body .= '--PHP-alt-'.$random_hash.PHP_EOL;
    $body .= 'Content-Type: text/plain; charset="iso-8859-1"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL;

    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= '| Caregiver Registration Submission'.PHP_EOL;
    $body .= '-----------------------------------------------------------------'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Contact Details'.PHP_EOL;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['crf-fullname'].PHP_EOL;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['crf-email'].PHP_EOL;
    $body .= SPACER.str_pad('Postal Code: ', PAD).$_POST['crf-postal-code'].PHP_EOL;
    $body .= SPACER.str_pad('Contact Number: ', PAD).$_POST['crf-contact-number'].PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Position'.PHP_EOL;
    $body .= SPACER.str_pad('Nany', POS_PAD).'['.($_POST['crf-cbx-position']['nanny'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Nany Share', POS_PAD).'['.($_POST['crf-cbx-position']['nanny-share'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('After School Care', POS_PAD).'['.($_POST['crf-cbx-position']['after-school'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Emergency Babysitting', POS_PAD).'['.($_POST['crf-cbx-position']['emergency-babysitting'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Live Out', POS_PAD).'['.($_POST['crf-cbx-position']['live-out'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Permanent', POS_PAD).'['.($_POST['crf-cbx-position']['permanent'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Temporary', POS_PAD).'['.($_POST['crf-cbx-position']['temporary'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Full-time', POS_PAD).'['.($_POST['crf-cbx-position']['full-time'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Part-time', POS_PAD).'['.($_POST['crf-cbx-position']['part-time'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Qualifications'.PHP_EOL;
    $body .= SPACER.str_pad('Experience', POS_PAD).$_POST['crf-years-experience'].PHP_EOL;
    $body .= SPACER.str_pad('Details', POS_PAD).$_POST['crf-qualifications'].PHP_EOL.PHP_EOL;
    $body .= SPACER.str_pad('Valid First Aid', QUAL_PAD).'Yes ['.($_POST['crf-rdo-first-aid'] == '1' ? 'X' : ' ').']  No ['.($_POST['crf-rdo-first-aid'] == '0' ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Valid Police Check', QUAL_PAD).'Yes ['.($_POST['crf-rdo-police-check'] == '1' ? 'X' : ' ').']  No ['.($_POST['crf-rdo-police-check'] == '0' ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Drivers License', QUAL_PAD).'Yes ['.($_POST['crf-rdo-drivers-license'] == '1' ? 'X' : ' ').']  No ['.($_POST['crf-rdo-drivers-license'] == '0' ? 'X' : ' ').']'.PHP_EOL;
    $body .= PHP_EOL;
    $body .= 'Where did you hear about us'.PHP_EOL;
    $body .= SPACER.str_pad('Today\'s Parent', HEARD_PAD).'['.($_POST['crf-cbx-heard']['todays-parent'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('The Little Paper', HEARD_PAD).'['.($_POST['crf-cbx-heard']['little-paper'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Help We\'ve Got Kids', HEARD_PAD).'['.($_POST['crf-cbx-heard']['help-kids'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Kijiji', HEARD_PAD).'['.($_POST['crf-cbx-heard']['kijiji'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Yelp', HEARD_PAD).'['.($_POST['crf-cbx-heard']['yelp'] ? 'X' : ' ').']'.PHP_EOL;
    $body .= SPACER.str_pad('Google Search', HEARD_PAD).$_POST['crf-google-search'].PHP_EOL;
    $body .= SPACER.str_pad('Recommendation', HEARD_PAD).$_POST['crf-recommendation'].PHP_EOL;
    $body .= SPACER.str_pad('Other', HEARD_PAD).$_POST['crf-other'].PHP_EOL;

    $body .= '--PHP-alt-'.$random_hash.'--'.PHP_EOL;

    $attachment = chunk_split(base64_encode(file_get_contents($_FILES['crf-resume']['tmp_name'])));
    $body .= '--PHP-mixed-'.$random_hash.PHP_EOL;
    $body .= 'Content-Type: application/zip; name="attachment.zip"'.PHP_EOL;
    $body .= 'Content-Transfer-Encoding: base64'.PHP_EOL;
    $body .= 'Content-Disposition: attachment'.PHP_EOL;
    $body .= $attachment;
    $body .= '--PHP-mixed-'.$random_hash.'--'.PHP_EOL;

    $mail_sent = mail('ts@daxiangroup.com', 'test message', $body, $headers ); 
    
    header('Location: /bumblebees/thank-you');
    die();