<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%modules}}`.
 */
class m220815_130409_create_modules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_modules}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->integer()->notNull(),
            'class_name' => $this->text()->notNull(),
            'status_id' => $this->integer(1)->notNull(),
            'created_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-modules-id',
            '{{%core_modules}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%core_modules}}');
    }
}
