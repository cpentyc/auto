<?php

use backend\components\AutoGridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= AutoGridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'actionColumnTemplate' => '{view}{update}{delete}{upload}',
                'columns' => [
                    'id',
                    'name_ru',
                    'slug',
                    [
                        'label' => 'Родительская',
                        'format' => 'raw',
                        'value' => function($data){
                            if($data->id_parent == null)
                                return "Родительская";
                            else
                                return $data->parent->name;
                        },
                    ],
                    [
                        'label' => 'Картинка',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::img($data->logo,[
                                'alt'=>'yii2 - картинка в gridview',
                                'style' => 'width:100px;'
                            ]);
                        },
                    ],
                    'description_ru:ntext',

                ],

            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>


