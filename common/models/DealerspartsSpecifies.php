<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dealersparts_specifies".
 *
 * @property int $id
 * @property int $dealerspart_id
 * @property int $dealersspecify_id
 */
class DealerspartsSpecifies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dealersparts_specifies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dealerspart_id', 'dealersspecify_id'], 'required'],
            [['dealerspart_id', 'dealersspecify_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dealerspart_id' => Yii::t('app', 'Dealerspart ID'),
            'dealersspecify_id' => Yii::t('app', 'Dealersspecify ID'),
        ];
    }
}
