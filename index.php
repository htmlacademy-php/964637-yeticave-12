<?php
require_once('config.php');
require_once('helpers.php');
require_once('db_queries/index_queries_db.php');

$pageContent = include_template(
    'main.php',
    [
        'categories' => $categories,
        'lots' => $lots,
    ]
);

$layoutContent = include_template(
    'layout.php',
    [
        'content' => $pageContent,
        'categories' => $categories,
        'title' => $title,
        'userName' => $userName,
        'is_auth' => $is_auth,
    ]
);

echo $layoutContent;
