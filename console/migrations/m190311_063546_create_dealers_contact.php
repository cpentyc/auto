<?php

use yii\db\Migration;

/**
 * Class m190311_063546_create_dealers_contact
 */
class m190311_063546_create_dealers_contact extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `dealers_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `email` varchar(512) NOT NULL,
  `dealers_id` int(11) NOT NULL,
  `lang` varchar(8) NOT NULL DEFAULT 'ru',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190311_063546_create_dealers_contact cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_063546_create_dealers_contact cannot be reverted.\n";

        return false;
    }
    */
}
