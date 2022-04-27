<?php
require_once('helpers.php');
date_default_timezone_set('Asia/Novokuznetsk');

$conn = mysqli_connect('localhost', 'root', 'root', '964637-yeticave-12');
mysqli_set_charset($conn, "utf8");

$getLots = "SELECT * FROM lots WHERE completion_dt > CURRENT_TIMESTAMP ORDER BY dt_add DESC";
$resultLots = mysqli_query($conn, $getLots);
if ($resultLots) {
    $resultLots = mysqli_fetch_all($resultLots, MYSQLI_ASSOC);
} else {
    echo "Ошибка выполнения заброса в БД: " . mysqli_error($conn);;
}

$getCategories = "SELECT * FROM categories";
$resultCategories = mysqli_query($conn, $getCategories);
if ($resultCategories) {
    $resultCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
} else {
    echo "Ошибка выполнения заброса в БД: " . mysqli_error($conn);;
}

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = 'Главная страница';

function formatPrice($userPrice) {
    $userPrice = ceil($userPrice);
    if ($userPrice >= 1000) {
        $userPrice = number_format($userPrice, 0, '', ' ');
    }
    return $userPrice . ' ' . '<b class="rub"></b>';
}

$pageContent = include_template('main.php',
    [
        'resultCategories' => $resultCategories,
        'resultLots' => $resultLots,
    ]
);

$layoutContent = include_template('layout.php',
    [
        'content' => $pageContent,
        'resultCategories' => $resultCategories,
        'title' => $title,
        'userName' => $userName,
        'is_auth' => $is_auth,
    ]
);

echo $layoutContent;