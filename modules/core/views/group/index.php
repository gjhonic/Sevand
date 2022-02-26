<?php

use app\modules\core\models\base\Course;
use app\modules\core\models\base\Department;
use app\modules\core\models\base\Direction;
use app\modules\core\models\base\Group;
use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'course_id',
                'filter' => Course::getCourseMap(),
                'value' => function ($model) {
                    return $model->course->title;
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
                'attribute' => 'direction_id',
                'filter' => Direction::getDirectionMap(),
                'value' => function ($model) {
                    return $model->direction->short_title;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Group $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
