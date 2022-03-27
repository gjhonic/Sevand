<?php
/**
 * Наши правила:
 * 1) При добавлении перевода сперва пользуемся поиском Ctrl+F (Такая фраза мб уже есть)
 * 2) Не добавляем фразы, которые не будут использоваться
 * 3) Если все таки хотите добавить фразу, добавляем её в логическую группу
 *
 * В этом словаре фразы которые пишем в логи
 */

return [

    //Ошибки логов
    "Error adding log" => "Ошибка добавления лога",

    //INFO LOGS
    "User logged in" => "Пользователь авторизавался",

    //Success LOGS
    "Group successfully created" => "Группа успешно создана",
    "User successfully created" => "Пользователь успешно создан",

    //WARNING LOGS
    "The log was not created because status not found" => "Лог не был создан т.к статус не найден",
    "The log was not created because the user was not found" => "Лог не был создан т.к пользователь не найден",
    "The log was not created" => "Лог не был создан",

    //DANGER
    "Group not created" => "Группа не создана",
    "User not created" => "Пользователь не создан",
];