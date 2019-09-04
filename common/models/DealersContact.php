<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "dealers_contact".
 *
 * @property integer $id
 * @property integer $dealers_id
 * @property string  $name
 * @property string  $lang
 *
 * @property Receipt $receipt
 */
class DealersContact extends ActiveRecord
{
    /**
     * these are flags that are used by the form to dictate how the loop will handle each item
     */
    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';

    const SCENARIO_BATCH_UPDATE = 'batchUpdate';


    private $_updateType;

    public function getUpdateType()
    {
        if (empty($this->_updateType)) {
            if ($this->isNewRecord) {
                $this->_updateType = self::UPDATE_TYPE_CREATE;
            } else {
                $this->_updateType = self::UPDATE_TYPE_UPDATE;
            }
        }

        return $this->_updateType;
    }

    public function setUpdateType($value)
    {
        $this->_updateType = $value;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealers_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['updateType', 'required', 'on' => self::SCENARIO_BATCH_UPDATE],
            ['updateType',
                'in',
                'range' => [self::UPDATE_TYPE_CREATE, self::UPDATE_TYPE_UPDATE, self::UPDATE_TYPE_DELETE],
                'on' => self::SCENARIO_BATCH_UPDATE
            ],
            [['name' , 'email', 'lang'], 'required'],
            //allowing it to be empty because it will be filled by the ReceiptController
            ['dealers_id', 'required', 'except' => self::SCENARIO_BATCH_UPDATE],
            [['dealers_id'], 'integer'],
            ['email', 'email'],
            [['name', 'email', 'lang'], 'string', 'max' => 255]
        ];
    }
}