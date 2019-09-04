<?php

/* @var $this \yii\web\View */
/* @var $content string */


use frontend\models\ServiceForm;
use frontend\models\TestForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\ServiceAsset;
use common\models\Category;

ServiceAsset::register($this);
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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php  echo $this->render('_menu'); ?>


    <?= $content ?>

</div>

<?php  echo $this->render('_footer'); ?>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
