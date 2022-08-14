<?php
//$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$is_auth = rand(0, 1);
$userName = 'Артем';
//error_reporting(0);
require_once('config.php');
date_default_timezone_set('Asia/Novokuznetsk');
require_once('helpers.php');
require_once('db_queries/add_queries_db.php');
require_once('validate_func.php');

$title = 'Добавление лота';

$addLotErr = [];
$rules = [
    'lot_name' => function () {
        return validateLength('lot_name', 1, 128);
    },
    'category_id' => function () {
        return validateFilled('category_id');
    },
    'description' => function () {
        return validateLength('description', 1, 256);
    },
    'lot_rate' => function () {
        return validateRate('lot_rate');
    },
    'lot_step' => function () {
        return validateRate('lot_step');
    },
    'lot-date' => function () {
        return validateDate('lot-date');
    },
];

if (isset($_POST['submit'])) {
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $addLotErr[$key] = $rule();
        }
    }
}

if (isset($_FILES['lot_img'])) {
    if ($_FILES['lot_img']['size'] == 0) {
        $addLotErr['lot_img'] = 'Фаил небыл выбран';
    } else {
        if (mime_content_type($_FILES['lot_img']['tmp_name']) != 'image/jpeg' && mime_content_type($_FILES['lot_img']['tmp_name']) != 'image/png') {
            $addLotErr['lot_img'] = 'Неверный формат файла';
        } else {
            $file_name = $_FILES['lot_img']['name'];
            $file_path = __DIR__ . '\uploads\\';
        
            if (!move_uploaded_file($_FILES['lot_img']['tmp_name'], $file_path . $file_name)) {
                $addLotErr['lot_img'] = 'Не удалось загрузить фаил';
            }
        }
    }
}

$addLotErr = array_filter($addLotErr);

if (isset($_POST['submit']) && count($addLotErr) == 0) {
    $addLot = addLot($conn, $is_auth);
    echo 'Результат добавления в бд - ';
    var_dump($addLot);
}

$pageContent = include_template('add.php',
    [
        'categories' => $categories,
        'title' => $title,
        'userName' => $userName,
        'is_auth' => $is_auth,
        'conn' => $conn,
        'addLotErr' => $addLotErr,
    ]
);

echo $pageContent;
