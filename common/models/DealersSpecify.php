<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dealers_specify".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_ru
 * @property string $name_en
 * @property string $name_kz
 */
class DealersSpecify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealers_specify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name_ru', 'name_kz', 'name_en'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getName()
    {
        return $this->{'name_' . \Yii::$app->language};
    }
}
