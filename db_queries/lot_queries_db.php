<?php
$conn = getConnect(HOST, USER, PASS, DB);
if (!$conn) {
    $connectError = getConnectError($conn);
    $titleErr = 'Ошибка';
    display($connectError, $is_auth, $userName, $titleErr);
}

$categories = getCategories($conn);
if (!$categories) {
    $categoriesError = getQueryError($conn);
    $titleErr = 'Ошибка';
    display($categoriesError, $is_auth, $userName, $titleErr);
}

$currentLot = getCurrentLot($conn, $id);
if (!$currentLot) {
    http_response_code(404);
    $currentLotError = 'Ошибка ' . http_response_code() . '. Страница не найдена.';
    $titleErr = 'Ошибка';
    display($currentLotError, $is_auth, $userName, $titleErr);
}

$maxBet = getMaxBet($conn, $id);
$nextMinBet = getNextMinBet($conn, $id);

$categoryTitle = getTitle($conn, $id);
