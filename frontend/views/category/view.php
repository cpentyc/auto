<?php

use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $subModel Category */
/* @var $model Category */
/* @var $models common\models\Product */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Каталог'), 'url' => ['index']];

if($subModel!=null) {
    $this->params['breadcrumbs'][] = ['label' =>  $model->name , 'url' => ['category/view', 'slug' =>  $model->slug]];
    $this->params['breadcrumbs'][] = $subModel->name;
    $this->title = $model->name.' '.$subModel->name;
}
else
{
    $this->title = $model->name;
    $this->params['breadcrumbs'][] = $model->name;
}
\yii\web\YiiAsset::register($this);
$count = count( $models );
?>
<div class="category-view">
    <div class="row">
        <div class="col-12">
            <?= Html::img(  $model->logo, ['alt' => $model->name, 'title' => $model->name, 'class' => 'categoryLogo'])?>
            <h1><?= Html::encode($this->title ) ?></h1>
            <p><?= Html::encode($model->description) ?></p>
        </div>
    </div>
    <div class="row selectRow">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <?php

            $category = $model->children;
            echo Html::beginForm();
            if($category !=null){
                $items = ArrayHelper::map($category,function($item) {return Url::toRoute(['/category/view', 'slug' => $item->parent->slug, 'subSlug' => $item->slug, ]);},'name');
                $def = null;
                if($subModel !=null)
                    $def = Url::toRoute(['/category/view', 'slug' => $subModel->parent->slug, 'subSlug' => $subModel->slug, ]);
                echo  Html::dropDownList(
                    'cat',
                    $def ,
                    $items,
                    ['id'=>'subCat']
                );
            }
            ?>


            <?= Html::endForm() ?>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 rightSelect">

            <?= Html::beginForm() ?>
            <?= Html::dropDownList(
                'sort', //name
                $sort,  //select
                [0 => 'Сортировать от А до Я', 1 => 'Сортировать от Я до А'], //items
                ['onchange'=>'this.form.submit()', 'id'=>'sortOptions'] //options
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


<?php

$script = <<< JS
    $('#subCat').on('change', function(){
       
       
        subSlug = $(this).val();
        console.log(subSlug);
        window.location.replace(subSlug );
    });
JS;
$this->registerJs($script);
?>

