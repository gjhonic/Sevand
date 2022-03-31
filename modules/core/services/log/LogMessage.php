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
    // - - - MESSAGES INFO LOGS - - -
    const INFO_USER_LOGGED_IN = 'User logged in';


    // - - - MESSAGES SUCCESS LOGS - - -
    //user
    const SUCCESS_USER_CREATED = 'User successfully created';
    const SUCCESS_USER_ENABLED = 'User successfully enabled';
    const SUCCESS_USER_DISABLED = 'User successfully disabled';

    //group
    const SUCCESS_GROUP_CREATE = 'Group successfully created';

    //discipline
    const SUCCESS_DISCIPLINE_CREATED = 'Discipline successfully created';


    //// - - - MESSAGES WARNING LOGS - - -
    const WARNING_MESSAGE_STATUS_NOT_FOUND = 'Log not created because status not found';
    const WARNING_MESSAGE_USET_NULL = 'The log was not created because the user was not found';
    const WARNING_MESSAGE_LOG_NOT_CREATED = 'The log was not created';

    // - - - MESSAGES DANGER LOGS - - -
    //user
    const DANGER_USER_CREATED = "User not created";
    const DANGER_USER_ENABLED = "User not enabled";
    const DANGER_USER_DISABLED = "User not disabled";

    //group
    const DANGER_GROUP_CREATE = "Group not created";

    //discipline
    const DANGER_DISCIPLINE_CREATED = "Discipline not created";


}