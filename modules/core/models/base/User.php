<?php

namespace app\modules\core\models\base;

use app\modules\core\models\queries\UserQuery;
use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $username
 * @property string $password
 * @property string $role
 * @property int $status_id
 * @property string $code
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string $created_at
 * @property string $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    //Роли пользователей
    const ROLE_ROOT = "root";
    const ROLE_ADMIN = "admin";
    const ROLE_MODERATOR = "moderator";
    const ROLE_CURATOR = "curator";
    const ROLE_HEADMAN = "headman";
    const ROLE_STUDENT = "student";

    const ROLE_GUEST = "?";
    const ROLE_AUTHORIZED = "@";

    //Статусы пользователей
    const STATUS_ACTIVE = "active";
    const STATUS_ACTIVE_ID = 1;

    const STATUS_TAG_TO_BAN = "tag to ban";
    const STATUS_TAG_TO_BAN_ID = 2;

    const STATUS_BAN = "ban";
    const STATUS_BAN_ID = 3;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_user}}';
    }

    public function rules(): array
    {
        return [
            [['name', 'surname', 'username', 'password', 'role', 'status_id'], 'required'],
            [['status_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'surname'], 'string', 'max' => 50],
            [['username', 'password'], 'string', 'max' => 255],
            [['auth_key', 'access_token'], 'string', 'max' => 32],
            [['role'], 'string', 'max' => 15],
            [['username'], 'unique'],
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => Module::t('app', 'Name'),
            'surname' => Module::t('app', 'Surname'),
            'username' => Module::t('app', 'Username'),
            'password' => Module::t('app', 'Password'),
            'role' => Module::t('app', 'Role'),
            'status_id' => Module::t('app', 'Status'),
            'department_id' => Module::t('app', 'Department'),
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at')
        ];
    }

    /**
     * Возврщает мап ролей без рута
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_ADMIN => Module::t('app', 'Admin'),
            self::ROLE_MODERATOR => Module::t('app', 'Moderator'),
            self::ROLE_CURATOR => Module::t('app', 'Curator'),
            self::ROLE_HEADMAN => Module::t('app', 'Headman'),
            self::ROLE_STUDENT => Module::t('app', 'Student'),
        ];
    }

    /**
     * Возврщает мап статусов
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE_ID => self::STATUS_ACTIVE,
            self::STATUS_TAG_TO_BAN_ID => self::STATUS_TAG_TO_BAN,
            self::STATUS_BAN_ID => self::STATUS_BAN,
        ];
    }

    public static function find(): UserQuery
    {
        return new UserQuery(get_called_class());
    }

    /**
     * Метод находит пользователя по логину.
     * @param string $username
     * @return User
     */
    public static function findByUsername(string $username): User
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * @return mixed
     */
    public static function currentUser()
    {
        return Yii::$app->user->identity;
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
