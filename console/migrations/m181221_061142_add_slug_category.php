<?php

use yii\db\Migration;

/**
 * Class m181221_061142_add_slug_category
 */
class m181221_061142_add_slug_category extends Migration
{
    const TBL = "category";
    const COL = "slug";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181221_061142_add_slug_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181221_061142_add_slug_category cannot be reverted.\n";

        return false;
    }
    */
}
