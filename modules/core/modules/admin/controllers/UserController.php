<?php
/**
 * UserController
 * Контроллер для работы с пользователями в модуле core\admin
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */

namespace app\modules\core\modules\admin\controllers;

use app\modules\core\models\error\UserError;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\models\search\UserSearch;
use app\modules\core\Module;
use app\modules\core\services\log\LogMessage;
use app\modules\core\services\log\LogService;
use app\modules\core\services\log\LogStatus;
use app\modules\core\services\user\StatusService;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController
 */
class UserController extends Controller
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
                        'actions' => ['index', 'view', 'enable', 'disable'],
                        'roles' => [User::ROLE_MODERATOR, User::ROLE_ADMIN, User::ROLE_ROOT],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'create-student', 'update', 'delete'],
                        'roles' => [User::ROLE_ADMIN, User::ROLE_ROOT],
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

    public $layout = 'admin';

    /**
     * Lists all Direction models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]
        );
    }

    /**
     * Displays a single Direction model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setDepartmentFromUser();
        if ($model->load($this->request->post()) && $model->validate()) {
            $codeCreateUser = $model->createUser(false);
            if ($codeCreateUser === UserError::SUCCESS_CREATE_USER) {
                LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_USER_CREATED, 'UserId: ' . $model->id);
                Yii::$app->session->setFlash('info', Module::t('note', 'User successfully created'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_USER_CREATED);
                Yii::$app->session->setFlash('warning', Module::t('note', UserError::getDescriptionError($codeCreateUser)));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreateStudent()
    {
        $model = new User();
        $model->setStudentRole();
        $model->setDepartmentFromUser();
        if ($model->load($this->request->post()) && $model->validate()) {
            $codeCreateUser = $model->createStudent(false);
            if ($codeCreateUser === UserError::SUCCESS_CREATE_USER) {
                LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_USER_CREATED, 'UserId: ' . $model->id);
                Yii::$app->session->setFlash('info', Module::t('note', 'User successfully created'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_USER_CREATED);
                Yii::$app->session->setFlash('warning', Module::t('note', UserError::getDescriptionError($codeCreateUser)));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render(
            'create_student',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Updates an existing Direction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing Direction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Enable user
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEnable($id)
    {
        $user = $this->findModel($id);
        if ($user->enable()) {
            LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_USER_ENABLED, 'UserId: ' . $user->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'User successfully enabled'));
        } else {
            LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_USER_ENABLED, 'UserId: ' . $user->id);
            Yii::$app->session->setFlash('danger', Module::t('note', 'User not enabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Enable user
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDisable($id)
    {
        $user = $this->findModel($id);
        if ($user->disable()) {
            LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_USER_DISABLED, 'UserId: ' . $user->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'User successfully enabled'));
        } else {
            LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_USER_DISABLED, 'UserId: ' . $user->id);
            Yii::$app->session->setFlash('danger', Module::t('note', 'User not disabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Direction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): User
    {
        $model = User::findOne([
            'id' => $id,
        ]);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('error', 'The requested page does not exist.'));
    }
}
