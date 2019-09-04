<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $isActive
 * @property int $rank
 * @property string $image Изображение
 * @property string $name Текст кнопки
 * @property string $description Контент слайдера
 * @property int $created_at
 * @property int $updated_at
 * @property int $id_user Создатель
 * @property int $id_languages Язык
 *
 * @property Languages $languages
 * @property User $user
 */
class Slider extends ActiveRecord
{

    const ACTIVE_SLIDER = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
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
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'id_user',
                'updatedByAttribute' => false,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['id_user'] // If usr_id is required
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank', 'created_at', 'updated_at', 'id_user', 'id_languages'], 'integer'],
            [[ 'name', 'description',  'id_languages'], 'required'],
            [['description'], 'string'],
            [['isActive',  'image', 'name'], 'string', 'max' => 255],
            [['id_languages'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['id_languages' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'isActive' => Yii::t('app', 'Показывать на сайте'),
            'rank' => Yii::t('app', 'Порядок'),
            'image' => Yii::t('app', 'Изображение'),
            'name' => Yii::t('app', 'Текст кнопки'),
            'description' => Yii::t('app', 'Контент слайдера'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'id_user' => Yii::t('app', 'Создатель'),
            'id_languages' => Yii::t('app', 'Язык'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasOne(Languages::className(), ['id' => 'id_languages']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public static  function getSliders(){
        return Slider::find()
            ->joinWith('languages')
            ->where(['isActive' => self::ACTIVE_SLIDER, 'languages.code' => Yii::$app->language ])
            ->orderBy('rank')
            ->all();


    }

    public function displayImage($attribute)
    {
        if (!empty($this->$attribute)) {
            $image = Html::img(\Yii::getAlias('http://cbc-auto.kz/images/slider/') . $this->$attribute, [
                'alt' => Yii::t('app', 'image for '),
                'title' => Yii::t('app', 'Click remove button below to remove this image'),
                'class' => 'file-preview-image'
                // add a CSS class to make your image styling consistent
            ]);
        } else {
            $image = null;
        }

        // enclose in a container if you wish with appropriate styles
        return ($image == null) ? null :
            Html::tag('div', $image, ['class' => 'file-preview-frame']);
    }
}
