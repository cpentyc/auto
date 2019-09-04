<?php

use yii\db\Migration;

/**
 * Class m181225_064503_add_equipment_product
 */
class m181225_064503_add_equipment_product extends Migration
{
    const TBL = "product";
    const COL = "equipment";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->string(512));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_064503_add_equipment_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_064503_add_equipment_product cannot be reverted.\n";

        return false;
    }
    */
}
