<?php
$id = $_GET['id'];
error_reporting(0);
date_default_timezone_set('Asia/Novokuznetsk');
require_once('helpers.php');
require_once('config.php');
require_once('db_queries/lot_queries_db.php');

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = $currentLot['title'];

$pageContent = include_template('lot.php',
    [
        'categories' => $categories,
        'currentLot' => $currentLot,
        'title' => $title,
        'userName' => $userName,
        'is_auth' => $is_auth,
        'maxBet' => $maxBet,
        'nextMinBet' => $nextMinBet,
        'categoryTitle' => $categoryTitle,
    ]
);

echo $pageContent;
