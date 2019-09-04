<?php

use backend\components\AutoGridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Emails');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body" id="slideGrid">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a(Yii::t('app', 'Create Slider'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= AutoGridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'email'

                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
