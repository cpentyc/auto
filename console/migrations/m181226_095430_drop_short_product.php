<?php

use yii\db\Migration;

/**
 * Class m181226_095430_drop_short_product
 */
class m181226_095430_drop_short_product extends Migration
{
    const TBL = "product";
    const COL = "short_content";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(self::TBL, self::COL);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181226_095430_drop_short_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181226_095430_drop_short_product cannot be reverted.\n";

        return false;
    }
    */
}
