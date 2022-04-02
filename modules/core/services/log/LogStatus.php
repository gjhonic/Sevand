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

    /**
     * Возвращает массив статусов
     * @return array
     */
    public static function getStatusesIds(): array
    {
        return [
            self::STATUS_INFO,
            self::STATUS_SUCCESS,
            self::STATUS_WARNING,
            self::STATUS_DANGER,
            self::STATUS_CRAZY,
        ];
    }

    /**
     * Возвращает мап статусов
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_INFO => 'info',
            self::STATUS_SUCCESS => 'success',
            self::STATUS_WARNING => 'warning',
            self::STATUS_DANGER => 'danger',
            self::STATUS_CRAZY => 'crazy',
        ];
    }
}