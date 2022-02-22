<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_department}}`.
 */
class m220220_085953_create_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_department}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'short_title' => $this->string(10)->notNull(),
            'description' => $this->text()->null(),
            'university_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-department-id',
            '{{%core_department}}',
            'id'
        );

        $this->addForeignKey(
            'fk-department-university_id',
            '{{%core_department}}',
            'university_id',
            '{{%core_university}}',
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
            'fk-department-university_id',
            '{{%core_department}}'
        );

        $this->dropIndex(
            'idx-department-id',
            '{{%core_department}}'
        );

        $this->dropTable('{{%core_department}}');
    }
}
