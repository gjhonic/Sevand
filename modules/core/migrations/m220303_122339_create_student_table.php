<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_student}}`.
 */
class m220303_122339_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_student}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'surname' => $this->string(50)->notNull(),
            'patronymic' => $this->string(50)->notNull(),
            'gender' => $this->integer(1)->defaultValue(0)->notNull(),
            'group_id' => $this->integer()->notNull(),
            'status_id' => $this->integer(1)->notNull(),
            'department_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'description' => $this->text()->null(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-student-id',
            '{{%core_student}}',
            'id'
        );

        //Внешние ключи

        $this->addForeignKey(
            'fk-student-group_id',
            '{{%core_student}}',
            'group_id',
            '{{%core_group}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-student-department_id',
            '{{%core_student}}',
            'department_id',
            '{{%core_department}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-student-user_id',
            '{{%core_student}}',
            'user_id',
            '{{%core_user}}',
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
            'idx-student-id',
            '{{%core_student}}'
        );

        $this->dropForeignKey(
            'fk-student-group_id',
            '{{%core_student}}'
        );

        $this->dropForeignKey(
            'fk-student-department_id',
            '{{%core_student}}'
        );

        $this->dropForeignKey(
            'fk-student-user_id',
            '{{%core_student}}'
        );

        $this->dropTable('{{%core_student}}');
    }
}
