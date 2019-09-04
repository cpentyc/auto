<?php

use yii\db\Migration;

/**
 * Class m181218_084703_add_pinned_news
 */
class m181218_084703_add_pinned_news extends Migration
{
    const TBL = "news";
    const COL = "pinned";
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
        echo "m181218_084703_add_pinned_news cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181218_084703_add_pinned_news cannot be reverted.\n";

        return false;
    }
    */
}
