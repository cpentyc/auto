<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Құттықтаймыз!</h1>

        <p class="lead">Сіз Yii-қуатпен жұмыс жасаған қосымшаңызды сәтті құрдыңыз.</p>

        <?= common\modules\languages\widgets\ListWidget::widget() ?>
    </div>

</div>
