<?php

namespace app\modules\attendance\controllers;

use yii\web\Controller;

/**
 * Default controller for the `attendance` module
 */
class PageController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
