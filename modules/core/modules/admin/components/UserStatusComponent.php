<?php

namespace app\modules\core\modules\admin\components;

use app\modules\core\Module;

/**
 * UserStatusComponent
 * Компонент для статуса пользователя
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
class UserStatusComponent
{
    const STATUS_ACTIVE = "Active";
    const STATUS_ACTIVE_ID = 1;

    const STATUS_TAG_TO_BAN = "Tag to ban";
    const STATUS_TAG_TO_BAN_ID = 2;

    const STATUS_BAN = "Ban";
    const STATUS_BAN_ID = 3;

    /**
     * Мап статусов активности
     * @return array
     */
    private static function dataStatus(): array
    {
        return [
            self::STATUS_ACTIVE_ID => [
                'icon' => 'fa-check',
                'class' => 'badge-success',
                'title' => self::STATUS_ACTIVE,
            ],
            self::STATUS_TAG_TO_BAN_ID => [
                'icon' => 'fa-check',
                'class' => 'badge-success',
                'title' => self::STATUS_TAG_TO_BAN,
            ],
            self::STATUS_BAN_ID => [
                'icon' => 'fa-ban',
                'class' => 'badge-danger',
                'title' => self::STATUS_BAN,
            ],
        ];
    }

    /**
     * Метод возвразает цветной текстовый статус конкуса
     * @param int $status_id
     * @param int $size
     * @return string
     */
    public static function getLabel(int $status_id, int $size=4): string
    {
        $class = self::dataStatus()[$status_id]['class'];
        $title = self::dataStatus()[$status_id]['title'];

        return "<h". $size . "><span class='badge " . $class . "'>" . Module::t('app', $title) . "</span><h" . $size . ">";
    }

}