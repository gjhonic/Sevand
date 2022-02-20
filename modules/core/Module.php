<?php

namespace app\modules\core;

use Yii;

/**
 * core module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\core\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/core/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/core/messages',
            'fileMap' => [
                'modules/core/app' => 'app.php',
                'modules/core/note' => 'note.php',
                'modules/core/error' => 'error.php'
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/core/' . $category, $message, $params, $language);
    }
}
