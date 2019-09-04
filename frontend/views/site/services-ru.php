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





$this->params['breadcrumbs'][] = [    'label' => Yii::t('app', 'Надстройки'),    'encode' => false ];
?>
<div class="serviceImage">

</div>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= Alert::widget() ?>

    <div class="service-view">

        <h1><?= Yii::t('app', 'Грузовые надстройки') ?></h1>
        <p>
            Производство автофургонов осуществляется по современным технологиям с применением качественных материалов.
            Грузовые фургоны, цена на которые зависит от комплектации и сферы применения, при изготовлении
            оснащаются всем необходимым новейшим оборудованием.
        </p>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im1">
                <? //Html::a('<img src="/images/1.jpg" />', [''] ); ?><br />
                <?= Html::a('Рефрижираторы', ''); ?>

            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im2">
                <?// Html::a('<img src="/images/2.jpg" />', [''] ); ?><br />
                <?= Html::a('Цельнометаллические', ''); ?>

            </div> <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im3">
                <?// Html::a('<img src="/images/3.jpg" />', [''] ); ?><br />
                <?= Html::a('Фургоны спецназначения', ''); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im4">
                <?// Html::a('<img src="/images/4.jpg" />', [''] ); ?><br />
                <?= Html::a('Бортовые платформы', ''); ?>

            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im5">
                <?// Html::a('<img src="/images/5.jpg" />', [''] ); ?><br />
                <?= Html::a('Прицепная техника', ''); ?>

            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im6">
                <?// Html::a('<img src="/images/6.jpg" />', [''] ); ?><br />
                <?= Html::a('Доп. оборудование', ''); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im7">
                <?// Html::a('<img src="/images/7.jpg" />', [''] ); ?><br />
                <?= Html::a('Эвакуаторы', ''); ?>

            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im8">
                <?// Html::a('<img src="/images/8.jpg" />', [''] ); ?><br />
                <?= Html::a('Краны-манипуляторы (КМУ)', ''); ?>

            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 imageCell im9">
                <?// Html::a('<img src="/images/9.jpg" />', [''] ); ?><br />
                <?= Html::a('Автогидро-подъёмники', ''); ?>

            </div>
        </div>

    </div>
</div>
<div id="serviceQuestion" class="">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 leftService">
                <h3>
                    <?= Yii::t('app', 'НЕ МОЖЕТЕ ВЫБРАТЬ?') ?>
                </h3>
                <p>
                    Оставьте заявку, наши менеджеры свяжутся с Вами и проведут полную консультацию!
                </p>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 rightService">
                <?= Html::submitButton(Yii::t('app', 'Отправить заявку'),
                    ['class' => 'btn btn-outline-primary serviceButton',    "data-toggle"=>"modal", "data-target"=>"#modalCall" ,        'name' => 'contact-button']) ?>
            </div>
        </div>
    </div>
</div>
