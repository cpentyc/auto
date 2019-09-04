<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $slug ЧПУ
 * @property string $meta_title seo title
 * @property string $meta_description seo description
 * @property string $meta_keywords seo keywords
 * @property string $image Изображение
 * @property string $preview превью
 * @property string $content Текст
 * @property string $h1 Заголовок
 * @property int $pinned
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 * @property int $id_user Создатель
 * @property int $id_languages Язык
 *
 * @property Languages $languages
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    const TYPE_NEWS = 1;
    const TYPE_STOCK = 2;
    const TYPE_PAGE = 3;
    const PINNED_RECORD = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
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
            [['slug',  'content',  'id_languages'], 'required'],
            [['content'], 'string'],
            //[['slug'], 'unique'],
            [['created_at', 'updated_at', 'id_user', 'type', 'pinned', 'id_languages'], 'integer'],
            [['slug', 'meta_title', 'meta_description', 'meta_keywords', 'image', 'preview', 'h1'], 'string', 'max' => 255],
            [['id_languages'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['id_languages' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            ['slug', 'validatorUniqueLanguages'],
            ];
    }

    public function validatorUniqueLanguages ($attribute )
    {
        $model = News::find()->where(['AND', ['=', 'slug', $this->slug] , ['=', 'id_languages', $this->id_languages] ])->one();
        if ($model !== null) {
            if($model->id != $this->id)
                $this->addError($attribute, 'Для текащего языка уже есть страница с таким урл');
        }

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'ЧПУ'),
            'meta_title' => Yii::t('app', 'seo title'),
            'meta_description' => Yii::t('app', 'seo description'),
            'meta_keywords' => Yii::t('app', 'seo keywords'),
            'image' => Yii::t('app', 'Большой банер'),
            'preview' => Yii::t('app', 'Preview'),
            'content' => Yii::t('app', 'Текст'),
            'h1' => Yii::t('app', 'Заголовок'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'id_user' => Yii::t('app', 'Создатель'),
            'id_languages' => Yii::t('app', 'Язык'),
            'type' => Yii::t('app', 'Тип записи'),
            'pinned' => Yii::t('app', 'Закрепить'),
        ];
    }
    public function displayImage($attribute)
    {
        if (!empty($this->$attribute)) {
            $image = Html::img(\Yii::getAlias('http://cbc-auto.kz/images/news/') . $this->$attribute, [
                'alt' => Yii::t('app', 'image for ') . $this->meta_title,
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

    public static function getPinnedStock(){
        return News::find()
            ->joinWith('languages')
            ->where(['type' => self::TYPE_STOCK, 'pinned' => self::PINNED_RECORD, 'languages.code' => Yii::$app->language ])->one();
    }

    public static function getLastNews(){
        return News::find()
            ->joinWith('languages')
            ->where([ 'AND', ['=', 'languages.code' , Yii::$app->language], ['=', 'type' , self::TYPE_NEWS] ])
            ->limit(4)->orderBy('id DESC' )->all();
    }

    public static function getLastStock(){
        return News::find()
            ->joinWith('languages')
            ->where([ 'AND', ['=', 'languages.code' , Yii::$app->language], ['=', 'type' , self::TYPE_STOCK] ])
            ->limit(10)->orderBy('id DESC' )->all();
    }
    public static function removePinned($id, $type, $lang){
        return News::updateAll(['pinned' => 0], ['AND', ['<>', 'id' , $id], ['=', 'type' , $type], ['=', 'id_languages' , $lang]]);
    }
}
