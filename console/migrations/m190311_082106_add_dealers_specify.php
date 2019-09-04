<?php

use yii\db\Migration;

/**
 * Class m190311_082106_add_dealers_specify
 */
class m190311_082106_add_dealers_specify extends Migration
{
    const TBL = "dealers_specify";
    const COL1 = "name_ru";
    const COL2 = "name_kz";
    const COL3 = "name_en";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, self::COL1, $this->string());
        $this->addColumn(self::TBL, self::COL2, $this->string());
        $this->addColumn(self::TBL, self::COL3, $this->string());
        $this->dropColumn(self::TBL, 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190311_082106_add_dealers_specify cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_082106_add_dealers_specify cannot be reverted.\n";

        return false;
    }
    */
}
