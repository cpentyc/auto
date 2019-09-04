<?php

use yii\db\Migration;

/**
 * Class m181221_114803_add_parents_to
 */
class m181221_114803_add_parents_to extends Migration
{
    const TBL = "category";
    const COL = "id_parent";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL, $this->integer()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181221_114803_add_parents_to cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181221_114803_add_parents_to cannot be reverted.\n";

        return false;
    }
    */
}
