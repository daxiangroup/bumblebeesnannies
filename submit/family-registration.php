<?php
    require_once('../wp-load.php');
    require_once('common.inc.php');

    bbn_sanitize_post('family-registration');

    $headers[] = "From: ".$_POST['frf-email']." <".$_POST['frf-email'].">\r\n";

    $body = '';
    $body .= '-----------------------------------------------------'.BR;
    $body .= '| Family Registration Submission'.BR;
    $body .= '-----------------------------------------------------'.BR;
    $body .= BR;
    $body .= '<strong>Contact Details</strong>'.BR;
    $body .= SPACER.str_pad('Full Name: ', PAD).$_POST['frf-fullname'].BR;
    $body .= SPACER.str_pad('Email Address: ', PAD).$_POST['frf-email'].BR;
    $body .= SPACER.str_pad('Postal Code: ', PAD).$_POST['frf-postal-code'].BR;
    $body .= SPACER.str_pad('Contact Number: ', PAD).$_POST['frf-contact-number'].BR;
    $body .= BR;
    $body .= '<strong>Requirements</strong>'.BR;
    $body .= SPACER.str_pad('Nany', POS_PAD).'['.($_POST['frf-cbx-position']['nanny'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Nany Share', POS_PAD).'['.($_POST['frf-cbx-position']['nanny-share'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('After School Care', POS_PAD).'['.($_POST['frf-cbx-position']['after-school'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Emergency Babysitting', POS_PAD).'['.($_POST['frf-cbx-position']['emergency-babysitting'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Live Out', POS_PAD).'['.($_POST['frf-cbx-position']['live-out'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Permanent', POS_PAD).'['.($_POST['frf-cbx-position']['permanent'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Temporary', POS_PAD).'['.($_POST['frf-cbx-position']['temporary'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Full-time', POS_PAD).'['.($_POST['frf-cbx-position']['full-time'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Part-time', POS_PAD).'['.($_POST['frf-cbx-position']['part-time'] ? 'X' : ' ').']'.BR;
    $body .= BR;
    $body .= '<strong>Details</strong>'.BR;
    $body .= SPACER.str_pad('Age of Children: ', POS_PAD).$_POST['frf-age-of-children'].BR;
    $body .= SPACER.str_pad('Start Date: ', POS_PAD).$_POST['frf-start-date'].BR;
    $body .= SPACER.str_pad('Experience: ', POS_PAD).$_POST['frf-years-experience'].BR;
    $body .= BR;
    $body .= '<strong>Where did you hear about us</strong>'.BR;
    $body .= SPACER.str_pad('Today\'s Parent', HEARD_PAD).'['.($_POST['frf-cbx-heard']['todays-parent'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('The Little Paper', HEARD_PAD).'['.($_POST['frf-cbx-heard']['little-paper'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Help We\'ve Got Kids', HEARD_PAD).'['.($_POST['frf-cbx-heard']['help-kids'] ? 'X' : ' ').']'.BR;
    $body .= SPACER.str_pad('Yelp', HEARD_PAD).'['.($_POST['frf-cbx-heard']['yelp'] ? 'X' : ' ').']'.BR;
    $body .= BR;
    $body .= SPACER.str_pad('Google Search: ', HEARD_PAD).$_POST['frf-google-search'].BR;
    $body .= SPACER.str_pad('Recommendation: ', HEARD_PAD).$_POST['frf-recommendation'].BR;
    $body .= SPACER.str_pad('Other: ', HEARD_PAD).$_POST['frf-other'].BR;

    $mail_sent = bbn_mail(RICHELLE, 'Family Registration', $body, $headers);
    
    header('Location: '.THANK_YOU_PAGE);
    die();