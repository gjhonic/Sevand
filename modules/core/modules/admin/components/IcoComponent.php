<?php

namespace app\modules\core\modules\admin\components;

/**
 * IcoComponent
 * Компонент для вставки иконок
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
class IcoComponent
{

    const VIEW_ICO = 'fa-eye';
    const EDIT_ICO = 'fa-pencil';
    const DELETE_ICO = 'fa-trash';

    /**
     * Возвращает иконку глазика
     * @return string
     */
    public static function view(): string
    {
        return self::layout(self::VIEW_ICO);
    }

    /**
     * Возвращает иконку ручки
     * @return string
     */
    public static function edit(): string
    {
        return self::layout(self::EDIT_ICO);
    }

    /**
     * Возвращает иконку корзины
     * @return string
     */
    public static function delete(): string
    {
        return self::layout(self::DELETE_ICO);
    }

    /**
     * Шаблон вывода иконки
     * @param string $classIco
     * @return string
     */
    private static function layout(string $classIco): string
    {
        return '<i class="fa '. $classIco . '" aria-hidden="true"></i>';
    }
}