<?php
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

$lots = getLots($conn); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$lots) {
    $lotsError = getQueryError($conn); // Получаем текст ошибки
    display($lotsError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
}