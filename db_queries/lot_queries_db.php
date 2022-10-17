<?php
$conn = getConnect(HOST, USER, PASS, DB); //Подключаемся к бд. Получаем либо объект mysqli, либо false
if (!$conn) {
    $connectError = getConnectError($conn); // Получаем текст ошибки
    $titleErr = 'Ошибка';
    echo display($connectError, $is_auth, $userName, $titleErr); // Выводим текст ошибки в layout
    exit;
}

$categories = getCategories($conn); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$categories) {
    $categoriesError = getQueryError($conn); // Получаем текст ошибки
    $titleErr = 'Ошибка';
    echo display($categoriesError, $is_auth, $userName, $titleErr); // Выводим текст ошибки в layout
    exit;
}

$currentLot = getCurrentLot($conn, $id); //Делаем запрос в бд. Получаем либо массив из бд, либо false
if (!$currentLot) {
    http_response_code(404);
    $currentLotError = 'Ошибка ' . http_response_code() . '. Страница не найдена.'; // Получаем текст ошибки
    $titleErr = 'Ошибка';
    echo display($currentLotError, $is_auth, $userName, $titleErr); // Выводим текст ошибки в layout
    exit;
}

$maxBet = getMaxBet($conn, $id); // Получаем максимальную ставку по текущему лоту
$nextMinBet = getNextMinBet($conn, $id); // Получаем следующую минимальную ставку путем сложения либо максимальной ставки с шагом ставки, либо стартовой цены с шагом ставки

$categoryTitle = getTitle($conn, $id); // Получаем название категории по id лота из таблицы categoties
