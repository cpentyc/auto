<?php
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\Category;

NavBar::begin([
    'brandLabel' => Html::img('/images/logo.png', ['class' => 'logoImage']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar  navbar-default navbar-fixed-top',
        'role' => 'navigation',
        'id' => 'main-menu',
    ],
]);

$categorys = Category::getCategory();

$modelMenu = [];
/** @var Category $category */
foreach ($categorys as $category){
    $modelMenu[] =  ['label' => $category->name, 'url' => ['/category/view', 'slug' => $category->slug]];
}
$modelMenu[] =  ['label' => 'D-MAX', 'url' => ['/site/landing']];
$loaders =  \common\models\Product::find()->where(['id_category' => 12])->all();

$loaderMenu = [];
/** @var \common\models\Product $loader */
foreach ($loaders as $loader){
    $loaderMenu[] =  ['label' => $loader->h1, 'url' => ['category/product', 'slug'=> $loader->slug ]];
}
$menuItems = [

    ['label' => Yii::t('app', 'Модели'), 'items' => $modelMenu, 'options'=>['class'=>'model-item']],
    ['label' => Yii::t('app', 'Погрузчики'), 'items' => $loaderMenu, 'options'=>['class'=>'pogryzchik-item']],
    ['label' => Yii::t('app', 'Надстройки '), 'url' => ['/site/services']],
    ['label' => Yii::t('app', 'Сервис '), 'url' => ['/site/service-page']],
    ['label' => Yii::t('app', 'Б/У '), 'url' => ['/site/used']],
    ['label' => Yii::t('app', 'Услуги'), 'items' => [
        ['label' => Yii::t('app', 'Страхование '), 'url' => ['/news/page-view', 'slug' => 'insurance']],
        ['label' => Yii::t('app', 'Тест-драйв'), 'url' => ['/news/page-view', 'slug' => 'test-drive']],
        ['label' => Yii::t('app', 'Кредитование '), 'url' => ['/news/page-view', 'slug' => 'crediting']],
        ['label' => Yii::t('app', 'Выкуп автомобиля'), 'url' => ['/news/page-view', 'slug' => 'auto-registration']],
    ], 'options'=>['class'=>'services-item']],
    ['label' => Yii::t('app', 'Контакты '), 'url' => ['/site/contacts']],
    ['label' => Yii::t('app', Yii::$app->language ), 'items' => [
        ['label' => Yii::t('app', 'ru '), 'url' => ['languages/default/index', 'lang' => 'ru']],
        ['label' => Yii::t('app', 'kz'), 'url' => ['languages/default/index', 'lang' => 'kz']],
        ['label' => Yii::t('app', 'eng '), 'url' => ['languages/default/index', 'lang' => 'en']],
    ], 'options'=>['class'=>'lang-item lang-item-'.Yii::$app->language]],
    ['label' => Yii::t('app', '+7 (727) 3 122 123 <br /><span>ежедневно с 8:00 до 21:00</span> '), 'options' => ['id' => 'menuTelephone']],
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left', ],
    'items' => $menuItems,
    'encodeLabels' => false,
]);

NavBar::end();
?>