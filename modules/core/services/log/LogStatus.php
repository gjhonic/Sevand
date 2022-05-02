<?php
/**
 * LogStatus
 * Статусы для логирования
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\services\log;

use app\modules\core\Module;

class LogStatus
{
    //Статусы логов
    const STATUS_INFO = 1;
    const STATUS_INFO_STRING = 'info';

    const STATUS_SUCCESS = 2;
    const STATUS_SUCCESS_STRING = 'success';

    const STATUS_WARNING = 3;
    const STATUS_WARNING_STRING = 'warning';

    const STATUS_DANGER = 4;
    const STATUS_DANGER_STRING = 'danger';

    const STATUS_CRAZY = 5;
    const STATUS_CRAZY_STRING = 'crazy';


    private static function dataStatus(): array
    {
        return [
            self::STATUS_INFO => [
                'class' => 'badge-info',
                'title' => self::STATUS_INFO_STRING,
            ],
            self::STATUS_SUCCESS => [
                'class' => 'badge-success',
                'title' => self::STATUS_SUCCESS_STRING,
            ],
            self::STATUS_WARNING => [
                'class' => 'badge-warning',
                'title' => self::STATUS_WARNING_STRING,
            ],
            self::STATUS_DANGER => [
                'class' => 'badge-danger',
                'title' => self::STATUS_DANGER_STRING,
            ],
            self::STATUS_CRAZY => [
                'class' => 'badge-dark',
                'title' => self::STATUS_CRAZY_STRING,
            ],
        ];
    }

    /**
     * Метод возвразает цветной текстовый статус лога
     * @param int $status_id
     * @return string
     */
    public static function getLabel(int $status_id, $hSize = 'h5'): string
    {
        $class = self::dataStatus()[$status_id]['class'];
        $title = self::dataStatus()[$status_id]['title'];

        return "<" . $hSize . "><span class='badge " . $class . "'>" . Module::t('app', $title) . "</span></" . $hSize  . ">";
    }
}