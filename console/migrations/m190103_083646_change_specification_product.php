<?php

use yii\db\Migration;

/**
 * Class m190103_083646_change_specification_product
 */
class m190103_083646_change_specification_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product', 'specifications', $this->text()->notNull()->comment('Технические характеристики'));//timestamp new_data_type
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190103_083646_change_specification_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190103_083646_change_specification_product cannot be reverted.\n";

        return false;
    }
    */
}
