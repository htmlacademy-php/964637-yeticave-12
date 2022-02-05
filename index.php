<?php
require_once('helpers.php');
date_default_timezone_set('Asia/Novokuznetsk');

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = 'Главная страница';

$categories = [
    'Доски и лыжи',
    'Крепления',
    'Ботинки',
    'Одежда',
    'Инструменты',
    'Разное',
];

$products = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'price' => '10999',
        'URL photo' => 'img/lot-1.jpg',
        'category' => $categories[0],
<<<<<<< HEAD
        'completion date' => '2022-02-05 21:00',
=======
        'completion date' => strtotime('2022-01-28'),
>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'price' => '8000',
        'URL photo' => 'img/lot-3.jpg',
        'category' => $categories[1],
<<<<<<< HEAD
        'completion date' => '2022-02-07',
=======
        'completion date' => strtotime('2022-01-30'),
>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'price' => '10999',
        'URL photo' => 'img/lot-4.jpg',
        'category' => $categories[2],
<<<<<<< HEAD
        'completion date' => '2022-02-08',
=======
        'completion date' => strtotime('2022-01-31'),
>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'price' => '7500',
        'URL photo' => 'img/lot-5.jpg',
        'category' => $categories[3],
<<<<<<< HEAD
        'completion date' => '2022-02-09',
=======
        'completion date' => strtotime('2022-02-01'),
>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
    ],
    [
        'title' => '',
        'price' => '0',
        'URL photo' => '',
        'category' => $categories[4],
<<<<<<< HEAD
        'completion date' => 'now',
=======
        'completion date' => strtotime('now'),
>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'price' => '5400',
        'URL photo' => 'img/lot-6.jpg',
        'category' => $categories[5],
<<<<<<< HEAD
        'completion date' => '2022-02-05',
=======
        'completion date' => strtotime('2022-02-10'),
>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
    ],
];

function formatPrice($userPrice) {
    $userPrice = ceil($userPrice);
    if ($userPrice >= 1000) {
        $userPrice = number_format($userPrice, 0, '', ' ');
    }
    return $userPrice . ' ' . '<b class="rub"></b>';
}

<<<<<<< HEAD
=======
function timerFinishing($completionDate) {
    $timerFinishing = '';
    $endTimeArr = [];
    $timeInterval = $completionDate - time();
    $endTimeArr[0] = floor($timeInterval / 60 / 60);
    $endTimeArr[1] = floor(($timeInterval - ($endTimeArr[0] * 60 * 60)) / 60);

    if ($endTimeArr[0] == 0) {
        $timerFinishing = 'timer--finishing';
    }
    return $timerFinishing;
}

function get_dt_range($completionDate) {
    $endTimeArr = [];
    $timeInterval = $completionDate - time();
    $endTimeArr[0] = floor($timeInterval / 60 / 60);
    $endTimeArr[1] = floor(($timeInterval - ($endTimeArr[0] * 60 * 60)) / 60);

    if ($endTimeArr[0] < 10) {
        $endTimeArr[0] = '0' . $endTimeArr[0];
    }

    if ($endTimeArr[1] < 10) {
        $endTimeArr[1] = '0' . $endTimeArr[1];
    }
    return $endTimeArr[0] . ':' . $endTimeArr[1];
}

>>>>>>> 81874e17c6378d34d5aafe2d8ef2abde950a581d
$pageContent = include_template('main.php',
    [
        'categories' => $categories,
        'products' => $products,
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
