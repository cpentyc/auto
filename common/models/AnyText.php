<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "any_text".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $name Имя
 * @property string $content Текст
 * @property string $content_ru Текст ру
 * @property string $content_en Текст ен
 * @property string $content_kz Текст кз
 */
class AnyText extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'any_text';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'content_ru', 'content_en', 'content_kz'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['content_ru', 'content_en', 'content_kz'], 'string'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Имя'),
            'content_ru' => Yii::t('app', 'Текст ру'),
            'content_en' => Yii::t('app', 'Текст ен'),
            'content_kz' => Yii::t('app', 'Текст кз'),
        ];
    }

    public function getContent()
    {
        return $this->{'content_' . \Yii::$app->language};
    }
}
