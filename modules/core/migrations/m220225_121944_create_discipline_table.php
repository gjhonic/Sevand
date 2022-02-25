<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline}}`.
 */
class m220225_121944_create_discipline_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%core_discipline}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'short_title' => $this->string(50)->notNull(),
            'department_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-discipline-id',
            '{{%core_discipline}}',
            'id'
        );

        $this->addForeignKey(
            'fk-discipline-department_id',
            '{{%core_discipline}}',
            'department_id',
            '{{%core_department}}',
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
            'idx-discipline-id',
            '{{%core_discipline}}'
        );

        $this->dropForeignKey(
            'fk-discipline-department_id',
            '{{%core_discipline}}'
        );

        $this->dropTable('{{%core_discipline}}');
    }
}
