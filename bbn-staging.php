<?php
    $conn = mysql_connect($_ENV['BBN_DB_ENV_HOST'], $_ENV['BBN_DB_ENV_USER'], $_ENV['BBN_DB_ENV_PASSWORD'], $_ENV['BBN_DB_ENV_NAME'])
        or die('Couldn\'t connect to database: '.mysql_error());

    $sql = "UPDATE ".$_ENV['BBN_DB_ENV_NAME'].".bbnoptions
            SET option_value = 'http://bumblebees.lab.daxiangroup.com/'
            WHERE option_name IN ('siteurl', 'home')";

    mysql_query($sql)
        or die('Couldn\'t perform query: '.$sql.' '.mysql_error());


        define('DB_NAME', $_ENV['BBN_DB_ENV_NAME']);