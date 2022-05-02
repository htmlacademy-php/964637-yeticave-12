<?php
error_reporting(0);
require_once('helpers.php');
require_once('config.php');
date_default_timezone_set('Asia/Novokuznetsk');

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = 'Главная страница';

$conn = getConnect(HOST, USER, PASS, DB);
display($conn, $is_auth, $userName, $title);

$getCategories = "SELECT * FROM categories";
$categories = getCategories($conn, $getCategories);
display($categories, $is_auth, $userName, $title);

$getLots = "SELECT * FROM lots WHERE completion_dt > CURRENT_TIMESTAMP ORDER BY dt_add DESC";
$lots = getLots($conn, $getLots);
display($lots, $is_auth, $userName, $title);


$pageContent = include_template('main.php',
    [
        'categories' => $categories,
        'lots' => $lots,
    ]
);

$layoutContent = include_template('layout.php',
    [
        'content' => $pageContent,
        'categories' => $categories,
        'title' => $title,
        'userName' => $userName,
        'is_auth' => $is_auth,
    ]
);

echo $layoutContent;
