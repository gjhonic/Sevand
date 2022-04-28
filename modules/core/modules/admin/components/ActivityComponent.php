<?php

namespace app\modules\core\modules\admin\components;

use app\modules\core\Module;

/**
 * ActivityComponent
 * Компонент для статуса активности сущности
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
class ActivityComponent
{
    const ACTIVITY_ENABLE_ID = 1;
    const ACTIVITY_ENABLE = 'Active';

    const ACTIVITY_DISABLE_ID = 2;
    const ACTIVITY_DISABLE = 'Not active';


    private static function dataStatus(): array
    {
        return [
            self::ACTIVITY_ENABLE_ID => [
                'icon' => 'fa-check',
                'class' => 'badge-success',
                'title' => self::ACTIVITY_ENABLE,
            ],
            self::ACTIVITY_DISABLE_ID => [
                'icon' => 'fa-ban',
                'class' => 'badge-danger',
                'title' => self::ACTIVITY_DISABLE,
            ],
        ];
    }

    /**
     * Метод возвразает цветной текстовый статус конкуса
     * @param int $status_id
     * @return string
     */
    public static function getLabel(int $status_id): string
    {
        $class = self::dataStatus()[$status_id]['class'];
        $title = self::dataStatus()[$status_id]['title'];

        return "<h4><span class='badge " . $class . "'>" . Module::t('app', $title) . "</span><h4>";
    }

}