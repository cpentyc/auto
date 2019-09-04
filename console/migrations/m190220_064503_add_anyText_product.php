<?php

use yii\db\Migration;

/**
 * Class m190220_064503_add_anyText_product
 */
class m190220_064503_add_anyText_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'model', $this->string(256)->notNull()->comment('Модель'));//timestamp new_data_type

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190220_064503_add_anyText_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190220_064503_add_anyText_product cannot be reverted.\n";

        return false;
    }
    */
}
