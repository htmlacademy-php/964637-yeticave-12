<?php
$conn = getConnect(HOST, USER, PASS, DB);
if (!$conn) {
    $connectError = getConnectError($conn);
    display($connectError, $is_auth, $userName, $title);
}

$categories = getCategories($conn);
if (!$categories) {
    $categoriesError = getQueryError($conn);
    display($categoriesError, $is_auth, $userName, $title);
}

$lots = getLots($conn);
if (!$lots) {
    $lotsError = getQueryError($conn);
    display($lotsError, $is_auth, $userName, $title);
}
