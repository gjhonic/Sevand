<?php

use app\modules\core\models\base\Department;
use app\modules\core\models\base\University;
use app\modules\core\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\DepartmentSearch */

$this->title = Module::t('app', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create Department'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'short_title',
            'title',

            [
                'attribute' => 'university_id',
                'filter' => ArrayHelper::map(University::find()->all(), 'id', 'short_title'),
                'value' => function ($model) {
                    return $model->university->short_title;
                }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Department $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
