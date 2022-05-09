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

    // - - - ERROR LOG - - -
    "Error adding log" => "Ошибка добавления лога",

    // - - - INFO LOGS - - -
    "User logged in" => "Пользователь авторизавался",



    // - - - SUCCESS LOGS - - -
    //user
    "User successfully created"  => "Пользователь успешно создан",
    "User successfully enabled"  => "Пользователь успешно активирован",
    "User successfully disabled" => "Пользователь успешно заархивирован",

    //student
    "Student successfully created"  => "Студент успешно создана",
    "Student successfully enabled"  => "Студент успешно активирована",
    "Student successfully disabled" => "Студент успешно заархивирована",
    "Student successfully transferred" => "Студент успешно переведен",

    //group
    "Group successfully created"  => "Группа успешно создана",
    "Group successfully enabled"  => "Группа успешно активирована",
    "Group successfully disabled" => "Группа успешно заархивирована",

    //discipline
    "Discipline successfully created"  => "Дисциплина успешно создана",
    "Discipline successfully enabled"  => "Дисциплина успешно активирована",
    "Discipline successfully disabled" => "Дисциплина успешно заархивирована",
    "Discipline successfully updated" => "Дисциплина успешно изменена",
    "Discipline successfully deleted" => "Дисциплина успешно удалена",

    //direction
    "Direction successfully created"  => "Направление успешно создано",
    "Direction successfully updated"  => "Направление успешно изменено",
    "Direction successfully enabled"  => "Направление успешно активировано",
    "Direction successfully disabled" => "Направление успешно заархивировано",
    "Direction successfully deleted"  => "Направление успешно удалена",

    // - - - WARNING LOGS - - -
    "The log was not created because status not found" => "Лог не был создан т.к статус не найден",
    "The log was not created because the user was not found" => "Лог не был создан т.к пользователь не найден",
    "The log was not created" => "Лог не был создан",



    // - - - DANGER LOGS - - -
    //user
    "User not created"  => "Пользователь не создан",
    "User not enabled"  => "Пользователь не активирован",
    "User not disabled" => "Пользователь не заархивирован",

    //student
    "Student not created"  => "Студент не создан",
    "Student not enabled"  => "Студент не активирован",
    "Student not disabled" => "Студент не заархивирован",
    "Student not transferred" => "Студент не переведен",

    //group
    "Group not created"  => "Группа не создана",
    "Group not enabled"  => "Группа не активирована",
    "Group not disabled" => "Группа не заархивирована",

    //discipline
    "Discipline not created"  => "Дисциплина не создана",
    "Discipline not enabled"  => "Дисциплина не активирована",
    "Discipline not disabled" => "Дисциплина не заархивирована",
    "Discipline not updated" => "Дисциплина не изменена",
    "Discipline not deleted" => "Дисциплина не удалена",

    //direction
    "Direction not created"  => "Направление не создано",
    "Direction not updated"  => "Направление не изменено",
    "Direction not enabled"  => "Направление не активировано",
    "Direction not disabled" => "Направление не заархивировано",
    "Direction not deleted"  => "Направление не удалена",
];