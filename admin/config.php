<?php
session_start();
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'ferreteria');
define('DB_USER', 'ferreteria');
define('DB_PASSWORD', '123');
define('DB_PORT', '3306');


class Config
{
    function getImageSize(){
        return 1024000;
    }

    function getImageType() {
        return array('image/png', 'image/jpeg');
    }
}
