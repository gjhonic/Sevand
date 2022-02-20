<?php

namespace app\modules\core\controllers;

use yii\web\Controller;

/**
 * Default controller for the `core` module
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
