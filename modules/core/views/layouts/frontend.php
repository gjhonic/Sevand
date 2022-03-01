<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\modules\core\assets\FrontendAsset;

/* @var $content string */

$navigations = array_merge(require(__DIR__ . '/_nav/frontend.php'));

FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="https://img.icons8.com/cotton/64/000000/business-group.png" type="image/png">
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
        <div class="container">
            <a class="navbar-brand" href=""><i class="fa fa-bolt" aria-hidden="true"></i>
                <?=Module::t('app', 'SEVAND');?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav ml-auto">

                    <?php foreach ($navigations as $nav){ ?>
                        <li class="nav-item" style='margin-right:10px; margin-bottom:5px;'>
                            <a class="btn btn-white btn-sm px-4 btn-block" href="<?=$nav['url']?>"><i class="uil <?=$nav['ico']?> mr-1 font-16"></i>
                                <?=$nav['label']?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (!Yii::$app->user->isGuest){ ?>
                        <li class="nav-item" style='margin-right:10px; margin-bottom:5px;'>
                            <a class="btn btn-white btn-sm px-4 btn-block" href="#" data-toggle="modal"
                               data-target="#logoutModal"><i class="uil uil-exit mr-1 font-16"></i>
                                <?=Module::t('app', 'Go out')?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Модалка выхода -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=Module::t('note', 'Do you really want to leave')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=Module::t('app', 'Stay')?></button>
                    <a type="button" class="btn btn-warning" href="<?=Url::to('/signout')?>"><?=Module::t('app', 'Go out')?></a>
                </div>
            </div>
        </div>
    </div>

    <?= Breadcrumbs::widget([
        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
        'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
        'homeLink' => [
            'label' => Module::t('app', 'Home page'),
            'url' => Url::to('app', '/index'),
            'title' => Module::t('app', 'Go to home page'),
        ],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumb', 'style' => ''],
    ]); ?>

    <div class="main-wraper">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>