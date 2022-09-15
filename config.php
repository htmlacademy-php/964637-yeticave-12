<?php
date_default_timezone_set('Asia/Novokuznetsk');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'bd2');

$is_auth = random_int(0, 1);
$userName = 'Артем';
$title = 'Главная страница';
