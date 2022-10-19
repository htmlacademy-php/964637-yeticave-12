<?php

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = [])
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            } else if (is_string($value)) {
                $type = 's';
            } else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form(int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template(string $name, array $data = [])
{
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function get_dt_range(string $completionDate)
{
    $completionDate = date_diff(date_create($completionDate), date_create('now'));

    $hours = $completionDate->days * 24 + $completionDate->h;
    $minutes = $completionDate->i;

    return [
        str_pad((string) $hours, 2, '0', STR_PAD_LEFT),
        str_pad((string) $minutes, 2, '0', STR_PAD_LEFT),
    ];
}

function formatPrice($userPrice)
{
    $userPrice = ceil((int) $userPrice);
    if ($userPrice >= 1000) {
        $userPrice = number_format($userPrice, 0, '', ' ');
    }

    return $userPrice . ' ' . '<b class="rub"></b>';
}

function getConnect($host, $user, $pass, $db)
{
    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {

        return false;
    }
    $charset = mysqli_set_charset($conn, "utf8");
    if (!$charset) {

        return false;
    }

    return $conn;
}

function getConnectError($conn)
{
    $result = mysqli_connect_error();
    if (empty($result)) {

        return 'Возникла неизвестная ошибка';
    }

    return $result;
}

function getQueryError($conn)
{
    $result = mysqli_error($conn);
    if (empty($result)) {

        return 'Возникла неизвестная ошибка';
    }

    return $result;
}

function display($content, int $is_auth, string $userName, string $title)
{
    $layoutContent = include_template(
        'layout.php',
        [
            'content' => $content,
            'title' => $title,
            'userName' => $userName,
            'is_auth' => $is_auth,
        ]
    );

    return $layoutContent;
}

function query($conn, string $sql)
{
    $result = mysqli_query($conn, $sql);
    if (!$result) {

        return false;
    }
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $result;
}

function getCategories($conn)
{
    $sql = "SELECT * FROM categories";
    $result = query($conn, $sql);
    if (!$result) {

        return false;
    }

    return $result;
}

function getLots($conn)
{
    $sql = "SELECT l.id, l.lot_name, l.lot_date, l.dt_add, l.lot_img, l.lot_rate, c.title AS category_title,
                   (SELECT MAX(rate)
                      FROM bets
                     WHERE l.id = lot_id) AS current_bet
              FROM lots AS l
                   JOIN categories AS c
                   ON l.category_id = c.id
             WHERE l.lot_date > CURRENT_TIMESTAMP
             ORDER BY dt_add DESC";
    $result = query($conn, $sql);
    if (!$result) {

        return false;
    }

    return $result;
}

function getCurrentLot($conn, int $id)
{
    $sql = "SELECT * FROM lots WHERE lot_date > CURRENT_TIMESTAMP and id = $id";
    $result = query($conn, $sql);
    if (!$result) {

        return false;
    }

    return $result[0];
}

function getMaxBet($conn, int $id)
{
    $sql = "SELECT MAX(rate) AS current_bet FROM bets WHERE lot_id = $id";
    $result = query($conn, $sql);

    if (!$result) {

        return false;
    }

    return $result[0];
}

function getNextMinBet($conn, int $id)
{
    $sql = "SELECT lot_step FROM lots WHERE id = $id";
    $result = query($conn, $sql);
    if (!$result) {

        return false;
    }

    return $result[0];
}

function getLink(int $id)
{
    $array = $_GET;
    $array['id'] = $id;
    $query = http_build_query($array);
    $url = '/' . 'lot.php' . '?' . $query;

    return $url;
}

function getTitle($conn, int $id)
{
    $sql = "SELECT c.title
              FROM lots AS l
                   JOIN categories AS c
                   ON l.category_id = c.id
             WHERE l.id = $id";
    $result = query($conn, $sql);
    if (!$result) {

        return false;
    }

    return $result[0];
}

function getCurrCategory($conn)
{
    $emptyCategory = '0';
    if (!isset($_POST['category_id']) || $_POST['category_id'] === $emptyCategory) {

        return 'Выберите категорию';
    } else {
        $currId = $_POST['category_id'];
        $sql = "SELECT title FROM categories WHERE id = $currId";
        $result = query($conn, $sql);

        return $result[0]['title'];
    }
}

function addLot($conn, $author_id)
{
    $_POST['lot-img'] = './uploads/' . $_FILES['lot-img']['name'];
    $postData = [];

    foreach ($_POST as $key => $value) {
        $key = str_replace('-', '_', $key);
        $postData[$key] = mysqli_real_escape_string($conn, $value);
    }

    $sql = "INSERT INTO lots (lot_name, category_id, message, lot_img, lot_rate, lot_step, lot_date, author_id)
            VALUES ('$postData[lot_name]', $postData[category], '$postData[message]', '$postData[lot_img]', $postData[lot_rate], $postData[lot_step], '$postData[lot_date]', $author_id)";

    if (mysqli_query($conn, $sql)) {

        return true;
    } else {

        return false;
    }
}

function getLastLot($conn)
{
    $lotImg = $_POST['lot-img'];
    $sql = "SELECT MAX(id) FROM lots WHERE lot_img = '$lotImg' ORDER BY dt_add";
    $result = query($conn, $sql);

    if ($result) {

        return $result;
    }
}
