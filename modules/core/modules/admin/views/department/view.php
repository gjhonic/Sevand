<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Department */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'short_title',
            [
                'attribute' => 'university_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->university->short_title;
                }
            ]
        ],
    ]) ?>

    <h3>
        <?=Module::t('app', 'Description')?>
    </h3>
    <div class="jumbotron">
        <?=$model->description?>
    </div>
</div>
