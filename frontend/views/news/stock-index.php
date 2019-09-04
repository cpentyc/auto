<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Акции компании');
$this->params['breadcrumbs'][] = $this->title;
/** @var common/models/News[] $models */
$count = count( $models );
?>
<div class="news-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php if($count>0): ?>
        <div class="row" id="newsBig1">
            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 leftImage" >
                <?= Html::img('/images/news/'.$models[0]->image); ?>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <h3><?= $models[0]->h1; ?></h3>
                <?= Html::a(Yii::t('app', 'Подробнее'), ['news/stock-view', 'slug'=> $models[0]->slug ]); ?>
            </div>
        </div>
    <?php endif; ?>
    <br />
    <div class="row newsList" >
        <?php
        $i = 2;
        while ($i<6 && $i<$count )
        {
            ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <?= Html::img($models[$i]->preview); ?><br />
                <?= Html::a($models[$i]->h1, ['news/stock-view', 'slug'=> $models[$i]->slug ], ['class' => 'newsLinkTitle']); ?><br />
                <p><?= $models[$i]->meta_description; ?></p>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
    <br />
    <?php if($count>1): ?>
        <div class="row" id="newsBig2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 leftImage" >
                <?= Html::img('/images/news/'.$models[1]->image); ?>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <h3><?= $models[1]->h1; ?></h3>
                <?= Html::a(Yii::t('app', 'Подробнее'), ['news/stock-view', 'slug'=> $models[1]->slug ]); ?>
            </div>
        </div>
    <?php endif; ?>
    <br />

    <div class="row newsList" >
        <?php
        $i = 6;
        while ($i<10 && $i<$count)
        {
            ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <?= Html::img($models[$i]->preview); ?><br />
                <?= Html::a($models[$i]->h1, ['news/stock-view', 'slug'=> $models[$i]->slug ], ['class' => 'newsLinkTitle']); ?><br />
                <p><?= $models[$i]->meta_description; ?></p>
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
