<?php
    require_once('../wp-load.php');
    require_once('common.inc.php');

    bbn_sanitize_post('caregiver-registration');

    $headers[] = "From: ".$_POST['crf-email']." <".$_POST['crf-email'].">\r\n";

    $body = '';
    $body .= '-----------------------------------------------------'.BR;
    $body .= '| Caregiver Registration Submission'.BR;
    $body .= '-----------------------------------------------------'.BR;
    $body .= BR;
    $body .= '<strong>Contact Details</strong>'.BR;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['crf-fullname'].BR;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['crf-email'].BR;
    $body .= SPACER.str_pad('Postal Code: ', PAD).$_POST['crf-postal-code'].BR;
    $body .= SPACER.str_pad('Contact Number: ', PAD).$_POST['crf-contact-number'].BR;
    $body .= BR;
    $body .= '<strong>Position</strong>'.BR;
    $body .= SPACER.str_pad('Nany', POS_PAD).'['.($_POST['crf-cbx-position']['nanny'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Nany Share', POS_PAD).'['.($_POST['crf-cbx-position']['nanny-share'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('After School Care', POS_PAD).'['.($_POST['crf-cbx-position']['after-school'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Emergency Babysitting', POS_PAD).'['.($_POST['crf-cbx-position']['emergency-babysitting'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Live Out', POS_PAD).'['.($_POST['crf-cbx-position']['live-out'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Permanent', POS_PAD).'['.($_POST['crf-cbx-position']['permanent'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Temporary', POS_PAD).'['.($_POST['crf-cbx-position']['temporary'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Full-time', POS_PAD).'['.($_POST['crf-cbx-position']['full-time'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Part-time', POS_PAD).'['.($_POST['crf-cbx-position']['part-time'] ? 'X' : ' ').']'.BR;
    $body .= BR;
    $body .= '<strong>Qualifications</strong>'.BR;
    $body .= SPACER.str_pad('Experience: ', POS_PAD).$_POST['crf-years-experience'].BR;
    $body .= SPACER.str_pad('Details: ', POS_PAD).$_POST['crf-qualifications'].BR.BR;
    $body .= SPACER.str_pad('Valid First Aid: ', QUAL_PAD).'Yes ['.($_POST['crf-rdo-first-aid'] == '1' ? 'X' : ' ').']  No ['.($_POST['crf-rdo-first-aid'] == '0' ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Valid Police Check: ', QUAL_PAD).'Yes ['.($_POST['crf-rdo-police-check'] == '1' ? 'X' : ' ').']  No ['.($_POST['crf-rdo-police-check'] == '0' ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Drivers License: ', QUAL_PAD).'Yes ['.($_POST['crf-rdo-drivers-license'] == '1' ? 'X' : ' ').']  No ['.($_POST['crf-rdo-drivers-license'] == '0' ? 'X' : ' ').']'.BR;
    $body .= BR;
    $body .= '<strong>Where did you hear about us</strong>'.BR;
    $body .= SPACER.str_pad('Today\'s Parent', HEARD_PAD).'['.($_POST['crf-cbx-heard']['todays-parent'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('The Little Paper', HEARD_PAD).'['.($_POST['crf-cbx-heard']['little-paper'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Help We\'ve Got Kids', HEARD_PAD).'['.($_POST['crf-cbx-heard']['help-kids'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Kijiji', HEARD_PAD).'['.($_POST['crf-cbx-heard']['kijiji'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Yelp', HEARD_PAD).'['.($_POST['crf-cbx-heard']['yelp'] ? 'X' : ' ').']'.BR;
    $body .= BR;
    $body .= SPACER.str_pad('Google Search: ', HEARD_PAD).$_POST['crf-google-search'].BR;
    $body .= SPACER.str_pad('Recommendation: ', HEARD_PAD).$_POST['crf-recommendation'].BR;
    $body .= SPACER.str_pad('Other: ', HEARD_PAD).$_POST['crf-other'].BR;

    move_uploaded_file($_FILES['crf-resume']['tmp_name'], WP_CONTENT_DIR.'/uploads/'.basename($_FILES['crf-resume']['name']));
    $attachments[] = WP_CONTENT_DIR.'/uploads/'.$_FILES['crf-resume']['name'];

    $mail_sent = bbn_mail(RICHELLE, 'Caregiver Registration', $body, $headers, $attachments);
    unlink(WP_CONTENT_DIR.'/uploads/'.$_FILES['crf-resume']['name']);
    
    header('Location: '.THANK_YOU_PAGE);
    die();