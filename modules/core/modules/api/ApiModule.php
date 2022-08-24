<?php

namespace app\modules\core\modules\api;

use app\modules\core\Module;
use yii\web\ErrorHandler;
use Yii;

/**
 * core module definition class
 */
class ApiModule extends Module
{

    public $controllerNamespace = 'app\modules\core\modules\api\controllers';

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
        Yii::$app->i18n->translations['modules/core/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/core/modules/api/messages',
            'fileMap' => [
                'modules/core/modules/api/app' => 'app.php',
                'modules/core/modules/api/note' => 'note.php',
                'modules/core/modules/api/error' => 'error.php',
                'modules/core/modules/api/log' => 'log.php'
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/core/modules/api/' . $category, $message, $params, $language);
    }
}
