<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course}}`.
 */
class m220221_061034_create_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_course}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-course-id',
            '{{%core_course}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-course-id',
            '{{%core_course}}'
        );

        $this->dropTable('{{%core_course}}');
    }
}
