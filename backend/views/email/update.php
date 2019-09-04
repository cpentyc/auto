<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Email */

$this->title = Yii::t('app', 'Update Email: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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