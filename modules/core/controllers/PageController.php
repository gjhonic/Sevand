<?php

namespace app\modules\core\controllers;

use yii\web\Controller;

/**
 * Default controller for the `core` module
 */
class PageController extends Controller
{
    public $layout = 'default';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Render homepage
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Render personal account user
     * @return string
     */
    public function actionMe()
    {
        return $this->render('me');
    }

    /**
     * Render ban page
     * @return string
     */
    public function actionBan()
    {
        return $this->render('ban');
    }
}
