<?php
/**
 * LogMessage
 * Сообщения для логирования (можно переопеределить в других модулях)
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\services\log;

class LogMessage
{
    //Сообщения INFO Логов
    const INFO_USER_LOGGED_IN = 'User logged in';

    //Сообщение SUCCESS логов
    //user
    const SUCCESS_USER_CREATE = 'User successfully created';
    const SUCCESS_USER_ENABLE = 'User successfully enabled';
    const SUCCESS_USER_DISABLE = 'User successfully disabled';

    //group
    const SUCCESS_GROUP_CREATE = 'Group successfully created';


    //Сообщения WARNING логов
    const WARNING_MESSAGE_STATUS_NOT_FOUND = 'Log not created because status not found';
    const WARNING_MESSAGE_USET_NULL = 'The log was not created because the user was not found';
    const WARNING_MESSAGE_LOG_NOT_CREATED = 'The log was not created';

    //Собщение DANGER лого (ошибка создание обьекта)
    //user
    const DANGER_USER_CREATE = "User not created";
    const DANGER_USER_ENABLE = "User not enabled";
    const DANGER_USER_DISABLE = "User not disabled";

    //group
    const DANGER_GROUP_CREATE = "Group not created";


}