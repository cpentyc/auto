<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $slug ЧПУ
 * @property string $meta_title seo title
 * @property string $meta_description seo description
 * @property string $meta_keywords seo keywords
 * @property string $image Изображение
 * @property string $content Текст
 * @property string $specifications характеристики
 * @property string $h1 Заголовок
 * @property string $model model
 * @property string $guaranty guaranty
 * @property string $сondition сondition
 * @property string $equipment Комплектация
 * @property double $price
 * @property int $created_at
 * @property int $used
 * @property int $updated_at
 * @property int $sales_leader
 * @property int $id_user Создатель
 * @property int $id_languages Язык
 * @property int $id_category Категория
 *
 * @property Category $category
 * @property Languages $languages
 * @property User $user
 */
class Product extends ActiveRecord
{
    const LEADER_YES= 1;
    const LEADER_NO= 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }


    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'product',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@frontend') . '/web/images/product/gallery',
                'url' =>  '/images/product/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
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
            [['slug', 'image', 'content', 'specifications',  'price', 'id_user', 'id_languages', 'id_category'], 'required'],
            [['content', 'specifications' , 'equipment'], 'string'],
            [['price'], 'number'],
            [['created_at', 'updated_at', 'id_user', 'id_languages', 'id_category', 'sales_leader', 'used'], 'integer'],
            [['slug', 'сondition', 'guaranty', 'meta_title', 'model', 'meta_description', 'meta_keywords', 'image', 'h1'], 'string', 'max' => 255],

            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
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
            'slug' => Yii::t('app', 'ЧПУ'),
            'used' => Yii::t('app', 'Б/У'),
            'meta_title' => Yii::t('app', 'seo title'),
            'meta_description' => Yii::t('app', 'seo description'),
            'meta_keywords' => Yii::t('app', 'seo keywords'),
            'image' => Yii::t('app', 'Изображение'),
            'content' => Yii::t('app', 'Текст'),
            'specifications' => Yii::t('app', 'Технические характеристики'),
            'h1' => Yii::t('app', 'Заголовок'),
            'equipment' => Yii::t('app', 'Комплектация'),
            'price' => Yii::t('app', 'Price'),
            'model' => Yii::t('app', 'Модель'),
            'guaranty' => Yii::t('app', 'Гарантия'),
            'сondition' => Yii::t('app', 'Условия'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'id_user' => Yii::t('app', 'Создатель'),
            'id_languages' => Yii::t('app', 'Язык'),
            'id_category' => Yii::t('app', 'Категория'),
            'sales_leader' => Yii::t('app', 'Лидер продаж'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
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

    public static function getSalesLeader(){
        return Product::find()
            ->joinWith('languages')
            ->where([ 'sales_leader' => self::LEADER_YES])
            ->limit(6)->orderBy('id DESC' )->all();
    }
}
