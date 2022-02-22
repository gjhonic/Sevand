<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_direction}}`.
 */
class m220220_132850_create_direction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_direction}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'short_title' => $this->string(10)->notNull(),
            'description' => $this->text()->null(),
            'department_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-direction-id',
            '{{%core_direction}}',
            'id'
        );

        $this->addForeignKey(
            'fk-direction-department_id',
            '{{%core_direction}}',
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
        $this->dropForeignKey(
            'fk-direction-department_id',
            '{{%core_direction}}'
        );

        $this->dropIndex(
            'idx-direction-id',
            '{{%core_direction}}'
        );

        $this->dropTable('{{%core_direction}}');
    }
}
