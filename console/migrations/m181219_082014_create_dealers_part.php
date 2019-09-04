<?php

use yii\db\Migration;

/**
 * Class m181219_082014_create_dealers_part
 */
class m181219_082014_create_dealers_part extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dealers_part', [
            'id' => $this->primaryKey(),
            'name_ru' => $this->string(255)->notNull()->comment('Имя  ru'),
            'name_kz' => $this->string(255)->notNull()->comment('Имя  kz'),
            'name_en' => $this->string(255)->notNull()->comment('Имя  en'),
            'address_ru' => $this->string(255)->notNull()->comment('Адрес ru'),
            'address_kz' => $this->string(255)->notNull()->comment('Адрес kz'),
            'address_en' => $this->string(255)->notNull()->comment('Адрес en'),
            'phone' => $this->string(255)->notNull()->comment('phone'),
            'fax' => $this->string(255)->notNull()->comment('fax'),
            'id_city' => $this->integer()->notNull()->comment('город')
        ]);
        $this->addForeignKey(
            'fk_dealers_city',
            'dealers_part',
            'id_city',
            'dealers_city',
            'id',
            'RESTRICT'
        );
        $this->addColumn('dealers_city', 'sort_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181219_082014_create_dealers_part cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181219_082014_create_dealers_part cannot be reverted.\n";

        return false;
    }
    */
}
