<?php
/**
 * StudentController
 * Основной Контроллер модуля core/api
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\api\controllers;

use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\api\models\ErrorApi;
use app\modules\core\modules\api\models\StudentApi;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Response;

/**
 * controller for work student the `core/api` module
 */
class StudentController extends BaseController
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
                        'actions' => ['get'],
                        'roles' => [User::ROLE_GUEST, User::ROLE_AUTHORIZED],
                    ],
                ],
            ],
        ];
    }

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
     * Возвращает студента по id
     * @return Response
     */
    public function actionGet(): Response
    {
        if (!empty(Yii::$app->request->get('id'))) {
            $student = StudentApi::findById(Yii::$app->request->get('id'));

            if ($student) {
                return $this->asJson($student->getStudentInArrayApi());
            } else {
                return $this->asJson([
                    'error' => ErrorApi::getDescriptionError(ErrorApi::ERROR_STUDENT_NOT_FOUND)
                ]);
            }
        } else {
            return $this->asJson([
                'error' => ErrorApi::getDescriptionError(ErrorApi::ERROR_EMPTY_ID_STUDENT)
            ]);
        }
    }
}
