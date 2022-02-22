<?php
namespace app\modules\core\models\queries;

use app\modules\core\models\base\User;
use app\modules\core\services\user\StatusService;
use yii\db\ActiveQuery;

/**
 * Класс для scope методов
 */
class UserQuery extends ActiveQuery
{
    /**
     * Фильтрация по роли 'студент'
     */
    public function getUserByUserRole(): self
    {
        return $this->andWhere(['user.role_id' => User::ROLE_STUDENT]);
    }

    /**
     * Фильтрация по активным статусам
     */
    public function getActiveUser(): self
    {
        return $this->andWhere(['not in', 'user.status_id', StatusService::statusBanned()]);
    }
}