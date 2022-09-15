<?php
$conn = getConnect(HOST, USER, PASS, DB);
if (!$conn) {
    $connectError = getConnectError($conn);
    echo display($connectError, $is_auth, $userName, $title);
    exit;
}

$categories = getCategories($conn);
if (!$categories) {
    $categoriesError = getQueryError($conn);
    echo display($categoriesError, $is_auth, $userName, $title);
    exit;
}

$lots = getLots($conn);
if (!$lots) {
    $lotsError = getQueryError($conn);
    echo display($lotsError, $is_auth, $userName, $title);
    exit;
}
