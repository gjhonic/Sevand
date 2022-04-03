<?php
/**
 * DirectionController
 * Контроллер для работы с направлеениями для модуля core/admin
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */

namespace app\modules\core\modules\admin\controllers;

use app\modules\core\modules\admin\models\Direction;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\models\search\DirectionSearch;
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
 * DirectionController implements the CRUD actions for Direction model.
 */
class DirectionController extends Controller
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
                        'roles' => [User::ROLE_ROOT, User::ROLE_ADMIN, User::ROLE_MODERATOR],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => [User::ROLE_ROOT, User::ROLE_ADMIN],
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
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DirectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Direction model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Direction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Direction();
        $model->setDepartmentFromUser();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if ($model->save()) {
                    LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_DIRECTION_CREATED, 'DirectionId: ' . $model->id);
                    Yii::$app->session->setFlash('success', Module::t('note', 'Direction successfully created'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_DIRECTION_CREATED);
                    Yii::$app->session->setFlash('danger', Module::t('error', 'Direction creation error'));
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        return $this->render('update', [
            'model' => $model,
        ]);
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
     * Enable direction
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEnable($id)
    {
        $direction = $this->findModel($id);
        if ($direction->enable()) {
            LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_DIRECTION_ENABLED, 'DirectionId: ' . $direction->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'Direction successfully enabled'));
        } else {
            LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_DIRECTION_ENABLED, 'DirectionId: ' . $direction->id);
            Yii::$app->session->setFlash('danger', Module::t('error', 'Direction not enabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Disable direction
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDisable($id)
    {
        $direction = $this->findModel($id);
        if ($direction->disable()) {
            LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_DIRECTION_DISABLED, 'DirectionId: ' . $direction->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'Direction successfully enabled'));
        } else {
            LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_DIRECTION_DISABLED, 'DirectionId: ' . $direction->id);
            Yii::$app->session->setFlash('danger', Module::t('error', 'Direction not disabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Direction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Direction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Direction
    {
        $model = Direction::findOne([
            'id' => $id,
        ]);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('error', 'The requested page does not exist.'));
    }
}
