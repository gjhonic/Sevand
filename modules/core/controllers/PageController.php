<?php

namespace app\modules\core\controllers;

use app\modules\core\models\base\User;
use app\modules\core\services\user\StatusService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `core` module
 */
class PageController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function () {
                    $this->redirect(Url::to(['/signin']));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => [User::ROLE_GUEST, User::ROLE_AUTHORIZED],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['me', 'ban'],
                        'roles' => [User::ROLE_AUTHORIZED],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            if (StatusService::checkStatusBanUser(Yii::$app->user->identity)) {
                $this->redirect('/ban');
            }
        }

        return parent::beforeAction($action);
    }

    public $layout = 'frontend';

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
        return $this->render('me', [
            'user' =>  Yii::$app->user->identity,
        ]);
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
