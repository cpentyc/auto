<?php

use yii\db\Migration;

/**
 * Class m190311_065203_add_internal
 */
class m190311_065203_add_internal extends Migration
{
    const TBL = "dealers_part";
    const COL = "internal";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->integer());
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190311_065203_add_internal cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_065203_add_internal cannot be reverted.\n";

        return false;
    }
    */
}
