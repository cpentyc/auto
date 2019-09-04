<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">




    <!--=================================
     header start-->

    <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <!-- logo -->
        <div class="text-left navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo-white.png" alt="" ></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-icon-light.png" alt=""></a>
        </div>
        <!-- Top bar left -->
        <ul class="nav navbar-nav mr-auto">
            <li class="nav-item">
                <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
            </li>
        </ul>
        <!-- top bar right -->
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item fullscreen">
                <a id="btnFullscreen" href="#" class="nav-link" ><i class="ti-fullscreen"></i></a>
            </li>


            <li class="nav-item dropdown mr-30">

                    <a class="dropdown-item" href="<?= Url::toRoute(['site/logout']) ?>"><i class="text-danger ti-unlock"></i>Выйти</a>

            </li>
        </ul>
    </nav>

    <!--=================================
     header End-->

    <!--=================================
     Main content -->

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar start-->
            <div class="side-menu-fixed">
                <div class="scrollbar side-menu-bg">
                    <ul class="nav navbar-nav side-menu" id="sidebarnav">


                        <li class="<?= ( Yii::$app->controller->id== 'category'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Категории</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'category/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['category/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'category/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['category/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'product'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#product">
                                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Продукты</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="product" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'product/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['product/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'product/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['product/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'news'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#news">
                                <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Новости</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="news" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'news/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['news/index']) ?>">Все</a> </li>
                                <li> <a href="<?= Url::toRoute(['news/index', 'type' => \common\models\News::TYPE_NEWS]) ?>">Новости</a> </li>
                                <li> <a href="<?= Url::toRoute(['news/index', 'type' => \common\models\News::TYPE_STOCK]) ?>">Акции</a> </li>
                                <li> <a href="<?= Url::toRoute(['news/index', 'type' => \common\models\News::TYPE_PAGE]) ?>">Страницы</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'news/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['news/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'slider'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#slider">
                                <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Слайды</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="slider" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'slider/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['slider/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'slider/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['slider/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'dealers-city'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dealers-city">
                                <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Города</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="dealers-city" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'dealers-city/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['dealers-city/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'dealers-city/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['dealers-city/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'dealers-part'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dealers-part">
                                <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Дилеры</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="dealers-part" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'dealers-part/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['dealers-part/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'dealers-part/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['dealers-part/create']) ?>">Добавить</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'specify/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['specify/index']) ?>">Спецмализации</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'email'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#email-part">
                                <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Email</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="email-part" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'email/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['email/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'email/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['email/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                        <li class="<?= ( Yii::$app->controller->id== 'text'? "active" : ""); ?>">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#text-part">
                                <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Text</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                            </a>
                            <ul id="text-part" class="collapse" data-parent="#sidebarnav">
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'text/index'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['text/index']) ?>">Просмотр</a> </li>
                                <li class="<?= ( Yii::$app->controller->id.'/'.Yii::$app->controller->action->id== 'text/create'? "active" : ""); ?>"> <a href="<?= Url::toRoute(['text/create']) ?>">Добавить</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Left Sidebar End-->

            <!--=================================
           wrapper -->

            <div class="content-wrapper">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="mb-0"> <?= $this->title; ?></h4>
                        </div>
                        <div class="col-sm-6">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'homeLink' =>   [  'label' => 'Главная', 'url' => ['site/index'], 'class' => 'breadcrumb-item' ],
                                'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                                'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                                'tag' => 'ol',
                                'options' => ['class' => 'breadcrumb  pt-0 pr-0 float-left float-sm-right'],
                            ]) ?>
                        </div>
                    </div>
                </div>
                <!-- widgets -->
                <div class="row">
                    <?= $content ?>
                </div>


                <footer class="p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center text-md-left">
                                <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="text-center text-md-right">
                                <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
                                <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
                                <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div> <!-- main content  end-->
</div> <!--  wrapper end-->




<script>var plugin_path = 'js/';</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
