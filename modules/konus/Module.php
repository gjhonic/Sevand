<?php

namespace app\modules\konus;

use Yii;

/**
 * konus module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\konus\controllers';

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
        Yii::$app->i18n->translations['modules/konus/*']=[
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/konus/messages',
            'fileMap' => [
                'modules/konus/app' => 'app.php',
                'modules/konus/note' => 'note.php',
                'modules/konus/error' => 'error.php'
            ],
        ];
    }

    public static function t($category, $message, $params=[], $language=null)
    {
        return Yii::t('modules/konus/' . $category, $message, $params, $language);
    }
}
