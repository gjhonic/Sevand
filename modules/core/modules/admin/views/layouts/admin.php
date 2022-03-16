<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\assets\AdminAsset;
use app\modules\core\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$nav = array_merge(require(__DIR__ . '/_nav/admin.php'));

/** @var yii\web\View $this */
/** @var string $content */

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <script src="/media/core/admin/js/jquery/jquery.min.js"></script>
        <link rel="shortcut icon" href="https://img.icons8.com/ios/50/000000/admin-settings-male.png" type="image/png">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?= Yii::$app->homeUrl ?>" title="<?=Module::t('app', 'Admin panel')?>">
            <?=Module::t('app', 'Admin panel')?>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">

                        <?php

                        foreach ($nav as $elem) {
                            $isActive = '';
                            if (Yii::$app->controller->action->id == $elem['action'] && Yii::$app->controller->id == $elem['controller']){
                                $isActive = 'active';
                            }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $isActive ?>" href="<?= $elem['url'] ?>"><?= $elem['label'] ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                                Выйти
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Вы действительно хотите выйти</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Остаться</button>
                            <a type="button" class="btn btn-warning" href="?r=sevand/core/auth/logout">Выйти</a>
                        </div>
                    </div>
                </div>
            </div>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?= Breadcrumbs::widget([
                        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                        'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                        'homeLink' => [
                            'label' => 'Главная ',
                            'url' => Url::to('admin'),
                            'title' => 'Перейти на главную страницу',
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class' => 'breadcrumb', 'style' => ''],
                    ]); ?>

                <?= Alert::widget() ?>
                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="/media\core\admin\js\bootstrap\bootstrap.bundle.js"></script>
    <script src="/media\core\admin\js\dashboard.js"></script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>