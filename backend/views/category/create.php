<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\category */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
