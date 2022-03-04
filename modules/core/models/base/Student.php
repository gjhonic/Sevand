<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "core_student".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property int $gender
 * @property int $group_id
 * @property int $status_id
 * @property int $department_id
 * @property int $user_id
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property string $genderTitle
 *
 * @property Department $department
 * @property Group $group
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{

    const GENDRE_MAN = 1;
    const GENDRE_WOMAN = 0;

    const STATUS_ACTIVE = 1;
    const STATUS_ARCHIVE = 2;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_student}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'surname', 'patronymic', 'group_id', 'status_id', 'department_id', 'user_id'], 'required'],
            [['gender', 'group_id', 'status_id', 'department_id', 'user_id'], 'default', 'value' => null],
            [['gender', 'group_id', 'status_id', 'department_id', 'user_id'], 'integer'],
            [['description'], 'string'],
            [[ 'created_at', 'updated_at'], 'safe'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 50],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('app', 'ID'),
            'name' => Module::t('app', 'Name'),
            'surname' => Module::t('app', 'Surname'),
            'patronymic' => Module::t('app', 'Patronymic'),
            'gender' => Module::t('app', 'Gender'),
            'group_id' => Module::t('app', 'Group'),
            'status_id' => Module::t('app', 'Status'),
            'department_id' => Module::t('app', 'Department'),
            'user_id' => Module::t('app', 'User'),
            'description' => Module::t('app', 'Description'),
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
        ];
    }

    /**
     * Массив пол
     * @return array
     */
    public static function getGendersMap(): array
    {
        return [
            self::GENDRE_MAN => Module::t('app', 'Male'),
            self::GENDRE_WOMAN => Module::t('app', 'Female'),
        ];
    }

    /**
     * Массив статусов
     * @return array
     */
    public static function getStatusesMap(): array
    {
        return [
            self::STATUS_ACTIVE => Module::t('app', 'Active'),
            self::STATUS_ARCHIVE => Module::t('app', 'Archive'),
        ];
    }


    /**
     * Возвращает строку пол
     * @return string
     */
    public function getGenderTitle(): string
    {
        return self::getGendersMap()[$this->gender];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
