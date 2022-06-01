<?php
/**
 * AuthController
 * Контроллер для авторизации
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\auth\controllers;

use app\modules\core\models\base\User;
use app\modules\core\models\forms\SigninForm;
use app\modules\core\Module;
use app\modules\core\services\log\LogMessage;
use app\modules\core\services\log\LogService;
use app\modules\core\services\log\LogStatus;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Контроллер для аутентификации
 */
class SiteController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    $this->redirect(Url::to(['/signin']));
                },
                'rules' => [
                    [
                        'actions' => ['signin'],
                        'allow' => true,
                        'roles' => [User::ROLE_GUEST, User::ROLE_AUTHORIZED],
                    ],
                    [
                        'actions' => ['signout'],
                        'allow' => true,
                        'roles' => [User::ROLE_AUTHORIZED],
                    ],
                ],
            ],
        ];
    }

    public function actions(): array
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

    public $layout = 'auth';

    /**
     * Метод обрабатывает форму аутентификация
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionSignin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl);
        }

        $model = new SigninForm();

        if ($model->set(Yii::$app->request->post())) {
            $resLogin = $model->login();
            if($resLogin == SigninForm::SUCCESS_AUTH){
                LogService::createLog(LogStatus::STATUS_INFO, Yii::$app->user->identity->id, LogMessage::INFO_USER_LOGGED_IN);
                Yii::$app->session->setFlash('info', Module::t('note', 'You have successfully signed in'));
                return $this->redirect(Url::to(['/me']));
            }else{
                Yii::$app->session->setFlash('danger', Module::t('error', SigninForm::getDescriptionError($resLogin)));
            }
        }

        $model->password = '';
        return $this->render('signin', [
            'model' => $model,
        ]);
    }

    /**
     * Метод выхода из аккаунта
     * @return \yii\web\Response
     */
    public function actionSignout(): \yii\web\Response
    {
        Yii::$app->user->logout();
        if (isset($session))
            $session->destroy();

        return $this->redirect(Yii::$app->homeUrl);
    }
}
