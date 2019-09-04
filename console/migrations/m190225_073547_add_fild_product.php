<?php

use yii\db\Migration;

/**
 * Class m190225_073547_add_fild_product
 */
class m190225_073547_add_fild_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'guaranty', $this->string(32)->notNull()->comment('Гарантия'));//timestamp new_data_type
        $this->addColumn('product', 'сondition', $this->string(256)->notNull()->comment('Условия'));//timestamp new_data_type

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190225_073547_add_fild_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190225_073547_add_fild_product cannot be reverted.\n";

        return false;
    }
    */
}
