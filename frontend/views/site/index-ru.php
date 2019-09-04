<?php

/* @var $this yii\web\View */
/* @var $stock common\models\News */
/* @var $news common\models\News[] */

use common\models\News;
use common\widgets\Text;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'Русский заголовок';
?>
<div class="site-index">

    <div class="row" id="mainTopRow">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl4 " style="padding-left: 0;">
            <h3 class="mainh3"><?= Yii::t('app', 'Акции на покупку'); ?></h3>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8" style="padding-right: 0;">
            <a class="modalServiceLink phoneIcon marginTop15 btn btn-outline-primary" data-toggle="modal" data-target="#modalCall"><?= Yii::t('app', 'ЗАКАЗАТЬ ЗВОНОК'); ?></a>

            <a class="modalServiceLink marginTop15 btn btn-outline-primary" data-toggle="modal" data-target="#modalTest"><?= Yii::t('app', 'ЗАПИСАТЬСЯ НА ТЕСТ ДРАЙВ'); ?></a>

            <a class="modalServiceLink  marginTop15 btn btn-outline-primary" data-toggle="modal" data-target="#modalService"><?= Yii::t('app', 'ЗАПИСЬ НА СЕРВИС'); ?></a>
        </div>

    </div>
    <div class="row" id="mainStock">
        <?= \common\widgets\StockSlider::widget(); ?>

    </div>
    <div class="row" style="margin-top: 15px">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h3 class="mainh3"><?= Yii::t('app', 'Лидеры Продаж') ?></h3>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <?php // Html::a(Yii::t('app', 'Показать все новости'), ['news/index'], ['class' => 'allNews']) ?>
        </div>
    </div>
    <div class="row" id="salesLeader">
        <?php
        /** @var \common\models\Product $product */
        foreach ($products as $product)
        {
            ?>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 salesLeaderItem">
                <div class="itemCategory"><div><?= $product->category->name; ?></div>  </div>
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <?= Html::img($product->image, ['class' => 'leaderImg']); ?>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h2 class="h2-product text-uppercase">
                            <?= Html::a($product->h1,
                                ['category/product', 'slug'=> $product->slug ],
                                ['class' => 'newsLinkTitle']); ?><br />
                        </h2>
                        <span class="salesLeaderDescription"><?= $product->model; ?></span>
                        <span class="leaderPrice">
                            <?= Yii::t('app', 'от ').number_format($product->price, 0, '.', ' ').Yii::t('app', ' тг.'); ?>
                        </span>

                        <div class="prod-desc-p">
                            <?= $product->equipment; ?>
                        </div>
                        <?= Html::a(Yii::t('app', 'подробнее'), ['category/product', 'slug'=> $product->slug ],['class' => 'moreProduct']); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h3 class="mainh3"><?= Yii::t('app', 'Новости') ?></h3>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <?= Html::a(Yii::t('app', 'Показать все новости'), ['news/index'], ['class' => 'allNews']) ?>
        </div>
    </div>

    <div class="row" id="mainNews">
        <?php
        /** @var News $new */
        foreach ($news as $new)
            {
                ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <?= Html::img($new->preview); ?><br />
                <? // Html::a($new->h1, ['news/view', 'slug' => $new->slug], ['class' => 'newsLinkTitle']); ?>
                <p><?= $new->h1; ?></p>
                    <?= Html::a(Yii::t('app', 'подробнее') , ['news/view', 'slug' => $new->slug], ['class' => 'newsLinkTitle']); ?>
                </div>
                <?php
            }
        ?>

    </div>
    <div class="row" id="liaderText">
        <div class="col-12">
            <?= Text::widget(['name' => 'main']); ?>

        </div>
    </div>

</div>
