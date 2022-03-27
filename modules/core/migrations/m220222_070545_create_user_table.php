<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_user}}`.
 */
class m220222_070545_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'surname' => $this->string(50)->notNull(),
            'username' => $this->string(255)->unique()->notNull(),
            'password' => $this->string(255)->notNull(),
            'role' => $this->string(15)->notNull(),
            'status_id' => $this->integer()->notNull(),
            'activity' => $this->integer(1)->defaultValue(1)->notNull(),
            'department_id' => $this->integer()->notNull(),
            'auth_key' => $this->string(32),
            'access_token' => $this->string(32),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-user-id',
            '{{%core_user}}',
            'id'
        );

        $this->addForeignKey(
            'fk-user-department_id',
            '{{%core_user}}',
            'department_id',
            '{{%core_department}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-user-id',
            '{{%core_user}}'
        );

        $this->dropForeignKey(
            'fk-user-department_id',
            '{{%core_user}}'
        );

        $this->dropTable('{{%core_user}}');
    }
}
