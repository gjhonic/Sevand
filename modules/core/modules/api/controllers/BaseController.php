<?php
/**
 * BaseController
 * Base Контроллер модуля core/api
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */

namespace app\modules\core\modules\api\controllers;

use app\models\system\Lang;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * BaseController for the `core/api` module
 */
class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    $this->redirect(Url::to('/signin'));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => [],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->checkLangParam();
        return parent::beforeAction($action);
    }

    /**
     * Метод проверяет установлен ли параметр lang
     * @return void
     */
    private function checkLangParam(): void
    {
        if (!empty(Yii::$app->request->get('lang'))) {
            if(in_array(Yii::$app->request->get('lang'), Lang::getlanguages())){
                $this->setLang(Yii::$app->request->get('lang'));
            }
        } else {
            $this->setLang(Lang::LANG_EN);
        }
    }

    /**
     * Метод изменяет язык приложения
     * @param string $lang
     * @return void
     */
    private function setLang(string $lang): void
    {
        Yii::$app->language = $lang;
    }
}
