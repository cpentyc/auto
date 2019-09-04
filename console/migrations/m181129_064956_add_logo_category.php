<?php

use yii\db\Migration;

/**
 * Class m181129_064956_add_logo_category
 */
class m181129_064956_add_logo_category extends Migration
{
    const TBL = "category";
    const COL = "logo";

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
        echo "m181129_064956_add_logo_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181129_064956_add_logo_category cannot be reverted.\n";

        return false;
    }
    */
}
