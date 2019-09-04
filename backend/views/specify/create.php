<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DealersSpecify */

$this->title = Yii::t('app', 'Create Dealers Specify');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dealers Specifies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealers-specify-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
