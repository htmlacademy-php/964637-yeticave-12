<?php
error_reporting(0);
require_once('helpers.php');
require_once('config.php');
date_default_timezone_set('Asia/Novokuznetsk');

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = 'Главная страница';

$conn = getConnect(HOST, USER, PASS, DB);
if (!$conn) {
    $connectError = getConnectError($conn);
    display($connectError, $is_auth, $userName, $title);
}

$categories = getCategories($conn);
if (!$categories) {
    $categoriesError = getQueryError($conn); 
    display($categoriesError, $is_auth, $userName, $title);
}

$lots = getLots($conn);
if (!$lots) {
    $lotsError = getQueryError($conn);
    display($lotsError, $is_auth, $userName, $title);
}

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
