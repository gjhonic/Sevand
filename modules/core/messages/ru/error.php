<?php
/**
 * Наши правила:
 * 1) При добавлении перевода сперва пользуемся поиском Ctrl+F (Такая фраза мб уже есть)
 * 2) Не добавляем фразы, которые не будут использоваться
 * 3) Если все таки хотите добавить фразу, добавляем её в логическую группу
 *
 * В этом словаре фразы ошибок валидации, сообщения для исключений
 */

return [
    "The requested page does not exist." => "Запрашиваемая страница не существует.",

    //Ошибки аутентификации
    "Authorization failed" => "Авторизация не удалась",
    "Invalid username or password!" => "Неверный логин или пароль!",

    //UserError
    "Error validation" => "Ошибка валидации",
    "User creation error" => "Ошибка создания пользователя",

    //Ошибки логов
    "Error adding log" => "Ошибка добавления лога",
    "The log was not created because status not found." => "Лог не был создан т.к статус не найден.",
    "The log was not created because the user was not found." => "Лог не был создан т.к пользователь не найден.",
    "The log was not created." => "Лог не был создан.",
];