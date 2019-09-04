<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DealersCity */

$this->title = Yii::t('app', 'Create Dealers City');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dealers Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
