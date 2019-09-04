<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `lang`.
 */
class m181114_141239_create_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        // Language table
        $this->createTable('languages', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'code' => Schema::TYPE_STRING . ' NOT NULL',
            'is_active' => Schema::TYPE_SMALLINT . ' DEFAULT 1'
        ], $tableOptions);

        // default language
        $this->insert('languages', ['title' => 'Русский', 'code' => 'ru', 'is_active' => 1]);
        $this->insert('languages', ['title' => 'Казахский', 'code' => 'kz', 'is_active' => 1]);
        $this->insert('languages', ['title' => 'Английский', 'code' => 'en', 'is_active' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lang');
    }
}
