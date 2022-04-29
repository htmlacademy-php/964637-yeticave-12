<?php
error_reporting(0);
require_once('helpers.php');
date_default_timezone_set('Asia/Novokuznetsk');

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = 'Главная страница';

$conn = mysqli_connect('localhost', 'root', 'root', '964637-yeticave-12');
connect_check($conn, $is_auth, $userName, $title);

$getCategories = "SELECT * FROM categories";
$categories = mysqli_query($conn, $getCategories);
query_check($categories, $is_auth, $userName, $title, $conn);
$categories = mysqli_fetch_all($categories, MYSQLI_ASSOC);

$getLots = "SELECT * FROM lots WHERE completion_dt > CURRENT_TIMESTAMP ORDER BY dt_add DESC";
$lots = mysqli_query($conn, $getLots);
query_check($lots, $is_auth, $userName, $title, $conn);
$lots = mysqli_fetch_all($lots, MYSQLI_ASSOC);

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
