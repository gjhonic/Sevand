<?php

use app\modules\core\models\base\Department;
use app\modules\core\models\base\Direction;
use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\DirectionSearch */

$this->title = Module::t('app', 'Directions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create Direction'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'short_title',
            [
                'attribute' => 'department_id',
                'filter' => Department::getDepartmentGroup(),
                'value' => function ($model) {
                    return $model->department->short_title;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Direction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
