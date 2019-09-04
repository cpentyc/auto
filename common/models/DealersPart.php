<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dealers_part".
 *
 * @property int $id
 * @property string $name Имя
 * @property string $name_ru Имя  ru
 * @property string $name_kz Имя  kz
 * @property string $name_en Имя  en
 * @property string $address Адрес
 * @property string $address_ru Адрес ru
 * @property string $address_kz Адрес kz
 * @property string $address_en Адрес en
 * @property string $phone phone
 * @property string $fax fax
 * @property int $id_city город
 * @property int $internal порядок
 *
 * @property DealersCity $city
 */
class DealersPart extends \yii\db\ActiveRecord
{

    public $dealers_specify = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dealers_part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_kz', 'name_en', 'address_ru', 'address_kz', 'address_en', 'phone', 'fax', 'id_city'], 'required'],
            [['id_city', 'internal'], 'integer'],
            [['dealers_specify'], 'safe'],
            [['name_ru', 'name_kz', 'name_en', 'address_ru', 'address_kz', 'address_en', 'phone', 'fax'], 'string', 'max' => 255],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => DealersCity::className(), 'targetAttribute' => ['id_city' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ru' => Yii::t('app', 'Имя  ru'),
            'name_kz' => Yii::t('app', 'Имя  kz'),
            'name_en' => Yii::t('app', 'Имя  en'),
            'address_ru' => Yii::t('app', 'Адрес ru'),
            'address_kz' => Yii::t('app', 'Адрес kz'),
            'address_en' => Yii::t('app', 'Адрес en'),
            'phone' => Yii::t('app', 'phone'),
            'fax' => Yii::t('app', 'fax'),
            'id_city' => Yii::t('app', 'город'),
            'internal' => 'Порядок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(DealersCity::className(), ['id' => 'id_city']);
    }

    public function getName()
    {
        return $this->{'name_' . \Yii::$app->language};
    }

    public function getAddress()
    {
        return $this->{'address_' . \Yii::$app->language};
    }


    public function getSpecifies()
    {
        return $this->hasMany(DealersSpecify::className(), ['id' => 'dealersspecify_id'])
            ->viaTable('dealersparts_specifies', ['dealerspart_id' => 'id']);
    }


    public function getPhone()
    {
        return $this->{'phone_' . \Yii::$app->language};
    }
    public function getDealersContactsLang()
    {
        return $this->hasMany(DealersContact::className(), ['dealers_id' => 'id' ])
            ->where(['lang' => \Yii::$app->language])
            ->orderBy(['id' => SORT_DESC]);
    }
    public function getDealersContacts()
    {
        return $this->hasMany(DealersContact::className(), ['dealers_id' => 'id' ])
            ->orderBy(['id' => SORT_DESC]);
    }
}
