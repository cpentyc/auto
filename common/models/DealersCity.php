<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "dealers_city".
 *
 * @property integer $id
 * @property string $name
 * @property double $lng
 * @property double $lat
 */
class DealersCity extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealers_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru', 'lng', 'lat'], 'required'],
            [['lng', 'lat'], 'number'],
            [['name_ru','name_kz','name_en'], 'string', 'max' => 255]
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
            'lng' => 'Lng',
            'lat' => 'Lat',
        ];
    }

    public function getParts()
    {
        return $this->hasMany(DealersPart::className(), ['id_city' => 'id'])->orderBy(['id' => SORT_DESC]);
    }

    public function getName()
    {
        return $this->{'name_' . \Yii::$app->language};
    }
}
