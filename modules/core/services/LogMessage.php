<?php
/**
 * LogMessage
 * Сообщения для логирования (можно переопеределить в других модулях)
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\services;

class LogMessage
{
    //Сообщения INFO Логов
    const INFO_USER_LOGGED_IN = 'User logged in';

    //Сообщение Succes логов
    const SUCCESS_GROUP_CREATE = 'Group successfully created';

    //Сообщения WARNING логов
    const WARNING_MESSAGE_STATUS_NOT_FOUND = 'Log not created because status not found';
    const WARNING_MESSAGE_USET_NULL = 'The log was not created because the user was not found';
    const WARNING_MESSAGE_LOG_NOT_CREATED = 'The log was not created';

    //Собщение DANGER лого (ошибка создание обьекта)
    const DANGER_GROUP_CREATE = "Group not created";
}