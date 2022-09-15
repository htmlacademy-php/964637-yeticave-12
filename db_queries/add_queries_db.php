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
    echo display($categoriesError, $is_auth, $userName, $title);
    exit;
}
