<?php

namespace app\modules\core\models\base;

use app\modules\core\models\error\UserError;
use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $username
 * @property string $patronymic
 * @property string $password
 * @property string $role
 * @property int $status_id
 * @property int $activity_id
 * @property int $department_id
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string $created_at
 * @property string $updated_at
 *
 * @property string $activity
 */
class User extends \yii\db\ActiveRecord
{
    //Роли пользователей
    const ROLE_SYSTEM = "system"; //Системный бот приложения
    const USER_SYSTEM_ID = 1;

    const ROLE_ROOT = "root";
    const ROLE_ADMIN = "admin";
    const ROLE_MODERATOR = "moderator";
    const ROLE_CURATOR = "curator";
    const ROLE_HEADMAN = "headman";
    const ROLE_STUDENT = "student";

    const ROLE_GUEST = "?";
    const ROLE_AUTHORIZED = "@";

    //Группы ролей
    const GROUP_ROLE_ADMIN = 'admin';
    const GROUP_ROLE_USER = 'user';

    //Статусы пользователей
    const STATUS_ACTIVE = "Active";
    const STATUS_ACTIVE_ID = 1;

    const STATUS_TAG_TO_BAN = "Tag to ban";
    const STATUS_TAG_TO_BAN_ID = 2;

    const STATUS_BAN = "Ban";
    const STATUS_BAN_ID = 3;

    //Активность пользователей
    const ACTIVITY_ENABLE_ID = 1;
    const ACTIVITY_ENABLE = 'Active';

    const ACTIVITY_DISABLE_ID = 2;
    const ACTIVITY_DISABLE = 'Not active';


    //Атрибуты
    public $patronymic;

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
            [['name', 'surname', 'username', 'password', 'role'], 'required'],
            [['status_id', 'department_id', 'activity_id'], 'integer'],
            ['activity_id', 'default', 'value' => 1],
            [['created_at', 'updated_at', 'patronymic'], 'safe'],
            [['name', 'surname'], 'string', 'max' => 50],
            [['username', 'password'], 'string', 'max' => 255],
            [['auth_key', 'access_token'], 'string', 'max' => 32],
            [['role'], 'string', 'max' => 15],
            [['username'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * Метод добавляет пользователя
     * @return int
     * @throws \Exception
     */
    public function createUser(bool $validate = true): int
    {
        if($validate){
            if(!$this->validate()){
                return UserError::ERROR_VALIDATE;
            }
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->status_id = self::STATUS_ACTIVE_ID;
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            if($this->save(false)){
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($this->role), $this->id);
                $transaction->commit();
                return UserError::SUCCESS_CREATE_USER;
            }else{
                $transaction->rollBack();
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new NotFoundHttpException(UserError::getDescriptionError(UserError::ERROR_CREATE_USER));
        }
    }

    /**
     * Метод добавляет пользователя + добавляет студента
     * @return int
     * @throws \Exception
     */
    public function createStudent(bool $validate = true): int
    {
        $this->setStudentRole();
        if($validate){
            if(!$this->validate()){
                return UserError::ERROR_VALIDATE;
            }
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->status_id = self::STATUS_ACTIVE_ID;
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            if($this->save(false)){
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($this->role), $this->id);
                $transaction->commit();

                $student = new Student();
                $student->name = $this->name;
                $student->surname = $this->surname;
                $student->patronymic = $this->patronymic;
                $student->user_id = $this->id;
                $student->status_id = Student::STATUS_ACTIVE;
                $student->gender = Student::GENDRE_MAN;
                $student->department_id = $this->department_id;

                if($student->save()){
                    return UserError::SUCCESS_CREATE_USER;
                } else {
                    $transaction->rollBack();
                }

            }else{
                $transaction->rollBack();
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new NotFoundHttpException(UserError::getDescriptionError(UserError::ERROR_CREATE_USER));
        }
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
            'patronymic' => Module::t('app', 'Patronymic'),
            'password' => Module::t('app', 'Password'),
            'role' => Module::t('app', 'Role'),
            'status_id' => Module::t('app', 'Status'),
            'activity_id' => Module::t('app', 'Activity'),
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
     * Возвращает полное имя пользователя
     * @return string
     */
    public function getFullname(): string
    {
        return $this->surname . ' ' . $this->name;
    }

    /**
     * Возврщает мап ролей
     * @return array
     */
    public static function getAllRoles(): array
    {
        return array_merge([
            self::ROLE_ROOT => Module::t('app', 'Root'),
        ],
        self::getRoles());
    }

    /**
     * Возврщает мап ролей для добавления новых пользователей админом
     * @return array
     */
    public static function getRolesForAdmin(): array
    {
        return [
            self::ROLE_MODERATOR => Module::t('app', 'Moderator'),
            self::ROLE_CURATOR => Module::t('app', 'Curator'),
        ];
    }

    /**
     * Возврщает мап статусов
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE_ID => Module::t('app', self::STATUS_ACTIVE),
            self::STATUS_TAG_TO_BAN_ID => Module::t('app', self::STATUS_TAG_TO_BAN),
            self::STATUS_BAN_ID => Module::t('app', self::STATUS_BAN),
        ];
    }

    /**
     * Возврщает мап активности
     * @return array
     */
    public static function getAtivities(): array
    {
        return [
            self::ACTIVITY_ENABLE_ID => Module::t('app', self::ACTIVITY_ENABLE),
            self::ACTIVITY_DISABLE_ID => Module::t('app', self::ACTIVITY_DISABLE),
        ];
    }

    /**
     * @return array
     */
    public static function getGroupsRole(): array
    {
        return [
            self::GROUP_ROLE_ADMIN,
            self::GROUP_ROLE_USER,
        ];
    }

    /**
     * Мапинг груп ролей на роли
     * @return array
     */
    public static function mapGroupRoles(): array
    {
        return [
            self::ROLE_ROOT => self::GROUP_ROLE_ADMIN,
            self::ROLE_ADMIN => self::GROUP_ROLE_ADMIN,
            self::ROLE_MODERATOR => self::GROUP_ROLE_ADMIN,
            self::ROLE_CURATOR => self::GROUP_ROLE_USER,
            self::ROLE_HEADMAN => self::GROUP_ROLE_USER,
            self::ROLE_STUDENT => self::GROUP_ROLE_USER,
        ];
    }

    /**
     * Метод находит пользователя по логину.
     * @param string $username
     * @return User
     */
    public static function getByUsername(string $username): User
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

    /**
     * Возвращает группу роли пользователя
     * @return string
     */
    public function getGroupRole(): string
    {
        return self::mapGroupRoles()[$this->role];
    }

    /**
     * Возвращает title роли
     * @return string
     */
    public function getRoleTitle(): ?string
    {
        return self::getAllRoles()[$this->role];
    }

    /**
     * Возвращает статус пользователя
     * @return string
     */
    public function getStatus(): string
    {
        return self::getStatuses()[$this->status_id];
    }

    /**
     * Возвращает статус пользователя
     * @return string
     */
    public function getActivity(): string
    {
        return self::getAtivities()[$this->activity_id];
    }

    /**
     * Метод активирует пользователя
     * @return bool
     */
    public function enable(): bool
    {
        $this->activity_id = self::ACTIVITY_ENABLE_ID;
        return $this->save(false);
    }

    /**
     * Метод деактивирует пользователя
     * @return bool
     */
    public function disable(): bool
    {
        $this->activity_id = self::ACTIVITY_DISABLE_ID;
        return $this->save(false);
    }


    /**
     * Устанавливает роль студент
     */
    public function setStudentRole()
    {
        $this->role = self::ROLE_STUDENT;
    }
}
