<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AnyText */

$this->title = Yii::t('app', 'Create Any Text');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Any Texts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xl-12 mb-30">
    <div class="card card-statistics mb-30">
        <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
