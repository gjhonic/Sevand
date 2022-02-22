<?php

use app\modules\core\models\base\User;
use yii\db\Migration;

/**
 * Class m220222_090148_rbac_data
 */
class m220222_090148_rbac_data extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $studentRole = $auth->createRole(User::ROLE_STUDENT);
        $auth->add($studentRole);

        $headmanRole = $auth->createRole(User::ROLE_HEADMAN);
        $auth->add($headmanRole);
        $auth->addChild($headmanRole, $studentRole);

        $curatorRole = $auth->createRole(User::ROLE_CURATOR);
        $auth->add($curatorRole);
        $auth->addChild($curatorRole, $headmanRole);

        $moderatorRole = $auth->createRole(User::ROLE_MODERATOR);
        $auth->add($moderatorRole);
        $auth->addChild($moderatorRole, $curatorRole);

        $adminRole = $auth->createRole(User::ROLE_ADMIN);
        $auth->add($adminRole);
        $auth->addChild($adminRole, $moderatorRole);

        $rootRole = $auth->createRole(User::ROLE_ROOT);
        $auth->add($rootRole);
        $auth->addChild($rootRole, $adminRole);

        //Добавляю рута
        $user = new User();
        $user->name = "Админ";
        $user->surname = "Админов";
        $user->username = "root";
        $user->password = Yii::$app->getSecurity()->generatePasswordHash('123456');
        $user->role = User::ROLE_ROOT;
        $user->status_id = User::STATUS_ACTIVE_ID;
        $user->department_id = 1;
        $user->save();

        $auth->assign($rootRole, $user->id);
    }

}
