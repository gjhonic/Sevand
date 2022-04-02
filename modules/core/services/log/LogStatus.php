<?php
/**
 * LogStatus
 * Статусы для логирования
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\services\log;

class LogStatus
{
    //Статусы логов
    const STATUS_INFO = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_WARNING = 3;
    const STATUS_DANGER = 4;
    const STATUS_CRAZY = 5;
}