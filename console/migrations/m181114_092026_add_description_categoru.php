<?php

use yii\db\Migration;

/**
 * Class m181114_092026_add_description_categoru
 */
class m181114_092026_add_description_categoru extends Migration
{

    const TBL = "category";
    const COL = "category";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TBL, 'description_ru', $this->text());
        $this->addColumn(self::TBL, 'description_kz', $this->text());
        $this->addColumn(self::TBL, 'description_en', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181114_092026_add_description_categoru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181114_092026_add_description_categoru cannot be reverted.\n";

        return false;
    }
    */
}
