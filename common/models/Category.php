<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $name_ru
 * @property string $name_kz
 * @property string $name_en
 * @property string $logo
 * @property string $image
 * @property int $created_at
 * @property int $id_parent
 * @property string $description
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property Category $parent
 * @property Category[] $children
 * @property Product[] $products
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru', 'slug', 'name_kz', 'name_en'], 'required'],
            [['slug'], 'unique'],
            [['created_at'], 'safe'],
            [['description_ru', 'description_kz', 'description_en'], 'string'],
            [['name_ru', 'slug', 'name_kz', 'name_en', 'image'], 'string', 'max' => 256],
            [['logo'], 'string', 'max' => 512],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'created_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_kz' => Yii::t('app', 'Name Kz'),
            'name_en' => Yii::t('app', 'Name En'),
            'created_at' => Yii::t('app', 'Created At'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_kz' => Yii::t('app', 'Description Kz'),
            'description_en' => Yii::t('app', 'Description En'),
            'logo' => Yii::t('app', 'Логотип компании'),
            'slug' => Yii::t('app', 'url'),
            'id_parent' => Yii::t('app', 'Родительская категория'),
        ];
    }
    public function getDescription()
    {
        return $this->{'description_' . \Yii::$app->language};
    }

    public function getName()
    {
        return $this->{'name_' . \Yii::$app->language};
    }


    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_parent']);
    }

    public function getChildren()
    {
        return $this->hasMany(Category::className(), ['id_parent' => 'id']);
    }

    public static function getCategory(){
        return Category::find()->where(['AND', ['id_parent' => null ],['<>','id', 12 ],['<>','id', 13 ]])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Product::className(), ['id_category' => 'id']);
    }

    public function displayImage($attribute)
    {
        if (!empty($this->$attribute)) {
            $image = Html::img(\Yii::getAlias('http://cbc-auto.kz/images/category/') . $this->$attribute, [
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
