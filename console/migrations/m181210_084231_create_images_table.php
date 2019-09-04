<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `images`.
 */
class m181210_084231_create_images_table extends Migration
{

    public $tableName = '{{%gallery_image}}';

    public function up()
    {

        $this->createTable(
            $this->tableName,
            array(
                'id' => Schema::TYPE_PK,
                'type' => Schema::TYPE_STRING,
                'ownerId' => Schema::TYPE_STRING . ' NOT NULL',
                'rank' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'name' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT,
                'created_at' => $this->timestamp()->defaultValue(New Expression("NOW()"))
            )
        );
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
