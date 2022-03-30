<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_group}}`.
 */
class m220226_103811_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'course_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'direction_id' => $this->integer()->notNull(),
            'activity_id' => $this->integer(1)->defaultValue(1)->notNull(),
            'curator_id' => $this->integer()->null(),
            'headman_id' => $this->integer()->null(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-group-id',
            '{{%core_group}}',
            'id'
        );

        //Внешние ключи

        $this->addForeignKey(
            'fk-group-course_id',
            '{{%core_group}}',
            'course_id',
            '{{%core_course}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-group-department_id',
            '{{%core_group}}',
            'department_id',
            '{{%core_department}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-group-direction_id',
            '{{%core_group}}',
            'direction_id',
            '{{%core_direction}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-group-curator_id',
            '{{%core_group}}',
            'curator_id',
            '{{%core_user}}',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-group-headman_id',
            '{{%core_group}}',
            'headman_id',
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
            'idx-group-id',
            '{{%core_group}}'
        );

        $this->dropForeignKey(
            'fk-group-course_id',
            '{{%core_group}}'
        );

        $this->dropForeignKey(
            'fk-group-department_id',
            '{{%core_group}}'
        );

        $this->dropForeignKey(
            'fk-group-direction_id',
            '{{%core_group}}'
        );

        $this->dropForeignKey(
            'fk-group-curator_id',
            '{{%core_group}}'
        );

        $this->dropForeignKey(
            'fk-group-headman_id',
            '{{%core_group}}'
        );

        $this->dropTable('{{%core_group}}');
    }
}
