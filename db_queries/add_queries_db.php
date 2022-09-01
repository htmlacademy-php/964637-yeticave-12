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
    display($categoriesError, $is_auth, $userName, $title);
}
