<?php

use yii\db\Migration;

/**
 * Class m181218_122739_add_preview_news
 */
class m181218_122739_add_preview_news extends Migration
{
    const TBL = "news";
    const COL = "preview";
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
        echo "m181218_122739_add_preview_news cannot be reverted.\n";

        return false;
    }
    */
}
