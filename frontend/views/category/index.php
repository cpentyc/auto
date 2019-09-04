<?php

use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $models common\models\Product */

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$count = count( $models );
?>
<div class="category-view">
    <div class="row selectRow">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <?= Html::beginForm() ?>
            <?= Html::endForm() ?>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 rightSelect">

            <?= Html::beginForm() ?>
            <?= Html::dropDownList(
                'sort', //name
                $sort,  //select
                [0 => 'Сортировать от А до Я', 1 => 'Сортировать от Я до А'], //items
                ['onchange'=>'this.form.submit()'] //options
            )?>
            <?= Html::endForm() ?>
        </div>
    </div>

    <div class="row">
        <?php
        $i = 0;
        while ($i<12 && $i<$count )
        {
            ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="productBorder">
                    <?= Html::img($models[$i]->image); ?><br />
                    <p><?= $models[$i]->h1; ?></p>
                    <span class="productPrice"><?= Yii::t('app', 'От ');?><span class="bluePrice"> <?=$models[$i]->price ?>тг.</span></span>
                    <?= Html::a(Yii::t('app', 'Подробнее'), ['category/product', 'slug'=> $models[$i]->slug ], ['class' => 'productMore btn']); ?><br />
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>

    <div class="row">
        <div class="col-12">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,
                'options' => ['class' => 'pagination', 'id' => 'cbcPagination'],
            ]);
            ?>
        </div>
    </div>

</div>
