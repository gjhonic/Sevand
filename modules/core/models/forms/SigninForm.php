<?php
/**
 * SigninForm
 * Форма аутентификации
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\models\forms;

use app\modules\core\models\base\User;
use app\modules\core\Module;
use Yii;
use yii\base\Model;
use app\modules\core\models\auth\UserIdentity;

/**
 * Class SigninForm
 * @package app\modules\core\models\forms
 *
 * @property string $username
 * @property string $password
 * @property bool $rememberMe
 */
class SigninForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    const SUCCESS_AUTH = 0;
    const ERROR_AUTH_FAILED = 1;
    const ERROR_FAILED_LOGIN_PASS = 2;

    /**
     * Описание ошибок
     * @return array
     */
    public static function descriptionOfErrors(): array
    {
        return [
            self::ERROR_AUTH_FAILED => 'Authorization failed',
            self::ERROR_FAILED_LOGIN_PASS => 'Invalid username or password!',
        ];
    }

    /**
     * @param int $codeError
     * @return string
     */
    public static function getDescriptionError(int $codeError): string
    {
        return self::descriptionOfErrors()[$codeError];
    }

    /**
     * @return array - правила валидации.
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Метод валидации пароля.
     * @param $attribute , $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Метод "залогинивания" юзера в сессию.
     * @return int
     */
    public function login(): int
    {
        if ($this->validate()) {
            if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                //print_r(Yii::$app->user->identity);
                return self::SUCCESS_AUTH;
            } else {
                return self::ERROR_AUTH_FAILED;
            }
        } else {
            return self::ERROR_FAILED_LOGIN_PASS;
        }
    }

    /**
     * Метод "залогинивания" юзера в сессию.
     * @param array $post
     * @return bool
     */
    public function set(array $post): bool
    {
        if (isset($post['username']) && isset($post['password'])) {
            if ($post['username'] != '' && $post['password'] != '') {
                $this->username = $post['username'];
                $this->password = $post['password'];
                if (isset($post['rememberMe'])) {
                    $this->rememberMe = true;
                }
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * Метод заполняем свойство _user  обьектом user, если он не заполнен и возвращает его.
     */
    public function getUser(): ?object
    {
        if ($this->_user === false) {
            $this->_user = UserIdentity::findByUsername($this->username);
        }

        return $this->_user;
    }
}
