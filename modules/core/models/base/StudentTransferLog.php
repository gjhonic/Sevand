<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "core_student_transfer_log".
 *
 * @property int $id
 * @property int $department_id
 * @property int $user_id
 * @property int $student_id
 * @property int|null $group_from_id
 * @property int $group_to_id
 * @property string|null $message
 * @property int|null $created_at
 *
 * @property Department $department
 * @property Group $groupFrom
 * @property Group $groupTo
 * @property Student $student
 * @property User $user
 */
class StudentTransferLog extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_student_transfer_log}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['department_id', 'user_id', 'student_id', 'group_to_id'], 'required'],
            [['department_id', 'user_id', 'student_id', 'group_from_id', 'group_to_id'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['group_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_from_id' => 'id']],
            [['group_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_to_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('app', 'ID'),
            'department_id' => Module::t('app', 'Department'),
            'user_id' => Module::t('app', 'User'),
            'student_id' => Module::t('app', 'Student'),
            'group_from_id' => Module::t('app', 'Group From'),
            'group_to_id' => Module::t('app', 'Group To'),
            'message' => Module::t('app', 'Message'),
            'created_at' => Module::t('app', 'Created at'),
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
            ],
        ];
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
     * Gets query for [[GroupFrom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupFrom()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_from_id']);
    }

    /**
     * Gets query for [[GroupTo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupTo()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_to_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
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
