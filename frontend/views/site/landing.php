<?php
use common\models\Category;
use common\models\Product;

?>
<div class="dmx-header">
    <div class="wrapper">

    </div>
</div>
<div class="blackbox">
    <div class="wrapper">
        <p class="blackbox">
            Пикап ISUZU D-MAX – автомобиль всемирно известной японской марки, Он сочетает в себе японские традиции качества, инновационные технологии, улучшенные технические характеристики и безупречный дизайн. На основе векового опыта японские инженеры создали один из лучших автомобилей в своем классе. Выбрать автомобиль зачастую не так быстро и просто, но на ряду с десятками интересных моделей японская классика всегда будет актуальной и уместной. И водитель, и пассажир ощутят максимальный комфорт в салоне ISUZU D-MAX.
        </p>
    </div>
</div>
<div class="colorpicker">
    <div class="wrapper">
        <strong class="dmxstr">Цвет корпуса</strong>
        <div class="dmaxauto Ash_Beige_Met">
            <span>Ash Beige Met</span>
        </div>

        <ul class="selectcolor">
            <li><a href="javascript:void(0)" id="Ash_Beige_Met"></a></li>
            <li><a href="javascript:void(0)" id="Cosmic_Black_Mica"></a></li>
            <li><a href="javascript:void(0)" id="Garnet_Red_Mica"></a></li>
            <li><a href="javascript:void(0)" id="Mineral_Gray_Met"></a></li>
            <li><a href="javascript:void(0)" id="Nautilus_Blue_Mica"></a></li>
            <li><a href="javascript:void(0)" id="Titanium_Silver_Met"></a></li>
            <li><a href="javascript:void(0)" id="Tundra_Green_Mica"></a></li>
            <li><a href="javascript:void(0)" id="Splash_White"></a></li>
        </ul>
    </div>
</div>
<div class="dmxpluses">
    <div class="wrapper" style="max-width: 1000px;">
        <strong class="dmxstr">Основные преимущества</strong>
        <ul>
            <li>Пикап ISUZU D-MAX отличается вместительностью и функциональностью, увеличенное пространство в кабине и эргономичные сиденья создают оптимальные условия для поездок на дальние расстояния.</li>
            <li>Сдержанная отделка, не привлекающая к себе лишнего внимания, при этом свидетельствующая о хорошем вкусе автовладельца</li>
            <li>Практичный интерьер</li>
            <li>Качественные отделочные материалы</li>
            <li>Поглощение шума и вибрации</li>
        </ul>
    </div>
</div>
<div class="engine">
    <div class="wrapper" style="max-width: 1000px;">
        <img src="/images/landing/engine.png" />
        <strong style="font-weight: 700; font-size: 23px;">Дизельный двигатель</strong>
        <span>Под капотом нового D-max – знаменитый дизельный двигатель Isuzu, обладающий превосходной топливной экономичностью и обеспечивающий высокие мощность и крутящий момент в широчайшем диапазоне оборотов, достаточные для любых работ.<br/><br/>
Команда ISUZU приложила максимум усилий, чтобы гарантировать вам приятные впечатления от каждой поездки.</span>
    </div>
</div>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.1/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.1/jquery.fancybox.min.js"></script>

<div class="salon">
    <div class="wrapper">
        <a data-fancybox="gallery" href="/images/landing/1.jpg"><img class="first" src="/images/landing/1.jpg" alt="1.jpg" /></a>
        <a data-fancybox="gallery" href="/images/landing/2.jpg"><img class="last" src="/images/landing/2.jpg" alt="2.jpg" /></a>
        <a data-fancybox="gallery" href="/images/landing/3.jpg"><img class="last" src="/images/landing/3.jpg" alt="3.jpg" /></a>
        <a data-fancybox="gallery" href="/images/landing/4.jpg"><img class="last" src="/images/landing/4.jpg" alt="4.jpg" /></a>
        <a data-fancybox="gallery" href="/images/landing/5.jpg"><img class="last end" src="/images/landing/5.jpg" alt="5.jpg" /></a>
    </div>
</div>
<div class="winter_gttext">
    <div class="wrapper">

        <strong class="dmxstr" style="margin-left:0px; margin-bottom: 20px;">Зимний пакет </strong>
        <span style="margin-bottom: 20px;">
		Новый D-max оснащен «зимним пакетом», в который входит автономный подогрев топливного бака, подогрев контура подачи топлива включая топливный фильтр.  Зимний пакет подогрева топливной системы гарантирует запуск двигателя в холодное время года, прогретый салон и рабочую температуру двигателя.
				</span>
    </div>
</div>
<div class="winter" style="margin-top: 20px;">

</div>
<div class="selectstih" style="padding-bottom: 50px;">
    <div class="wrapper">
        <strong class="dmxstr" style="margin-top:50px;">Выбери свою стихию</strong>
        <ul>
            <?php
            /** @var Category $dmax */

            $products = Product::find()->joinWith('languages')
                ->where(['AND',  ['used' => 0 ], ['languages.code' => Yii::$app->language], ['id_category' => 13]])->all();
            if ($products !== null) {

                foreach ($products as $val )
                {

                    ?>
                    <li>
                        <a href="<?= \yii\helpers\Url::toRoute(['category/product', 'slug'=> $val->slug ]); ?>">

                            <img src="<?= $val->image; ?>" />
                            <span><?= $val->h1; ?></span>
                            <strong>от <?= $val['price']; ?> тг </strong>
                        </a>
                    </li>
            <?php
                }
            }
            ?>


        </ul>
    </div>
</div>

<script>
    $('.selectcolor a').on('click', function(){
        id = $(this).attr("id");
        $('.dmaxauto').attr('class', 'dmaxauto');
        name = id.replace(/\_/g, ' ');
        $('.dmaxauto').find('span').text(name);
        $('.dmaxauto').addClass(id);
    });
</script>
<style>
    .wrap  {
        min-height: 153px !important;
    }
</style>