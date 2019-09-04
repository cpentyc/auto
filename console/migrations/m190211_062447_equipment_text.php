<?php

use yii\db\Migration;

/**
 * Class m190211_062447_equipment_text
 */
class m190211_062447_equipment_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product', 'equipment', $this->text()->notNull()->comment('Комплектация'));//timestamp new_data_type
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190211_062447_equipment_text cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190211_062447_equipment_text cannot be reverted.\n";

        return false;
    }
    */
}
