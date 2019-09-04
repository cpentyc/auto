<?php

use yii\db\Migration;

/**
 * Class m181224_081251_add_sales_leader_product
 */
class m181224_081251_add_sales_leader_product extends Migration
{
    const TBL = "product";
    const COL = "sales_leader";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->integer(2)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181224_081251_add_sales_leader_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181224_081251_add_sales_leader_product cannot be reverted.\n";

        return false;
    }
    */
}
