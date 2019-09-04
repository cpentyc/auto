<?php
use common\models\DealersCity;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<div class="top_blog">
    <div class="wrapper">
        <div class="desc">
            <h1 class="text-center">Ремонт грузовых автомобилей<br/>TRUCK SERVICE STATION</h1>
            <div class="span12 text-center">и обслуживание грузовиков в сервисном центре СВС</div>
        </div>
        <div class="row" id="top_but">
            <div class="col-md-6 col-sm-6 subscribe-service">
                <button class="btn btn-primary pull-right">ЗАПИСАТЬСЯ НА СЕРВИС</button>
            </div>
            <div class="col-md-6 col-sm-6">
                <button class="btn btn-primary pull-left">ДОКУМЕНТЫ</button>
            </div>
            <div class="span12 text-center">НОРМО-ЧАС: <span>8000</span> KZT</div>
        </div>
        <div class="scroll text-center want-more">
            <div class="span12 ">Узнать больше</div>
            <a href="javascript:void(0)" class="btn btn-default btn-circle"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
        </div>
    </div>
</div>
<div class="logo_blog">
    <div class="wrapper">
        <div class="strong12 text-center">Обслуживаемые грузовые авто</div>
        <div class="span12 text-center">Мультибрендовый сервисный центр предлагает комплексное решение по ремонту и обслуживанию автомобилей всех марок и прицепов</div>
        <ul class="logo">
            <li><a href="http://cbc-service.kz/service/IVECO"><?= Html::img("/images/service/brands_6.png", ['alt' => 'iveco']); ?></a></li>
            <li><a href="http://cbc-service.kz/service/MAN"><?= Html::img("/images/service/brands_2.png", ['alt' => 'man', 'width' => 100]); ?></a></li>
            <li><a href="http://cbc-service.kz/service/ISUZU"><?= Html::img("/images/service/brands_5.png", ['alt' => 'isuzu']); ?></a></li>
            <li><a href="http://cbc-service.kz/service/KAMAZ"><?= Html::img("/images/service/brands_1.png", ['alt' => 'kamaz']); ?></a></li>
            <li><a href="http://cbc-service.kz/service/VOLVO"><?= Html::img("/images/service/brands_3.png", ['alt' => 'volvo']); ?></a></li>
            <li><a href="http://cbc-service.kz/service/RENAULT"><?= Html::img("/images/service/brands_8.png", ['alt' => 'renault']); ?></a></li>
            <li><a href="http://cbc-service.kz/service/DAF"><?= Html::img("/images/service/brands_4.png", ['alt' => 'daf']); ?></a></li>
            <li><a href="http://cbc-service.kz/service/MERCEDES"><?= Html::img("/images/service/brands_13.png", ['alt' => 'mercedes', 'width' => 140]); ?></a></li>
            <li><a href="http://cbc-service.kz/service/oborudovanie/BOSCH"><?= Html::img("/images/service/brands_11.png", ['alt' => 'bocsh', 'width' => 200]); ?></a></li>
            <li><a href="http://cbc-service.kz/service/oborudovanie/WABCO"><?= Html::img("/images/service/brands_9.jpg", ['alt' => 'wabco', 'width' => 170]); ?></a></li>
            <li><a href="http://cbc-service.kz/service/oborudovanie/ZF"><?= Html::img("/images/service/brands_12.png", ['alt' => 'zf', 'width' => 60]); ?></a></li>
            <li><a href="http://cbc-service.kz/service/oborudovanie/KOMATSU"><?= Html::img("/images/service/brands_10.png", ['alt' => 'komatsu', 'width' => 200]); ?></a></li>



        </ul>
    </div>
</div>
<div class="service_land">
    <div class="wrapper">
        <div class="strong12 text-center">Услуги, доступные всем</div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <?= Html::img('/images/service/service_img.png', ['alt' => 'service_img']); ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <ul>
                    <li><a>Ремонт ходовой части автомобиля и прицепа</a></li>
                    <li><a>Ремонт двигателя</a></li>
                    <li><a>Ремонт КПП, ведущего моста</a></li>
                    <li><a>Ремонт электрооборудования автомобиля</a></li>
                    <li><a>Ремонт пневмостистемы</a></li>
                    <li><a>Ремонт тормозной системы автомобиля и прицепа</a></li>
                    <li><a>Комплексная диагностика грузовых автомобилей</a></li>
                    <li><a>Ремонт топливной системы</a></li>
                    <li><a>Ремонт холодильного оборудования</a></li>
                </ul>
                <button class="btn btn-primary pull-left subscribe-service">ЗАПИСАТЬСЯ НА СЕРВИС</button>
            </div>
        </div>
    </div>
