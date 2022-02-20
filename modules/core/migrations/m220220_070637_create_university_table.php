<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%university}}`.
 */
class m220220_070637_create_university_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_university}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'short_title' => $this->string(10)->notNull(),
            'description' => $this->string()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-university-id',
            '{{%core_university}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-university-id',
            '{{%core_university}}'
        );

        $this->dropTable('{{%core_university}}');
    }
}
