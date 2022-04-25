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

    //student
    const SUCCESS_STUDENT_CREATED = 'Student successfully created';
    const SUCCESS_STUDENT_ENABLED = 'Student successfully enabled';
    const SUCCESS_STUDENT_DISABLED = 'Student successfully disabled';

    //group
    const SUCCESS_GROUP_CREATE = 'Group successfully created';

    //discipline
    const SUCCESS_DISCIPLINE_CREATED  = 'Discipline successfully created';
    const SUCCESS_DISCIPLINE_ENABLED  = 'Discipline successfully enabled';
    const SUCCESS_DISCIPLINE_DISABLED = 'Discipline successfully disabled';
    const SUCCESS_DISCIPLINE_DELETED  = 'Discipline successfully deleted';

    //direction
    const SUCCESS_DIRECTION_CREATED  = 'Direction successfully created';
    const SUCCESS_DIRECTION_ENABLED  = 'Direction successfully enabled';
    const SUCCESS_DIRECTION_DISABLED = 'Direction successfully disabled';
    const SUCCESS_DIRECTION_DELETED  = 'Direction successfully deleted';


    //// - - - MESSAGES WARNING LOGS - - -
    const WARNING_MESSAGE_STATUS_NOT_FOUND = 'Log not created because status not found';
    const WARNING_MESSAGE_USET_NULL = 'The log was not created because the user was not found';
    const WARNING_MESSAGE_LOG_NOT_CREATED = 'The log was not created';

    // - - - MESSAGES DANGER LOGS - - -
    //user
    const DANGER_USER_CREATED = "User not created";
    const DANGER_USER_ENABLED = "User not enabled";
    const DANGER_USER_DISABLED = "User not disabled";

    //student
    const DANGER_STUDENT_CREATED  = "Student not created";
    const DANGER_STUDENT_ENABLED  = "Student not enabled";
    const DANGER_STUDENT_DISABLED = "Student not disabled";

    //group
    const DANGER_GROUP_CREATE = "Group not created";

    //discipline
    const DANGER_DISCIPLINE_CREATED = "Discipline not created";
    const DANGER_DISCIPLINE_ENABLED = "Discipline not enabled";
    const DANGER_DISCIPLINE_DISABLED = "Discipline not disabled";

    //direction
    const DANGER_DIRECTION_CREATED  = "Direction not created";
    const DANGER_DIRECTION_ENABLED  = "Direction not enabled";
    const DANGER_DIRECTION_DISABLED = "Direction not disabled";


}