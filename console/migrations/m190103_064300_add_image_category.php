<?php

use yii\db\Migration;

/**
 * Class m190103_064300_add_image_category
 */
class m190103_064300_add_image_category extends Migration
{
    const TBL = "category";
    const COL = "image";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190103_064300_add_image_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190103_064300_add_image_category cannot be reverted.\n";

        return false;
    }
    */
}
