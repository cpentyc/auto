<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DealersSpecify */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'name_kz')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
