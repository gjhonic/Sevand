<?php

namespace app\modules\auth;

use Yii;
use yii\web\ErrorHandler;

/**
 * Auth module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\auth\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        \Yii::configure($this, [
            'components' => [
                'errorHandler' => [
                    'class' => ErrorHandler::className(),
                    'errorAction' => '/core/page/error',
                ]
            ],
        ]);

        /** @var ErrorHandler $handler */
        $handler = $this->get('errorHandler');
        \Yii::$app->set('errorHandler', $handler);
        $handler->register();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/auth/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/auth/messages',
            'fileMap' => [
                'modules/auth/app' => 'app.php',
                'modules/auth/note' => 'note.php',
                'modules/auth/error' => 'error.php',
                'modules/auth/log' => 'log.php'
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/auth/' . $category, $message, $params, $language);
    }
}
