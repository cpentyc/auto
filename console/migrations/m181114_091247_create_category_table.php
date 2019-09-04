<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m181114_091247_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name_ru' => $this->string(256)->notNull(),
            'name_ru' => $this->string(256)->notNull(),
            'name_kz' => $this->string(256)->notNull(),
            'name_en' => $this->string(256)->notNull(),
            'created_at' => $this->integer()->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
