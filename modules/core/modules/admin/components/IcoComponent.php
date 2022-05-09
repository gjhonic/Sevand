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
    const VIEW_ICO     = 'fa-eye';
    const EDIT_ICO     = 'fa-pencil';
    const DELETE_ICO   = 'fa-trash';
    const ADD_ICO      = 'fa-plus';
    const ENABLE_ICO   = 'fa-check';
    const DISABLE_ICO  = 'fa-ban';
    const TRANSFER_ICO = 'fa-arrow-right';
    const BASE_ICO     = 'fa-database';

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
     * Возвращает иконку плюсика
     * @return string
     */
    public static function add(): string
    {
        return self::layout(self::ADD_ICO);
    }

    /**
     * Возвращает иконку галочки
     * @return string
     */
    public static function enable(): string
    {
        return self::layout(self::ENABLE_ICO);
    }

    /**
     * Возвращает иконку крестика
     * @return string
     */
    public static function disable(): string
    {
        return self::layout(self::DISABLE_ICO);
    }

    /**
     * Возвращает иконку перевода
     * @return string
     */
    public static function transfer(): string
    {
        return self::layout(self::TRANSFER_ICO);
    }

    /**
     * Возвращает иконку базы
     * @return string
     */
    public static function base(): string
    {
        return self::layout(self::BASE_ICO);
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