<?php

use common\models\News;
use yii\helpers\Html;
use backend\components\AutoGridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if($type==null)
$this->title = Yii::t('app', 'Акции/Новости/Страницы');
if($type==News::TYPE_PAGE)
    $this->title = Yii::t('app', 'Страницы');
if($type==News::TYPE_STOCK)
    $this->title = Yii::t('app', 'Акции');
if($type==News::TYPE_NEWS)
    $this->title = Yii::t('app', 'Новости');

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= AutoGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'slug',
            'meta_title',
            [
                'label' => 'Тип',
                'format' => 'raw',
                'value' => function($data){
                    if($data->type== News::TYPE_NEWS)
                        return  "Новость";
                    if($data->type== News::TYPE_PAGE)
                        return  "Страница";
                    if($data->type== News::TYPE_STOCK)
                        return  "Акция";

                    return  "Ошибка";
                },
            ],
            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                    return Html::img($data->preview,[
                        'alt'=>'yii2 - картинка в gridview',
                        'style' => 'width:100px;'
                    ]);
                },
            ],
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
