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

$currentLot = getCurrentLot($conn, $id); //Делаем запрос в бд. Получаем либо массив из бд, либо false
echo '<pre>';
print_r($currentLot);
echo '</pre>';
if (!$currentLot) {
    http_response_code(404);
    $currentLotError = 'Ошибка ' . http_response_code() . '. Страница не найдена.'; // Получаем текст ошибки
    display($currentLotError, $is_auth, $userName, $title); // Выводим текст ошибки в layout
}

$maxBet = getMaxBet($conn, $id); // Получаем максимальную ставку по текущему лоту
$nextMinBet = getNextMinBet($conn, $id); // Получаем следующую минимальную ставку путем сложения либо максимальной ставки с шагом ставки, либо стартовой цены с шагом ставки

$categoryTitle = getTitle($conn, $id); // Получаем название категории по id лота из таблицы categoties
