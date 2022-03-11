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

        $systemRole = $auth->createRole(User::ROLE_SYSTEM);
        $auth->add($systemRole);
        $auth->addChild($systemRole, $rootRole);

        //Добавляем бота
        $userSystem = new User();
        $userSystem->name = "System";
        $userSystem->surname = "System";
        $userSystem->username = "system";
        $userSystem->password = Yii::$app->getSecurity()->generatePasswordHash('*3af4s342#@dfsSdFf4');
        $userSystem->role = User::ROLE_SYSTEM;
        $userSystem->status_id = User::STATUS_ACTIVE_ID;
        $userSystem->department_id = 1;
        $userSystem->save();

        $auth->assign($systemRole, $userSystem->id);

        //Добавляю рута
        $userRoot = new User();
        $userRoot->name = "Админ";
        $userRoot->surname = "Админов";
        $userRoot->username = "root";
        $userRoot->password = Yii::$app->getSecurity()->generatePasswordHash('123456');
        $userRoot->role = User::ROLE_ROOT;
        $userRoot->status_id = User::STATUS_ACTIVE_ID;
        $userRoot->department_id = 1;
        $userRoot->save();

        $auth->assign($rootRole, $userRoot->id);
    }

}
