<?php

/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date): bool
{
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

function validateFilled($value)
{
    if (!$_POST[$value]) {

        return "Категория не выбрана";
    }
}

function validateLength($value, $min, $max)
{
    $len = mb_strlen($_POST[$value]);
    if ($len < $min || $len > $max) {

        return "Значение должно быть от $min до $max символов";
    }
}

function validateRate($value)
{
    if (empty($_POST[$value]) && $value === 'lot-rate') {

        return "Начальная цена не указана";
    } elseif (empty($_POST[$value]) && $value === 'lot-step') {

        return "Шаг ставки не указан";
    }

    if (!ctype_digit($_POST[$value])) {

        return "Введено некоректное значение";
    } 
}

function validateDate($value)
{
    if (empty($_POST[$value])) {

        return 'Дата не выбрана!';
    }
    if (!is_date_valid($_POST[$value])) {

        return 'Неверный формат даты!';
    }
    if ((strtotime($_POST[$value]) - time()) / 60 / 60 < 24) {

        return "Дата окончания не должна быть менее 24 часов";
    }
}

function checkCurrErr(array $addLotErr, string $currErr)
{
    if (isset($addLotErr[$currErr])) {

        return $addLotErr[$currErr] ? 'form__item--invalid' : '';
    }
}
