<?php

use yii\db\Migration;

/**
 * Class m190311_071428_create_dealersparts_specifies
 */
class m190311_071428_create_dealersparts_specifies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `dealersparts_specifies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealerspart_id` int(11) NOT NULL,
  `dealersspecify_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=480 ;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190311_071428_create_dealersparts_specifies cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_071428_create_dealersparts_specifies cannot be reverted.\n";

        return false;
    }
    */
}
