<?php

use yii\db\Migration;

/**
 * Class m190201_070419_add_used_product
 */
class m190201_070419_add_used_product extends Migration
{
    const TBL = "product";
    const COL = "used";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190201_070419_add_used_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190201_070419_add_used_product cannot be reverted.\n";

        return false;
    }
    */
}
