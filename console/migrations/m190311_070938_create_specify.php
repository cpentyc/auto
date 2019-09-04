<?php

use yii\db\Migration;

/**
 * Class m190311_070938_create_specify
 */
class m190311_070938_create_specify extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `dealers_specify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190311_070938_create_specify cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_070938_create_specify cannot be reverted.\n";

        return false;
    }
    */
}
