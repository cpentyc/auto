<?php

use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use budyaga\cropper\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\category */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>

    <?php
    if(!$model->isNewRecord)
        echo $model->displayImage('image');
    ?>
    <?=
    $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]);
    ?>

    <div class="form-group">
        <?
        echo $form->field($model, 'logo', ['options' => ['id' => 'uploadavatar']])->widget(Widget::className() , [
            'uploadUrl' => Url::toRoute('uploadLogo'),
            'cropAreaWidth' => 280,
            'cropAreaHeight' => 250,
            'thumbnailWidth' => '300',
            'thumbnailHeight' => '300',
            'maxSize' => 1024 * 1024 * 4, # Максимальный размер загружаемой картинки
            'noPhotoImage' => '/uploads/avatar/default.jpg',
        ])->label(false);
        ?>
    </div>

    <?php

    $category = Category::find()->all();
    $items = ArrayHelper::map($category,'id','name');
    $params = [
        'prompt' => 'Укажите родительскую категорию'
    ];
    echo $form->field($model, 'id_parent')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_kz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description_ru')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_kz')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_en')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


