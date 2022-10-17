<?php
// $conn = mysqli_connect('localhost', 'root', 'root', '964637-yeticave-12');
// connect_check($conn, $is_auth, $userName, $title);
$conn = getConnect($is_auth, $userName, $title);

$getCategories = "SELECT * 1FROM categories";
$categories = getCategories($conn, $getCategories, $is_auth, $userName, $title);
// display($categories, $is_auth, $userName, $title);

$getLots = "SELECT * FROM lots WHERE completion_dt > CURRENT_TIMESTAMP ORDER BY dt_add DESC";
$lots = getLots($conn, $getLots, $is_auth, $userName, $title);
// display($lots, $is_auth, $userName, $title);




$getCategories = "SELECT * FROM categories";
$categories = mysqli_query($conn, $getCategories);
query_check($categories, $is_auth, $userName, $title, $conn);
$categories = mysqli_fetch_all($categories, MYSQLI_ASSOC);

$getLots = "SELECT * FROM lots WHERE completion_dt > CURRENT_TIMESTAMP ORDER BY dt_add DESC";
$lots = mysqli_query($conn, $getLots);
query_check($lots, $is_auth, $userName, $title, $conn);
$lots = mysqli_fetch_all($lots, MYSQLI_ASSOC);





function query($conn, string $sql, int $is_auth, string $userName, string $title) {
    $conn = mysqli_query($conn, $sql);
    if (!$conn) {
        $conn = '<h2>Ошибка выполнения запроса к базе данных: </h2>' . mysqli_error($conn);
        return display($conn, $is_auth, $userName, $title);
    }

    return $conn = mysqli_fetch_all($conn, MYSQLI_ASSOC);
}


function getLots($conn, string $sql, int $is_auth, string $userName, string $title) {
    $lots = query($conn, $sql, $is_auth, $userName, $title);
    // if (!$lots) {
    //     return $lots = '<h2>Ошибка выполнения запроса к базе данных: </h2>' . mysqli_error($conn);
    // }

    return $lots;
}

function getCategories($conn, string $sql, int $is_auth, string $userName, string $title) {
    $categories = query($conn, $sql, $is_auth, $userName, $title);
    // if (!$categories) {
    //     return $categories = '<h2>Ошибка выполнения запроса к базе данных: </h2>' . mysqli_error($conn);
    // }

    return $categories;
}

function display($content, int $is_auth, string $userName, string $title) {
    $layoutContent = include_template('layout.php',
        [
            'content' => $content,
            'title' => $title,
            'userName' => $userName,
            'is_auth' => $is_auth,
        ]
    );
    echo $layoutContent;
    exit;
}

function getConnect( int $is_auth, string $userName, string $title) {
    $conn = mysqli_connect('localhost', 'root', 'root', '964637-yeticave-12');
    if (!$conn) {
        $conn = '<h2>Ошибка подключения к базе данных: </h2>' . mysqli_connect_error();
        return display($conn, $is_auth, $userName, $title);
    }
     $charset = mysqli_set_charset($conn, "utf8");
    if (!$charset) {
        $charset = '<h2>Ошибка установки кодировки</h2>';
        return display($charset, $is_auth, $userName, $title);
    }

    return $conn;
}






function getConnect() {
    $conn = mysqli_connect('localhost', 'root', 'root', '964637-yeticave-12');
    if (!$conn) {
        return mysqli_connect_error();
    }
    $charset = mysqli_set_charset($conn, "utf8");
    if (!$charset) {
        return mysqli_connect_error();
    }

    return $conn;
}

function display($conn, int $is_auth, string $userName, string $title) {
    if (is_string($conn)) {
        $content = 'Произошла ошибка: ' . $conn;
        $layoutContent = include_template('layout.php',
            [
                'content' => $content,
                'title' => $title,
                'userName' => $userName,
                'is_auth' => $is_auth,
            ]
        );
        echo $layoutContent;
        exit;
    }
}

// Эту функцию я поменял на другую, где использовал подзапрос select, который спас меня от неразберихи при использовании group by. 
function getLots($conn) {
     $sql = "SELECT * FROM lots WHERE completion_dt > CURRENT_TIMESTAMP ORDER BY dt_add DESC";
     $result = query($conn, $sql);
     if (!$result) {

         return false;
     }

     return $result;
}
?>













