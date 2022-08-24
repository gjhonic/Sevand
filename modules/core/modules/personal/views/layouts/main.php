<?php

use app\modules\core\modules\personal\assets\PersonalAsset;
use yii\helpers\Html;

$nav = array_merge(require(__DIR__ . '/_nav/main.php'));

$currentController = Yii::$app->controller->id;
$currentAction = Yii::$app->controller->action->id;

/** @var yii\web\View $this */
/** @var string $content */

PersonalAsset::register($this);
?>
<?php
$this->beginPage() ?>
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
        <link rel="shortcut icon" href="https://img.icons8.com/ios/50/000000/admin-settings-male.png" type="image/png">
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head() ?>
    </head>
    <body>
    <?php
    $this->beginBody() ?>
        <main id="app">
            <div class="container py-4">
                <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94"
                             role="img"><title>Bootstrap</title>
                        </svg>
                        <span class="fs-4">SEVAND</span>
                    </a>
                    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                        <?php foreach ($nav as $item) { ?>
                                <?php if($item['controller'] === $currentController &&
                                $item['action'] === $currentAction ) {
                                    $classItem = 'current-nav';
                                 } else {
                                    $classItem = '';
                                } ?>
                            <a class="me-3 py-2 text-dark text-decoration-none <?php echo $classItem; ?>"
                               href="<?php echo $item['url']; ?>">
                                <?php echo $item['label']; ?>
                            </a>
                        <?php } ?>
                    </nav>
                </header>

                <?= $content ?>
            </div>
        </main>

        <?php
        $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage() ?>
