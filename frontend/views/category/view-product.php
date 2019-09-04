<?php
use common\models\Product;
use common\widgets\ContentSlider;
use frontend\models\TestForm;
use yii\bootstrap\Tabs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Product */

$this->title = $model->meta_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Каталог'), 'url' => ['index']];

if($model->category->id_parent!=null)
{
    $this->params['breadcrumbs'][] = ['label' => $model->category->parent->name, 'url' => ['category/view', 'slug' =>  $model->category->parent->slug] ];
    $this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => ['category/view', 'slug' =>  $model->category->parent->slug, 'subSlug' => $model->category->slug] ];
}
else
{
    $this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => ['category/view', 'slug' =>  $model->category->slug] ];
}

$this->params['breadcrumbs'][] = [    'label' => $model->h1,    'encode' => false ];
?>
<div class="slider">
    <?= Html::img('/images/category/'.$model->category->image); ?>
    <div id="linkPanel">
        <?= Html::a(Yii::t('app', 'ТЕСТ-ДРАЙВ'), ['/news/page-view', 'slug' => 'test-drive']); ?>
        <?= Html::a(Yii::t('app', 'КРЕДИТ'), ['/news/page-view', 'slug' => 'crediting']); ?>
        <?= Html::a(Yii::t('app', 'СТРАХОВКА'), ['/news/page-view', 'slug' => 'insurance']); ?>
        <?= Html::a(Yii::t('app', 'ВЫКУП АВТОМОБИЛЯ'), ['/news/page-view', 'slug' => 'auto-registration']); ?>
    </div>

</div>

<div class="container">

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

<div class="product-view">
    <h1><?= $model->h1; ?></h1>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 productGallery">
            <?php
            echo newerton\fancybox\FancyBox::widget([
                'target' => 'a[rel=fancybox]',
                'helpers' => true,
                'mouse' => true,
                'config' => [
                    'maxWidth' => '90%',
                    'maxHeight' => '90%',
                    'playSpeed' => 7000,
                    'padding' => 0,
                    'fitToView' => false,
                    'width' => '70%',
                    'height' => '70%',
                    'autoSize' => false,
                    'closeClick' => false,
                    'openEffect' => 'elastic',
                    'closeEffect' => 'elastic',
                    'prevEffect' => 'elastic',
                    'nextEffect' => 'elastic',
                    'closeBtn' => false,
                    'openOpacity' => true,
                    'helpers' => [
                        'title' => ['type' => 'float'],
                        'buttons' => [],
                        'thumbs' => ['width' => 68, 'height' => 50],
                        'overlay' => [
                            'css' => [
                                'background' => 'rgba(0, 0, 0, 0.8)'
                            ]
                        ]
                    ],
                ]
            ]);
            ?>
            <?php
            $first = true;
            foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
                if($first)
                {
                    echo Html::a(Html::img($image->getUrl('medium')), $image->getUrl('original'), ['rel' => 'fancybox', 'class' => 'mainImage']);
                    $first = false;
                }
                else
                {
                    echo Html::a(Html::img($image->getUrl('small')), $image->getUrl('original'), ['rel' => 'fancybox']);
                }

            }

            ?>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 productContent productValue">
            <h3 class="productH3"><?= Yii::t('app', 'О ТОВАРЕ'); ?> </h3>
                <? if($model->price != ''):?>
                    <strong><?= Yii::t('app', 'Цена'); ?>:</strong> <span><?= $model->price; ?></span><br />
                <? endif;?>
                <? if($model->guaranty != ''):?>
                    <strong><?= Yii::t('app', 'Гарантия'); ?>:</strong> <span><?= $model->guaranty; ?></span><br />
                <? endif;?>
                <? if($model->сondition != ''):?>
                    <strong><?= Yii::t('app', 'Условия'); ?>:</strong> <span><?= $model->сondition; ?></span><br />
                <? endif;?>
            <br /><br />
            <a class="modalServiceLink  marginTop15 btn btnProduct" data-toggle="modal" data-target="#modalCall"><?= Yii::t('app', 'ЗАКАЗАТЬ ЗВОНОК'); ?></a>
        </div>
    </div>
    <div class="row">
        <div class="productContent">
            <?= $model->content; ?>
            <?php

            echo Tabs::widget([
                'id' => 'productTabs',
                'items' => [
                    [
                        'label'     =>  Yii::t('app', 'Технические характеристики'),
                        'content'   =>  $this->render('_specifications', ['model' => $model->specifications]),
                        'active'    =>  true
                    ],
                    [
                        'label'     =>  Yii::t('app', 'Комплектация'),
                        'content'   =>  $this->render('_equipment', ['model' => $model->equipment])
                    ],
                  /*  [
                        'label'     =>  Yii::t('app', 'Фотогаллерея'),
                        'content'   =>  $this->render('_gallery', ['model' => $model])
                    ]*/
                ]
            ]);
            ?>
        </div>
    </div>


</div>
</div>
    <div id="productQuestion" class="">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                    <p class="ftrProduct">
                        <?= Yii::t('app', 'Есть вопросы? Затрудняетесь с выбором? Нужна консультация? <br />Заполните форму ниже и наши менеджеры свяжутся с Вами в ближайшее время!') ?>
                    </p>
                </div>
            </div>
            <div class="row">

                <?php $form = ActiveForm::begin(['id' => 'question-form', 'action' => 'site/call']); ?>
                <?php $model = new TestForm(); ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <?= $form->field($model, 'name')
                        ->textInput()->input('name', ['placeholder' => Yii::t('app', 'Как к Вам обращаться?')])
                        ->label(''); ?>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                    <?= $form->field($model, 'phone')
                        ->textInput()->input('phone', ['placeholder' => Yii::t('app', 'Ваш номер телефона')])
                        ->label('') ?>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'ЗАДАТЬ ВОПРОС'), ['class' => 'btn btn-outline-primary', 'name' => 'contact-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>


