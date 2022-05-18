<?php

use app\modules\core\Module;
use yii\helpers\Url;

$this->title = Module::t('app', 'Home page');
?>

<section class="section-md">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3"><?= Module::t('app', 'SEVAND'); ?></h2>
            </div>
            <div class="col-sm-6 col-print-6">
                <p>
                    <?=Module::t('note', 'SEVAND - a system for collecting information about visits, achievements (cultural, social, sports, scientific), physical standards, consultations.')?>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="bg-funfact section-md">
    <div class="container">
        <div class="row justify-content-center" id="counter">
            <div class="col-sm-4 digit-counter">
                <div class="media">
                    <a href="<?=Url::to('/student/index')?>"><i
                                class="uil uil-user text-warning mr-2 align-self-center"></i></a>
                    <div class="media-body align-self-center">
                        <h3 class="mb-1"><span class="counter-value" data-count=""></span></h3>
                        <h5 class="counter-name mt-0"><?=Module::t('app','Students')?></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 digit-counter">
                <div class="media">
                    <a href="i<?=Url::to('/group/index')?>"><i
                                class="uil uil-users-alt text-success mr-2 align-self-center"></i></a>
                    <div class="media-body align-self-center">
                        <h3 class="mb-1"><span class="counter-value" data-count=""></span></h3>
                        <h5 class="counter-name mt-0"><?=Module::t('app','Groups')?></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 digit-counter">
                <div class="media">
                    <a href="<?=Url::to('modules')?>"><i
                                class="uil uil-circle text-primary mr-2 align-self-center"></i></a>
                    <div class="media-body align-self-center">
                        <h3 class="mb-1"><span class="counter-value" data-count=""></span></h3>
                        <h5 class="counter-name mt-0"><?=Module::t('app','Modules')?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
