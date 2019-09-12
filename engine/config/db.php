<?php
/* Модуль для работы с базой данных
 * набор функций для соединени и получения данных
 *
 * Функция, осуществляющая соединение с базой данных и возвращающее его
 * static позволяет сохранить состояние и вернуть уже текущее соединение
 * чтобы не делать нового
 */
function getDb()
{
    static $db = null;
    if (is_null($db)) {
        $db = @mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;
}

/*
 * Обертка для выполнения запроса на получение данных
 * Данные возвращаются в виде ассоциативного массива
 * Цикл по получению данных уже реализован в этой функции
 */
function getAssocResult($sql)
{
    $db = getDb();
    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    $array_result = [];
    while ($row = mysqli_fetch_assoc($result))
        $array_result[] = $row;
    return $array_result;
}

function updateSql($sql)
{
    $db = getDb();
    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    return $result;
}

//При желании можно закрыть соединение (если уж и вызывать, то после render на главной)
function closeDb()
{
    mysqli_close(getDb());
}