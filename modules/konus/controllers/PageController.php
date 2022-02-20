<?php

namespace app\modules\konus\controllers;

use yii\web\Controller;

/**
 * Default controller for the `konus` module
 */
class PageController extends Controller
{

    public $layout = 'admin';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
