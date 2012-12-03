<?php
define('SPACER',         '   ');
define('PAD',            20);
define('POS_PAD',        28);
define('QUAL_PAD',       24);
define('HEARD_PAD',      28);
define('RANDOM_HASH',    md5(date('r', time())));
//define('RICHELLE',       'richelle@bumblebeesnannies.com');
define('RICHELLE',       'ts@daxiangroup.com');
define('FROM_ADDRESS',   'web@bumblebeesnannies.com');
define('THANK_YOU_PAGE', '/bumblebees/thank-you');

function sanitize_post($which) {
    switch ($which) {
        case 'contact':
            $_POST['con-fullname']        = filter_var($_POST['con-fullname'],        FILTER_SANITIZE_STRING);
            $_POST['con-email']           = filter_var($_POST['con-email'],           FILTER_SANITIZE_EMAIL);
            $_POST['con-subject']         = filter_var($_POST['con-subject'],         FILTER_SANITIZE_STRING);
            $_POST['con-message']         = filter_var($_POST['con-message'],         FILTER_SANITIZE_STRING);
            break;
        case 'contact-family':
            $_POST['ns-fullname']         = filter_var($_POST['ns-fullname'],         FILTER_SANITIZE_STRING);
            $_POST['ns-email']            = filter_var($_POST['ns-email'],            FILTER_SANITIZE_EMAIL);
            $_POST['ns-intersection']     = filter_var($_POST['ns-intersection'],     FILTER_SANITIZE_EMAIL);
            $_POST['ns-age']              = filter_var($_POST['ns-age'],              FILTER_SANITIZE_EMAIL);
            for ($i=1; $i<=7; $i++) {
                $_POST['ns-hours'][$i]    = filter_var($_POST['ns-hours'][$i],        FILTER_SANITIZE_STRING);
            }
            break;
        case 'caregiver-registration':
            $_POST['crf-fullname']        = filter_var($_POST['crf-fullname'],        FILTER_SANITIZE_STRING);
            $_POST['crf-email']           = filter_var($_POST['crf-email'],           FILTER_SANITIZE_EMAIL);
            $_POST['crf-postal-code']     = filter_var($_POST['crf-postal-code'],     FILTER_SANITIZE_STRING);
            $_POST['crf-contact-number']  = filter_var($_POST['crf-contact-number'],  FILTER_SANITIZE_STRING);
            $_POST['crf-qualifications']  = filter_var($_POST['crf-qualifications'],  FILTER_SANITIZE_STRING);
            $_POST['crf-google-search']   = filter_var($_POST['crf-google-search'],   FILTER_SANITIZE_STRING);
            $_POST['crf-recommendation']  = filter_var($_POST['crf-recommendation'],  FILTER_SANITIZE_STRING);
            $_POST['crf-other']           = filter_var($_POST['crf-other'],           FILTER_SANITIZE_STRING);
            break;
        case 'family-registration':
            $_POST['frf-fullname']        = filter_var($_POST['frf-fullname'],        FILTER_SANITIZE_STRING);
            $_POST['frf-email']           = filter_var($_POST['frf-email'],           FILTER_SANITIZE_EMAIL);
            $_POST['frf-postal-code']     = filter_var($_POST['frf-postal-code'],     FILTER_SANITIZE_STRING);
            $_POST['frf-contact-number']  = filter_var($_POST['frf-contact-number'],  FILTER_SANITIZE_STRING);
            $_POST['frf-age-of-children'] = filter_var($_POST['frf-age-of-children'], FILTER_SANITIZE_STRING);
            $_POST['frf-google-search']   = filter_var($_POST['frf-google-search'],   FILTER_SANITIZE_STRING);
            $_POST['frf-recommendation']  = filter_var($_POST['frf-recommendation'],  FILTER_SANITIZE_STRING);
            $_POST['frf-other']           = filter_var($_POST['frf-other'],           FILTER_SANITIZE_STRING);
            break;
    }
}