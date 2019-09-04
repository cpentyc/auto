<?php

use yii\db\Migration;

/**
 * Handles the creation of table `email`.
 */
class m190214_043240_create_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('email', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->comment('Почта'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('email');
    }
}
