<?php
$conn = getConnect(HOST, USER, PASS, DB); //Подключаемся к бд. Получаем либо объект mysqli, либо false
if (!$conn) {
    $connectError = getConnectError($conn); // Получаем текст ошибки
    echo display($connectError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
    exit;
}

$categories = getCategories($conn); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$categories) {
    $categoriesError = getQueryError($conn); // Получаем текст ошибки
    echo display($categoriesError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
    exit;
}

$lots = getLots($conn); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$lots) {
    $lotsError = getQueryError($conn); // Получаем текст ошибки
    echo display($lotsError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
    exit;
}
