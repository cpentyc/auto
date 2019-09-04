<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `slider`.
 */
class m181210_090844_create_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('slider', [
            'id' => $this->primaryKey(),
            'isActive' => Schema::TYPE_STRING . ' NOT NULL DEFAULT 0',
            'rank' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'image' => $this->string()->notNull()->comment('Изображение'),
            'name' => $this->string()->notNull()->comment('Текст кнопки'),
            'description' => $this->text()->notNull()->comment('Контент слайдера'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull()->comment('Создатель'),
            'id_languages' => $this->integer()->notNull()->comment('Язык'),
        ]);

        $this->addForeignKey(
            'fk_slider_user',
            'slider',
            'id_user',
            'user',
            'id',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_slider_languages',
            'slider',
            'id_languages',
            'languages',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('slider');
    }
}
