<?php

namespace app\modules\core\models\error;

use app\modules\core\Module;
use Yii;

class UserError
{
    const SUCCESS_CREATE_USER = 0;
    const ERROR_VALIDATE = 1;
    const ERROR_CREATE_USER = 2;

    /**
     * Описание ошибок
     * @return array
     */
    public static function descriptionOfErrors(): array
    {
        return [
            self::ERROR_VALIDATE => Module::t('error', 'Error validation'),
            self::ERROR_CREATE_USER => Module::t('error', 'User creation error'),
        ];
    }

    /**
     * @param int $codeError
     * @return string
     */
    public static function getDescriptionError(int $codeError): string
    {
        return self::descriptionOfErrors()[$codeError];
    }

}