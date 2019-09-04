<?php

use common\models\DealersCity;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\DealersSpecify;
use dosamigos\multiselect\MultiSelect;
use dosamigos\multiselect\MultiSelectListBox;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model common\models\DealersPart */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_kz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_kz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'internal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
    <?php

    $specifyList = DealersSpecify::find()->select('id, name_ru')->all();
    $list   = ArrayHelper::map( $specifyList,'id','name_ru');


    echo MultiSelect::widget([
        'id'=>"multiXX",
        "options" => ['multiple'=>"multiple"], // for the actual multiselect
        'data' => $list, // data as array
        'value' => $model->dealers_specify , // if preselected
        'name' => 'dealers_specify', // name for the form
        "clientOptions" =>
            [
                "includeSelectAllOption" => true,

            ],
    ]);
    ?>

    <?php
        $category = DealersCity::find()->all();
        $items = ArrayHelper::map($category,'id','name_ru');
        $params = [
            'prompt' => 'Укажите город'
        ];
        echo $form->field($model, 'id_city')->dropDownList($items,$params);
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


