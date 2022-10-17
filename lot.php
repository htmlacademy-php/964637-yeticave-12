<?php
require_once('config.php');
date_default_timezone_set('Asia/Novokuznetsk');
require_once('helpers.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
require_once('db_queries/lot_queries_db.php');



$title = $currentLot['lot_name'];

$pageContent = include_template(
    'lot.php',
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
