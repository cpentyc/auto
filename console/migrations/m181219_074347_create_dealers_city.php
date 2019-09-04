<?php

use yii\db\Migration;

/**
 * Class m181219_074347_create_dealers_city
 */
class m181219_074347_create_dealers_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dealers_city', [
            'id' => $this->primaryKey(),
            'name_ru' => $this->string(255)->notNull()->comment('Имя города ru'),
            'name_kz' => $this->string(255)->notNull()->comment('Имя города kz'),
            'name_en' => $this->string(255)->notNull()->comment('Имя города en'),
            'lng' => $this->float()->notNull()->comment('lng'),
            'lat' => $this->float()->notNull()->comment('lat'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181219_074347_create_dealers_city cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181219_074347_create_dealers_city cannot be reverted.\n";

        return false;
    }
    */
}
