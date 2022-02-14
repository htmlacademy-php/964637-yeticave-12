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
        'completion date' => '2022-02-18 21:00',
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'price' => '8000',
        'URL photo' => 'img/lot-3.jpg',
        'category' => $categories[1],
        'completion date' => '2022-02-20',
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'price' => '10999',
        'URL photo' => 'img/lot-4.jpg',
        'category' => $categories[2],
        'completion date' => '2022-02-10',
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'price' => '7500',
        'URL photo' => 'img/lot-5.jpg',
        'category' => $categories[3],
        'completion date' => '2022-02-19',
    ],
    [
        'title' => '',
        'price' => '0',
        'URL photo' => '',
        'category' => $categories[4],
        'completion date' => 'now',
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'price' => '5400',
        'URL photo' => 'img/lot-6.jpg',
        'category' => $categories[5],
        'completion date' => '2022-02-09 16:30',
    ],
];

function formatPrice($userPrice) {
    $userPrice = ceil($userPrice);
    if ($userPrice >= 1000) {
        $userPrice = number_format($userPrice, 0, '', ' ');
    }
    return $userPrice . ' ' . '<b class="rub"></b>';
}

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
