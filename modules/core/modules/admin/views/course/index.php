<?php

use app\modules\core\models\base\Course;
use app\modules\core\Module;
use app\modules\core\modules\admin\components\IcoComponent;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\CourseSearch */

$this->title = Module::t('app', 'Courses');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Dictionaries'), 'url' => ['/admin/dictionaries']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
     $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
         [
             'label' => Module::t('app', 'Action column'),
             'format' => 'raw',
             'value' => function ($model) {
                 $html = Html::a(IcoComponent::view() . ' ' . Module::t('app', 'Show'), Url::to(['view', 'id' => $model->id]), ['class' => 'btn btn-success btn-block']);
                 return $html;
             }
         ],
        ]; ?>

    <?= DynaGrid::widget([
        'gridOptions' => [
            'resizeStorageKey' => 'Universities',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'toolbar' => [
                [
                    'content' =>
                        Html::a(
                            '<i class="glyphicon glyphicon-repeat"></i>',
                            ['index'],
                            [
                                'data-pjax' => 0,
                                'class' => 'btn btn-default',
                                'title' => Module::t('app', 'Reset')
                            ]
                        ) .
                        Html::a(
                            '<i class="glyphicon glyphicon-print"></i>',
                            ['#'],
                            [
                                'data-pjax' => 0,
                                'class' => 'btn btn-default print-grid',
                                'title' => Module::t('app', 'Print')
                            ]
                        ),
                ],
                ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
                '{toggleData}',
                '{export}',
            ],
            'panel' => [
                'after' => false
            ],
            'exportConversions' => [
                ['from_xls' => '-', 'to_xls' => '–'],
            ],
        ],
        'options' => [
            'id' => 'Universities'
        ],
        'columns' => $columns,
    ]);
    ?>


</div>
