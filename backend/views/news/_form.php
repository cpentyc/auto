<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use budyaga\cropper\Widget;
/* @var $this yii\web\View */
/* @var $model common\models\news */
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
<br />
<br />
<br />

    <div class="form-group field-product-avatar required">
        <?
        echo $form->field($model, 'preview', ['options' => ['id' => 'uploadavatar']])->widget(Widget::className() , [
            'uploadUrl' => Url::toRoute('uploadLogo'),
            'cropAreaWidth' => 225,
            'cropAreaHeight' => 171,
             'width' => 225,
            'height' => 171,
            'thumbnailWidth' => '225',
            'thumbnailHeight' => '171',
            'maxSize' => 1024 * 1024 * 4, # Максимальный размер загружаемой картинки
            'noPhotoImage' => '/uploads/avatar/default.jpg',
        ])->label(false);
        ?>
    </div>
    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => '/backend/web/index.php?r=site%2Fupload'
        ]
    ]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pinned')->checkbox() ?>
    <?= $form->field($model, 'id_languages')->dropDownList([1 => 'Русский', 2 => "Казахский", 3 => "Английский"]) ?>
    <?= $form->field($model, 'type')->dropDownList([$model::TYPE_NEWS => 'Новость', $model::TYPE_STOCK => "Акция", $model::TYPE_PAGE => "Страница"]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
$this->registerJs("
            $('#news-meta_title').on('change', function(e) {
                $.ajax({
                   url: \"".Url::toRoute(['news/slug'])."\",
                   data: {page_title: $('#news-meta_title').val()},
                   success: function(data) {
                       $('#news-slug').val(data);
                   }
                });
            });
        ");
?>
