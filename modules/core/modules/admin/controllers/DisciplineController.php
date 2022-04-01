<?php
/**
 * DisciplineController
 * Контроллер для работы с дисциплинами в модуле core/admin
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */

namespace app\modules\core\modules\admin\controllers;

use app\modules\core\models\base\Log;
use app\modules\core\modules\admin\models\Discipline;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\models\search\DisciplineSearch;
use app\modules\core\Module;
use app\modules\core\services\log\LogMessage;
use app\modules\core\services\log\LogService;
use app\modules\core\services\user\StatusService;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisciplineController implements the CRUD actions for Discipline model.
 */
class DisciplineController extends Controller
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
     * Lists all Discipline models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DisciplineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Discipline model.
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
     * Creates a new Discipline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Discipline();
        $model->setDepartmentFromUser();
        if ($model->load($this->request->post()) && $model->validate()) {
            if ($model->save()) {
                LogService::createLog(Log::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_DISCIPLINE_CREATED, 'DisciplineId: ' . $model->id);
                Yii::$app->session->setFlash('success', Module::t('note', 'Discipline successfully created'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                LogService::createLog(Log::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_DISCIPLINE_CREATED);
                Yii::$app->session->setFlash('danger', Module::t('error', 'Discipline creation error'));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Discipline model.
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
     * Deletes an existing Discipline model.
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
     * Enable discipline
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEnable($id)
    {
        $discipline = $this->findModel($id);
        if ($discipline->enable()) {
            LogService::createLog(Log::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_DISCIPLINE_ENABLED, 'DisciplineId: ' . $discipline->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'Discipline successfully enabled'));
        } else {
            LogService::createLog(Log::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_DISCIPLINE_ENABLED, 'DisciplineId: ' . $discipline->id);
            Yii::$app->session->setFlash('danger', Module::t('error', 'Discipline not enabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Enable discipline
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDisable($id)
    {
        $discipline = $this->findModel($id);
        if ($discipline->disable()) {
            LogService::createLog(Log::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_DISCIPLINE_DISABLED, 'DisciplineId: ' . $discipline->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'Discipline successfully enabled'));
        } else {
            LogService::createLog(Log::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_DISCIPLINE_DISABLED, 'DisciplineId: ' . $discipline->id);
            Yii::$app->session->setFlash('danger', Module::t('error', 'Discipline not disabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Discipline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Discipline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Discipline
    {
        if (($model = Discipline::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('error', 'The requested page does not exist.'));
    }
}
