<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_student_transfer_log}}`.
 */
class m220503_040206_create_student_transfer_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_student_transfer_log}}', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'group_from_id' => $this->integer()->null(),
            'group_to_id' => $this->integer()->notNull(),
            'message' => $this->text()->null(),
            'created_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-student_transfer_log-id',
            '{{%core_student_transfer_log}}',
            'id'
        );

        //Внешние ключи

        $this->addForeignKey(
            'fk-student_transfer_log-department_id',
            '{{%core_student_transfer_log}}',
            'department_id',
            '{{%core_department}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-student_transfer_log-user_id',
            '{{%core_student_transfer_log}}',
            'user_id',
            '{{%core_user}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-student_transfer_log-student_id',
            '{{%core_student_transfer_log}}',
            'student_id',
            '{{%core_student}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-student_transfer_log-group_from_id',
            '{{%core_student_transfer_log}}',
            'group_from_id',
            '{{%core_group}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-student_transfer_log-group_to_id',
            '{{%core_student_transfer_log}}',
            'group_to_id',
            '{{%core_group}}',
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
            '{{%core_student_transfer_log}}'
        );

        $this->dropForeignKey(
            'fk-student_transfer_log-department_id',
            '{{%core_student_transfer_log}}'
        );

        $this->dropForeignKey(
            'fk-student_transfer_log-user_id',
            '{{%core_student_transfer_log}}'
        );

        $this->dropForeignKey(
            'fk-student_transfer_log-student_id',
            '{{%core_student_transfer_log}}'
        );

        $this->dropForeignKey(
            'fk-student_transfer_log-group_from_id',
            '{{%core_student_transfer_log}}'
        );

        $this->dropForeignKey(
            'fk-student_transfer_log-group_to_id',
            '{{%core_student_transfer_log}}'
        );

        $this->dropTable('{{%core_student_transfer_log}}');
    }
}
