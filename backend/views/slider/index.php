<?php

use backend\components\AutoGridView;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sliders');
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
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => 'Показывать',
                'format' => 'raw',
                'value' => function($data){
                    return ($data->isActive==1? "Да": "Нет");
                },
            ],
            'rank',
            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                    return $data->displayImage('image');
                        /*Html::img($data->image,[
                        'alt'=>'yii2 - картинка в gridview',
                        'style' => 'width:100px;'
                    ]);*/
                },
            ],
            'name',
            [
                'attribute' => 'languages',
                'value'=>'languages.title', //relation name with their attribute
            ]

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>
