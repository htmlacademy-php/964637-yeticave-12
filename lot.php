<?php
// error_reporting(0);
require_once('helpers.php');
require_once('config.php');
date_default_timezone_set('Asia/Novokuznetsk');

$is_auth = rand(0, 1);
$userName = 'Артем';
$title = '';
$id = $_GET['id'];

echo '<pre>';
print_r($_GET);
echo '</pre>';

$conn = getConnect(HOST, USER, PASS, DB);//Подключаемся к бд. Получаем либо объект mysqli, либо false
if (!$conn) {
    $connectError = getConnectError($conn); // Получаем текст ошибки
    display($connectError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
}

$categories = getCategories($conn); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$categories) {
    $categoriesError = getQueryError($conn); // Получаем текст ошибки
    display($categoriesError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
}

$currentLot = getCurrentLot($conn, $id); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$currentLot) {
    http_response_code(404);
    $currentLotError = 'Ошибка ' . http_response_code() . '. Страница не найдена.'; // Получаем текст ошибки
    display($currentLotError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
}

$maxtBet = getMaxBet($conn, $id); // Получаем максимальную ставку по текущему лоту
$nextMinBet = getNextMinBet($conn, $id); // Получаем следующую минимальную ставку путем сложения либо максимальной ставки с шагом ставки, либо стартовой цены с шагом ставки


echo '<pre>';
print_r($nextMinBet);
echo '</pre>';

echo '<pre>';
print_r($maxtBet);
echo '</pre>';

echo '<pre>';
print_r($currentLot);
echo '</pre>';

$pageContent = include_template('main_lot.php',
    [
        'categories' => $categories,
        'currentLot' => $currentLot,
        'title' => $title,
        'userName' => $userName,
        'is_auth' => $is_auth,
        'maxtBet' => $maxtBet,
        'nextMinBet' => $nextMinBet,
    ]
);

echo $pageContent;
