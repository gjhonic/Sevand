<?php

namespace app\modules\core\modules\api\models;

use app\modules\core\modules\api\ApiModule;
use Yii;

/**
 * Класс Ошибок Api
 */
class ErrorApi
{
    //Student
    const ERROR_EMPTY_ID_STUDENT = 1;
    const ERROR_STUDENT_NOT_FOUND = 2;


    /**
     * Описание ошибок
     * @return array
     */
    public static function descriptionOfErrors(): array
    {
        return [
            self::ERROR_EMPTY_ID_STUDENT => ApiModule::t('error', 'Student id parameter not specified'),
            self::ERROR_STUDENT_NOT_FOUND => ApiModule::t('error', 'Student not found'),
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