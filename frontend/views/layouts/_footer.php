<?php
use common\models\Category;
use common\models\DealersCity;
use common\widgets\Text;
use frontend\models\ServiceForm;
use frontend\models\TestForm;
use frontend\models\CallForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<footer>
    <div class="wrapper">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <h3 class="footitle"><?= Yii::t('app', 'Разделы'); ?></h3>
                    <ul class="foomenu">
                        <li><?= Html::a(Yii::t('app', '- Главная'), ['/site/index']); ?></li>
                        <li><?= Html::a(Yii::t('app', '- Каталог'), ['/category/index']); ?></li>
                        <li><?= Html::a(Yii::t('app', '- Надстройки'), ['/site/services']); ?></li>
                        <li><?= Html::a(Yii::t('app', '- Сервис'), ['/news/page-view', 'slug' => 'service']); ?></li>
                    </ul>

                </div>
                <div class="col-lg-2 col-md-2">
                    <h3 class="footitle"><?= Yii::t('app', 'Модели'); ?></h3>
                    <?php
                        $categorys = Category::getCategory();
                    ?>
                    <ul class="foomenu">
                        <?php
                            foreach ($categorys as $category){
                                echo  "<li>".Html::a("- ".$category->name, ['/category/view', 'slug' => $category->slug] )."</li>";
                            }
                        ?>

                    </ul>
                </div>
                <div class="col-lg-2 col-md-2">
                    <h3 class="footitle"><?= Yii::t('app', 'Связь'); ?></h3>
                    <ul class="foomenu">
                        <li><?= Html::a(Yii::t('app', '- Обратная связь'), ['/site/contact']); ?></li>
                        <li><?= Html::a(Yii::t('app', '- Контакты'), ['/site/contacts']); ?></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h3 class="footitle"><?= Yii::t('app', 'Подпишитесь!'); ?></h3>
                    <ul class="foomenu" style="margin-top: 0;">
                        <li ><?= Yii::t('app', 'Будте вкурсе новостей и скидок'); ?></li>
                        <li style="margin-top: 30px;">

                            <?php $form = ActiveForm::begin(['id' => 'email-form', 'action' => 'site/subscribe']); ?>
                            <?php $model = new \common\models\Email(); ?>
                            <?= $form->field($model, 'email')->input('email',
                                ['placeholder' => Yii::t('app', 'ВАШ E-MAIL')])->label(false); ?>


                                <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn  emailSubmit', 'name' => 'contact-button']) ?>


                            <?php ActiveForm::end(); ?>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h3 class="footitle"><?= Yii::t('app', 'О нас'); ?></h3>
                    <ul class="contacts" style="margin-top: 0;">
                        <li>
                            <?= Text::widget(['name' => 'footer_about']);?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="wrap">
        <div class="container footerBottom">
           <?= Text::widget(['name' => 'footer']);?>
        </div>
    </div>

</footer>

<?php
Modal::begin([
    'header' => Yii::t('app', 'Запись на сервис'),
    'toggleButton' => [
        'label' => 'click me',
        'tag' => 'button',
        'class' => 'btn btn-success hideButton',
    ],
    'id' => 'modalService',
]);
$items = ArrayHelper::map( DealersCity::find()->orderBy('sort_id')->all()  ,'name' ,'name');
?>
<?php $form = ActiveForm::begin(['id' => 'contact-form', 'action' => 'site/service']); ?>
<?php $model = new ServiceForm(); ?>
<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'phone') ?>

<?= $form->field($model, 'mark') ?>
<?= $form->field($model, 'city')->dropDownList($items) ?>
<?= $form->field($model, 'year') ?>
<?= $form->field($model, 'service')->dropDownList([
    'Ремонт двигателя',
    'Ремонт КПП, ведущего моста',
    'Ремонт электрооборудования автомобиля',
    'Ремонт пневмостистемы',
    'Ремонт тормозной системы автомобиля и прицепа',
    'Комплексная диагностика грузовых автомобилей',
    'Ремонт топливной системы',
    'Ремонт холодильного оборудования',
    'Ремонт погрузчиков',
    'Другое'
]) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary modalSubmit', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>



<?php
Modal::begin([
    'header' =>Yii::t('app', 'Запись на тест драйв'),
    'toggleButton' => [
        'label' => 'click me',
        'tag' => 'button',
        'class' => 'btn btn-success hideButton',
    ],
    'id' => 'modalTest',
]);


?>
<?php $form = ActiveForm::begin(['id' => 'contact-form', 'action' => 'site/test']); ?>
<?php $model = new TestForm(); ?>
<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'phone') ?>
<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'mark') ?>

<?= $form->field($model, 'city')->dropDownList($items) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary modalSubmit', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>


<?php
Modal::begin([
    'header' =>Yii::t('app', 'Обратный звонок'),
    'toggleButton' => [
        'label' => 'click me',
        'tag' => 'button',
        'class' => 'btn btn-success hideButton',
    ],
    'id' => 'modalCall',
]);
?>
<?php $form = ActiveForm::begin(['id' => 'contact-form', 'action' => 'site/call']); ?>
<?php $model = new CallForm(); ?>
<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'phone') ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary modalSubmit', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>
