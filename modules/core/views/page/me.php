<?php

use app\modules\core\Module;
use app\modules\core\widgets\Alert;
use yii\helpers\Url;

/* @var $user \app\modules\core\models\base\User */

$this->title = Module::t('app', 'Personal account');
?>
<div class="main-wraper">
    <section class="section bg-profile" id="profile_ripple">
        <div class="zoo-profile">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-print-6 align-self-center mb-3 mb-lg-0">
                        <div class="zoo-profile-main">
                            <div class="zoo-profile-main-pic">
                                <img src="https://img.icons8.com/color/100/000000/admin-settings-male.png"
                                     style="background-color: white;" class="rounded-circle"/>

                            </div>
                            <div class="zoo-profile_user-detail">
                                <h5 class="zoo-user-name"><?= $user->surname . " " . $user->name ?></h5>
                                <p class="cd-headline">
                                  <span class="">
                                    <b class="is-visible">
                                        <?php
                                        if (isset($attributes['status']) && $attributes['status'] != '') {
                                            echo $attributes['status'];
                                        } ?>
                                    </b>
                                  </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-print-4 ml-auto">
                        <ul class="list-unstyled personal-detail">
                            <li><i class="'uil uil-phone-volume mr-2"></i> <b> Phone </b>
                                :

                            </li>
                            <li class="mt-2"><i class="uil uil-envelope mt-2 mr-2"></i> <b> Email </b>

                            </li>
                        </ul>

                        <!-- Соц сети -->
                        <ul class="list-inline social-icon mb-0">
                            <li class="list-inline-item">
                                <a href="" class="bg-secondary">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <?= Alert::widget() ?>
    <br>

    <section class="section-md">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="header-title mb-3">Обо мне!</h4>
                </div>
                <div class="col-sm-6 col-print-6">
                    <h4 class="text-primary font-weight-bold">Я <?= $user->surname . " " . $user->name ?>
                        <?php
                        if (Yii::$app->user->identity->id == $user->id) { ?>
                            <a href="<?=Url::to()?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                        <?php
                        } ?>
                    </h4>

                </div>
                <div class="col-sm-5 col-print-5 offset-lg-1 align-self-center">
                    <p>
                        <span class="personal-detail-title"><?=Module::t('app', 'Full name')?></span>
                        <span class="personal-detail-info"><?= $user->surname . " " . $user->name ?></span>
                    </p>
                    <p>
                        <span class="personal-detail-title"><?=Module::t('app', 'Login')?></span>
                        <span class="personal-detail-info"><?= $user->username ?></span>
                    </p>
                    <p>
                        <span class="personal-detail-title"><?=Module::t('app', 'Department')?></span>
                        <span class="personal-detail-info"><a
                                    href='?r=sevand/core/frontend/show-unit&id=<?= $user->department_id ?>'><?= $user->department->short_title ?></a></span>
                    </p>
                    <p>
                        <span class="personal-detail-title"><?=Module::t('app', 'Role')?></span>
                        <span class="personal-detail-info"><?= $user->role ?></span>
                    </p>

                </div>
            </div>
        </div>
    </section>
</div>