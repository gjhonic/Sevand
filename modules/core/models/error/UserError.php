<?php

namespace app\modules\core\models\error;

use Yii;

class UserError
{
    const ERROR_VALIDATE = 1;

    /**
     * Описание ошибок
     * @return array
     */
    public static function descriptionOfErrors(): array
    {
        return [
            self::ERROR_VALIDATE => Yii::t('error', 'Error validation'),
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