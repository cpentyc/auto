<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->meta_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Акции'), 'url' => ['stock-index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

    <h1><?= Html::encode($model->h1) ?></h1>
    <?= Html::img(  '/images/news/'.$model->image, ['alt' => $model->meta_title, 'title' => $model->meta_title, 'class' => 'newsImg'])?>
    <?= $model->content; ?>

</div>
