<?php

namespace app\modules\attendance;

use Yii;

/**
 * attendance module definition class
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\attendance\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/attendance/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/attendance/messages',
            'fileMap' => [
                'modules/attendance/app' => 'app.php',
                'modules/attendance/note' => 'note.php',
                'modules/attendance/error' => 'error.php'
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/attendance/' . $category, $message, $params, $language);
    }
}
