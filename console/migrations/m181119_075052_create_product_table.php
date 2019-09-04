<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m181119_075052_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull()->comment('ЧПУ'),
            'meta_title' => $this->string()->comment('seo title'),
            'meta_description' => $this->string()->comment('seo description'),
            'meta_keywords' => $this->string()->comment('seo keywords'),
            'image' => $this->string()->notNull()->comment('Изображение'),
            'content' => $this->text()->notNull()->comment('Текст'),
            'short_content' => $this->text()->notNull()->comment('Краткое описание'),
            'h1' => $this->string()->comment('Заголовок'),
            'price' => $this->float()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull()->comment('Создатель'),
            'id_languages' => $this->integer()->notNull()->comment('Язык'),
            'id_category' => $this->integer()->notNull()->comment('Категория'),
        ]);
        $this->addForeignKey(
            'fk_product_user',
            'product',
            'id_user',
            'user',
            'id',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_product_category',
            'product',
            'id_category',
            'category',
            'id',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_product_languages',
            'product',
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
        $this->dropTable('product');
    }
}
