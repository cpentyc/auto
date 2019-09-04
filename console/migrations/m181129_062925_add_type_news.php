<?php

use yii\db\Migration;

/**
 * Class m181129_062925_add_type_news
 */
class m181129_062925_add_type_news extends Migration
{

    const TBL = "news";
    const COL = "type";

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
        echo "m181129_062925_add_type_news cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181129_062925_add_type_news cannot be reverted.\n";

        return false;
    }
    */
}
