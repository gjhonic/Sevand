<?php

use app\modules\core\models\base\University;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_university}}`.
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
            'description' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-university-id',
            '{{%core_university}}',
            'id'
        );

        //Добавляем университет по умолчанию
        $university = new University();
        $university->title = 'Бурятский Государственный Университет';
        $university->short_title = 'БГУ';
        $university->description = '';
        $university->save();
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
