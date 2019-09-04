<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m181115_053202_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull()->comment('ЧПУ'),
            'meta_title' => $this->string()->comment('seo title'),
            'meta_description' => $this->string()->comment('seo description'),
            'meta_keywords' => $this->string()->comment('seo keywords'),
            'image' => $this->string()->notNull()->comment('Изображение'),
            'content' => $this->text()->notNull()->comment('Текст'),
            'h1' => $this->string()->comment('Заголовок'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull()->comment('Создатель'),
            'id_languages' => $this->integer()->notNull()->comment('Язык'),
        ]);
        $this->addForeignKey(
            'fk_news_user',
            'news',
            'id_user',
            'user',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk_news_languages',
            'news',
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
        $this->dropTable('news');
    }
}
