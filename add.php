<?php
require_once('config.php');
require_once('helpers.php');
require_once('db_queries/add_queries_db.php');
require_once('validate_func.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$title = 'Добавление лота';

$addLotErr = [];
$rules = [
    'lot-name' => function () {
        return validateLength('lot-name', 1, 128);
    },
    'category' => function () {
        return validateFilled('category');
    },
    'message' => function () {
        return validateLength('message', 1, 256);
    },
    'lot-rate' => function () {
        return validateRate('lot-rate');
    },
    'lot-step' => function () {
        return validateRate('lot-step');
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

$addLotErr = array_filter($addLotErr);

$emptyFile = 0;

if (isset($_FILES['lot-img'])) {
    if ($_FILES['lot-img']['size'] === $emptyFile) {
        $addLotErr['lot-img'] = 'Фаил небыл выбран';
    } elseif (mime_content_type($_FILES['lot-img']['tmp_name']) !== 'image/jpeg' && mime_content_type($_FILES['lot-img']['tmp_name']) !== 'image/png') {
        $addLotErr['lot-img'] = 'Неверный формат файла';
    } else {
        $file_name = $_FILES['lot-img']['name'];
        $file_path = './uploads/';

        if (!move_uploaded_file($_FILES['lot-img']['tmp_name'], $file_path . $file_name)) {
            $addLotErr['lot-img'] = 'Не удалось загрузить фаил';
        }
    }
}

$emptyError = 0;

if (isset($_POST['submit']) && count($addLotErr) === $emptyError) {
    $addLot = addLot($conn, $is_auth);
    $getAddedLot = getAddedLot($conn);

    if ($addLot) {
        echo '<meta http-equiv="Refresh" content="0; URL=lot.php?id=' . $getAddedLot . '">';
        exit;
    }
}

$pageContent = include_template(
    'add.php',
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
