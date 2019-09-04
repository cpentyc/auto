<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\category */

$this->title = Yii::t('app', 'Update Category: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-xl-12 mb-30">
    <div class="card card-statistics mb-30">
        <div class="card-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
