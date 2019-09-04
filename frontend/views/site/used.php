<?php

use common\models\Category;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $models common\models\Product */

$this->title = 'Б/У все';
$this->params['breadcrumbs'][] = [    'label' => Yii::t('app', 'Б/У'),    'encode' => false ];
\yii\web\YiiAsset::register($this);
$count = count( $models );
?>
<br />
<br />
<br />
<br />
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= Alert::widget() ?>
<div class="used-all">
    <div class="row" id="mainStock">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
            <img src="/images/imgUsed.png" />
            <p class="usedDescription">
                Группа компаний СВС предлагает качественную Б/У грузовую технику,  Широкий ассортимент грузовиков с пробегом для вас и вашего бизнеса.
                Высокий многолетний кредит доверия, высокое качество и низкая стоимость. Б/У техника от официального дилера в Казахстане!
            </p>
        </div>
    </div>
    <div class="row selectRow">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <?php
            echo Html::beginForm();
            if($category !=null){
                $items = ArrayHelper::map($category,function($item) {return Url::toRoute(['/site/used', 'slug' => $item->slug ]);},'name');
                $def = null;
                if($slug !=null)
                    $def = Url::toRoute(['/site/used', 'slug' => $slug ]);
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
                ['onchange'=>'this.form.submit()'] //options
            )?>
            <?= Html::endForm() ?>
        </div>
    </div>

    <div class="row" id="usedItems">
        <?php
        $i = 0;
        while ($i<6 && $i<$count )
        {
            ?>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5  salesLeaderItem">
                <div class="itemCategory"><div><?= Yii::t('app', 'Акция');  ?></div>  </div>
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <?= Html::img($models[$i]->image, ['class' => 'usedImage']); ?>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h2 class="h2-product text-uppercase">
                            <?= Html::a($models[$i]->h1,  ['category/product', 'slug'=> $models[$i]->slug ], ['class' => 'newsLinkTitle']); ?><br />
                        </h2>

                        <p class="prod-desc-h  text-uppercase">
                            <?= Yii::t('app', 'Комплектация'); ?> :
                        </p>
                        <p class="prod-desc-p">
                        <p><?= $models[$i]->equipment; ?></p>
                        </p>
                    </div>
                </div>
            </div>
            <?php if($i%2==0): ?>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">&nbsp;</div>
            <?php
            endif;
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
