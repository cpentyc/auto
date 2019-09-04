<?php

use backend\components\AutoGridView;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= AutoGridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [

                    'id',
                    [
                        'label' => 'Картинка',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::img($data->image,[
                                'alt'=>'yii2 - картинка в gridview',
                                'style' => 'width:100px;'
                            ]);
                        },
                    ],
                    'meta_title',
                    'h1',
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
