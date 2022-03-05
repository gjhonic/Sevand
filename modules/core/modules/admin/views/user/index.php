<?php

use app\modules\core\models\base\Department;
use app\modules\core\models\base\User;
use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\UserSearch */

$this->title = Module::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'surname',
            'name',

            [
                'attribute' => 'status_id',
                'filter' => User::getStatuses(),
                'value' => function ($model) {
                    return $model->status;
                }
            ],
            [
                'attribute' => 'role',
                'filter' => User::getRoles(),
                'value' => function ($model) {
                    return $model->role;
                }
            ],
            [
                'attribute' => 'department_id',
                'filter' => Department::getDepartmentGroup(),
                'value' => function ($model) {
                    return $model->department->short_title;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
