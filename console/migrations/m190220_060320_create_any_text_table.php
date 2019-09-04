<?php

use yii\db\Migration;

/**
 * Handles the creation of table `any_text`.
 */
class m190220_060320_create_any_text_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('any_text', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string(256)->notNull()->comment('Имя'),
            'content_ru' => $this->text()->notNull()->comment('Текст ру'),
            'content_en' => $this->text()->notNull()->comment('Текст ен'),
            'content_kz' => $this->text()->notNull()->comment('Текст кз'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('any_text');
    }
}
