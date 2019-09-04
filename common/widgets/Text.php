<?php
/**
 * Created by PhpStorm.
 * User: cpentyc
 * Date: 17.12.2018
 * Time: 17:29
 */
namespace common\widgets;

use common\models\AnyText;
use \yii\bootstrap\Widget;

class Text extends Widget{

    public $name;
    public function run()
    {
        /** @var AnyText $text */
        $text = AnyText::find()->where(['name' => $this->name])->one();
        if($text!= null)
            return $text->content;

        return '';

    }
}