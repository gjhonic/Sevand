<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_log}}`.
 */
class m220306_071223_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'status_id' => $this->integer(1)->notNull(),
            'description' => $this->text()->null(),
            'created_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-log-id',
            '{{%core_log}}',
            'id'
        );

        //Внешние ключи

        $this->addForeignKey(
            'fk-log-user_id',
            '{{%core_log}}',
            'user_id',
            '{{%core_user}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-log-department_id',
            '{{%core_log}}',
            'department_id',
            '{{%core_department}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-log-id',
            '{{%core_log}}'
        );

        $this->dropForeignKey(
            'fk-log-department_id',
            '{{%core_log}}'
        );

        $this->dropForeignKey(
            'fk-log-user_id',
            '{{%core_log}}'
        );

        $this->dropTable('{{%core_log}}');
    }
}
