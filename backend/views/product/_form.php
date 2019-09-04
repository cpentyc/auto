<?php

use common\models\Category;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use budyaga\cropper\Widget;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\product */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-product-avatar required">
        <?
        echo $form->field($model, 'image', ['options' => ['id' => 'uploadavatar']])->widget(Widget::className() , [
            'uploadUrl' => Url::toRoute('uploadLogo'),
            'cropAreaWidth' => 300,
            'cropAreaHeight' => 300,
            'width' => 250, # Ширина обрезаной картинки

            'height' => 170, # Высота обрезаной картинки
            'thumbnailWidth' => '250',
            'thumbnailHeight' => '170',
            'maxSize' => 1024 * 1024 * 4, # Максимальный размер загружаемой картинки
            'noPhotoImage' => '/uploads/avatar/default.jpg',
        ])->label(false);
        ?>
    </div>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => '/backend/web/index.php?r=site%2Fupload'
        ]
    ]) ?>


    <?= $form->field($model, 'specifications')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => '/backend/web/index.php?r=site%2Fupload'
        ]
    ]) ?>

    <?= $form->field($model, 'equipment')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => '/backend/web/index.php?r=site%2Fupload'
        ]
    ]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'сondition')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'guaranty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>



    <?= $form->field($model, 'id_languages')->dropDownList([1 => 'Русский', 2 => "Казахский", 3 => "Английский"]) ?>

    <?php

        $category = Category::find()->all();
        $items = ArrayHelper::map($category,'id','name');
        $params = [
            'prompt' => 'Укажите категорию'
        ];
        echo $form->field($model, 'id_category')->dropDownList($items,$params);
    ?>
    <?= $form->field($model, 'sales_leader')->checkbox() ?>
    <?= $form->field($model, 'used')->checkbox() ?>

    <?php
        if ($model->isNewRecord) {
            echo 'Can not upload images for new record';
        } else {
            echo GalleryManager::widget(
                [
                    'model' => $model,
                    'behaviorName' => 'galleryBehavior',
                    'apiRoute' => 'product/galleryApi'
                ]
            );
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


<?php
$this->registerJs("
            $('#product-meta_title').on('change', function(e) {
                $.ajax({
                   url: \"".Url::toRoute(['product/slug'])."\",
                   data: {page_title: $('#product-meta_title').val()},
                   success: function(data) {
                       $('#product-slug').val(data);
                   }
                });
            });
        ");
?>
