<?php

use yii\helpers\Html;
use app\modules\auth\assets\AuthAsset;

/* @var $content string */

AuthAsset::register($this);

$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= $content ?>

    <div id="dropDownSelect1"></div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>