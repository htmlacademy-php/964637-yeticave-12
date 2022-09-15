<?php
$conn = getConnect(HOST, USER, PASS, DB);
if (!$conn) {
    $connectError = getConnectError($conn);
    $titleErr = 'Ошибка';
    echo display($connectError, $is_auth, $userName, $titleErr);
    exit;
}

$categories = getCategories($conn);
if (!$categories) {
    $categoriesError = getQueryError($conn);
    $titleErr = 'Ошибка';
    echo display($categoriesError, $is_auth, $userName, $titleErr);
    exit;
}

$currentLot = getCurrentLot($conn, $id);
if (!$currentLot) {
    http_response_code(404);
    $currentLotError = 'Ошибка ' . http_response_code() . '. Страница не найдена.';
    $titleErr = 'Ошибка';
    echo display($currentLotError, $is_auth, $userName, $titleErr);
    exit;
}

$maxBet = getMaxBet($conn, $id);
$nextMinBet = getNextMinBet($conn, $id);

$categoryTitle = getTitle($conn, $id);
