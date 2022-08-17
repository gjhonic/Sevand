<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%config_department}}`.
 */
class m220815_130728_create_config_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%config_department}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config_department}}');
    }
}
