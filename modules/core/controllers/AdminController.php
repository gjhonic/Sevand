<?php

namespace app\modules\core\controllers;

use yii\web\Controller;

/**
 * Admin controller for the `core` module
 */
class AdminController extends Controller
{
    public $layout = 'admin';

    /**
     * HomePage admin
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBases()
    {
        return $this->render('bases');
    }
}