</div>
<div id="service-form" class="request">
    <div class="wrapper">
        <div  class="strong12 text-center">Запись на сервис</div>
        <div class="row">
            <div class="col-md-4  col-xs-3"></div>
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <?php
                            $items = ArrayHelper::map( DealersCity::find()->orderBy('sort_id')->all()  ,'name' ,'name');
                        ?>
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name'); ?>

                        <?= $form->field($model, 'phone') ?>

                        <?= $form->field($model, 'mark') ?>
                        <?= $form->field($model, 'city')->dropDownList($items) ?>
                        <?= $form->field($model, 'year') ?>
                        <?= $form->field($model, 'service')->dropDownList([
                            'Ремонт двигателя',
                            'Ремонт КПП, ведущего моста',
                            'Ремонт электрооборудования автомобиля',
                            'Ремонт пневмостистемы',
                            'Ремонт тормозной системы автомобиля и прицепа',
                            'Комплексная диагностика грузовых автомобилей',
                            'Ремонт топливной системы',
                            'Ремонт холодильного оборудования',
                            'Ремонт погрузчиков',
                            'Другое'
                        ]) ?>


                        <?= Html::submitButton('ЗАПИСАТЬСЯ НА СЕРВИС', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

                        <?php ActiveForm::end(); ?>

                        <!--<input type="text" class="form-control" placeholder="ФИО" aria-describedby="basic-addon1">
                        <input type="text" class="form-control" placeholder="Контактный телефон" aria-describedby="basic-addon1">
                        <input type="text" class="form-control" placeholder="Марка авто" aria-describedby="basic-addon1">
                        <input type="text" class="form-control" placeholder="Модель авто" aria-describedby="basic-addon1">
                        <input type="text" class="form-control" placeholder="Год выпуска" aria-describedby="basic-addon1">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Выбор услуги
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Another action</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                        <button id="reg" class="btn btn-primary">ЗАПИСАТЬСЯ НА СЕРВИС</button> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-3"></div>
        </div>
    </div>
</div>
<div class="plus">
    <div class="wrapper">
        <div class="strong12 text-center">Почему стоит обратиться к нам?</div>
        <div class="span12 text-center">Мультибрендовый сервисный центр СВС предлагает комплексное решение<br/>
            по ремонту и обслуживанию автомобилей всех марок и прицепов – от ходовой части<br/> до сложных работ по электронике и пневмосистемам. <br/>
            Кроме того, у нас Вы сможете найти оригинальные запасные части по приемлемым <br/>ценам.  <strong>На все товары и услуги мы предоставляем гарантию.</strong></div>
        <div class="p12 text-center"><div class="line" style="float: left;"></div>ПРОИЗВОДСТВЕННЫЕ МОЩНОСТИ<div class="line"  style="float: right;"></div></div>
        <ul>
            <li>
                <?= Html::img('/images/service/main _f1.png', ['alt' => 'main _f1']); ?>
                <span>5 городов</span>
            </li>
            <li>
                <?= Html::img('/images/service/main _f2.png', ['alt' => 'main _f2']); ?>
                <span>7 сервисных центров</span>
            </li>
            <li>
                <?= Html::img('/images/service/main _f3.png', ['alt' => 'main _f3']); ?>
                <span>200 обслуживающего<br/>персонала</span>
            </li>
            <li>
                <?= Html::img('/images/service/main _f4.png', ['alt' => 'main _f4']); ?>
                <span>16 складов оригинальных<br/>запчастей</span>
            </li>
            <li>

                <?= Html::img('/images/service/main _f5.png', ['alt' => 'main _f5']); ?>
                <span>современное<br/>оборудование</span>
            </li>
            <li>
                <?= Html::img('/images/service/main _f6.png', ['alt' => 'main _f6']); ?>
                <span>постоянное развитие<br/>персонала</span>
            </li>
        </ul>
    </div>
</div>


<?php

$script = <<< JS
   $(document).on('click','.subscribe-service',function(){
        $('html, body').animate({
        scrollTop: $("#service-form").offset().top
        }, 2000);
    });
JS;
$this->registerJs($script);
?>


