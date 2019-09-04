<?php

use yii\db\Migration;

/**
 * Class m190103_061643_add_specifications_product
 */
class m190103_061643_add_specifications_product extends Migration
{
    const TBL = "product";
    const COL = "specifications";
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
        echo "m190103_061643_add_specifications_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190103_061643_add_specifications_product cannot be reverted.\n";

        return false;
    }
    */
}
