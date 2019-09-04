<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DealersPart */

$this->title = Yii::t('app', 'Update Dealers Part: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dealers Parts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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
