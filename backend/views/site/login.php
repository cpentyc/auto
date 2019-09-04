<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url(images/login-bg.jpg);" >
    <div class="container">
        <div class="row justify-content-center no-gutters vertical-align">
            <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(images/login-inner-bg.jpg);">
                <div class="login-fancy">
                    <h2 class="text-white mb-20">Привет админ!</h2>
                    <p class="mb-20 text-white">Если забыл пароль попробуй qwerty или дату рождения.</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 bg-dark">
                <div class="login-fancy pb-40 clearfix">
                    <h3 class="mb-30">Вход в админку</h3>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


                    <div class="section-field mb-20">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="section-field mb-20">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <div class="section-field">

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    </div>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>