<?php

namespace app\models\system;

/**
 * Класс для локализации
 */
class Lang
{
    const LANG_EN = 'en';
    const LANG_RU = 'ru';

    /**
     * Возвращает языки проекта
     * @return array
     */
    public static function getlanguages(): array
    {
        return [
            self::LANG_EN,
            self::LANG_RU,
        ];
    }
}