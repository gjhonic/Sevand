<?php

namespace app\modules\core\models\base;

use app\modules\core\models\error\UserError;
use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "core_student".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property int $gender
 * @property int $group_id
 * @property int $activity_id
 * @property int $department_id
 * @property int $user_id
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property string $genderTitle
 * @property string $message
 *
 * @property Department $department
 * @property Group $group
 * @property User $user
 * @property string $fullname
 * @property string $activity
 */
class Student extends \yii\db\ActiveRecord
{

    const GENDRE_MAN = 1;
    const GENDRE_WOMAN = 0;

    //Активность студента
    const ACTIVITY_ENABLE_ID = 1;
    const ACTIVITY_ENABLE = 'Active';

    const ACTIVITY_DISABLE_ID = 2;
    const ACTIVITY_DISABLE = 'Not active';

    public $message;

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
            [['name', 'surname', 'department_id', 'user_id'], 'required'],
            [['group_id'], 'default', 'value' => null],
            [['gender', 'group_id','department_id', 'user_id', 'activity_id'], 'integer'],
            [['description'], 'string'],
            ['activity_id', 'default', 'value' => 1],
            [['created_at', 'updated_at', 'message'], 'safe'],
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
            'genderTitle' => Module::t('app', 'Gender'),
            'group_id' => Module::t('app', 'Group'),
            'activity_id' => Module::t('app', 'Activity'),
            'department_id' => Module::t('app', 'Department'),
            'user_id' => Module::t('app', 'User'),
            'description' => Module::t('app', 'Description'),
            'message' => Module::t('app', 'Message'),
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
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
     * Возвращает статус пользователя
     * @return string
     */
    public function getActivity(): string
    {
        return self::getAtivities()[$this->activity_id];
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
     * Возвращает полное имя студента
     * @return string
     */
    public function getFullname(): string
    {
        return $this->surname . ' ' . $this->name;
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

    /**
     * Метод активирует студента
     * @return bool
     */
    public function enable(): bool
    {
        $this->activity_id = self::ACTIVITY_ENABLE_ID;
        return $this->save(false);
    }

    /**
     * Метод деактивирует студента
     * @return bool
     */
    public function disable(): bool
    {
        $this->activity_id = self::ACTIVITY_DISABLE_ID;
        return $this->save(false);
    }

    /**
     * Возвращает студента по пользователю
     * @param int $user_id
     * @return Student|array|\yii\db\ActiveRecord|null
     */
    public static function getStudentByUser(int $user_id)
    {
        return static::find()->where(['user_id' => $user_id])->one();
    }


    /**
     * Метод переводит студента и сохраняет в журнал переводов
     * @param bool $validate
     * @return bool
     * @throws NotFoundHttpException
     */
    public function transferStudent($validate = false): bool
    {
        if($validate){
            if(!$this->validate()){
                return false;
            }
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {

            if($this->update(false)){
                $studentTransferLog = new StudentTransferLog();
                $studentTransferLog->department_id = $this->department_id;
                $studentTransferLog->user_id = Yii::$app->user->identity->id;
                $studentTransferLog->student_id = $this->id;
                $studentTransferLog->group_from_id = $this->group_id;
                $studentTransferLog->group_to_id = $this->group_id;
                $studentTransferLog->message = $this->message;

                if($studentTransferLog->save()){
                    $transaction->commit();
                    return true;
                } else {
                    $transaction->rollBack();
                    return false;
                }

            }else{
                $transaction->rollBack();
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }

        return false;
    }
}
