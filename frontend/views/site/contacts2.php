<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
$this->title = Yii::t('app', 'Региональная сеть');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content" name="top" id="dilerMap">
    <div class="mainBlock">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <h1 class="title"><?= Yii::t('app', 'Региональная сеть');?></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="style_select brand">
                            <div class="form-group field-newcarsearch-brand has-success">
                                <label class="control-label" for="newcarsearch-brand"></label>
                                <select class="cities">
                                    <?php foreach ($cities as $city) { ?>
                                        <option value="<?= $city->id?>" data-city="<?= $city->id?>" ><?= $city->name?></option>
                                    <?php } ?>
                                </select>

                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="deal_info">
                            <strong><?= $firstCity->name;?></strong>
                            <ul>
                                <?php /** @var \common\models\DealersPart $part */
                                foreach($firstCity->parts as $part) { ?>
                                    <li>
                                        <a><?= $part->name;?></a>
                                        <span><?= $part->address;?><br/>
                                            <?php foreach ($part->dealersContacts as $var) { ?>
                                                <?= $var->name;?> - <?= $var->email;?><br />
                                            <?php } ?>
                                            тел.: <?= $part->phone;?> <br/>
                                            <?php if ($part->internal != '') { echo 'вн. ' . $part->internal . '<br/>';}?>
                                            <?php if ($part->fax != '') { echo 'факс: ' . $part->fax . '<br/>';}?></span>
                                        <span><?= Yii::t('app', 'Направление деятельности');?>:</span>
                                        <ol>
                                            <?php foreach ($part->specifies as $specify) { ?>
                                                <li><?= $specify->name;?></li>
                                            <?php } ?>
                                        </ol>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="mapKz">
                            <?php foreach ($cities as $city) {
                                $current = '';
                                if ($city->id == $firstCity->id) {
                                    $current = 'map_cur';
                                }
                                echo '<a id="city'
                                    . $city->id
                                    . '" data-city="'
                                    . $city->id
                                    .  '" style="margin-left: '
                                    . $city->lng . 'px; margin-top: '
                                    . $city->lat . 'px;" class="map_point '
                                    . $current
                                    . '"><span>' . $city->name . '</span></a>';
                            } ?>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-12 text-center description">
                        <strong><?= Yii::t('app', 'Алматы');?></strong>
                        <div class="borderText">
                                    <span><a><?= Yii::t('app', 'Главный офис');?></a><br/>
                                        <?= Yii::t('app', 'г. Алматы Казахстан, 050050 ул. Рыскулова 57В');?><br/>
                                        <?= Yii::t('app', 'тел');?>.: +7 (727) 3 122 133<br/>
                                        <?= Yii::t('app', 'факс');?>: +7. (727) 3 122 131<br/>
                                    e-mail: cbc@cbc-group.kz<br/></span>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            </div>
    </div>
</div>

<?php
$this->registerJs("

		function getParts(id) {
			$.ajax({
							 url: '/site/parts',
							 data: 'city_id=' + id,
							 method: 'GET',
							 success: function(data) {
								 $('.deal_info').html(data);
							 }
						});
		}


		$('.mapKz a').click(function(e) {
			$('.mapKz').find('.map_cur').removeClass('map_cur');
			$(this).addClass('map_cur');
			$('.cities').val($(this).attr('data-city'));
			getParts($(this).attr('data-city'));
			});

			$('.cities').on('change', function(e) {
					$('.mapKz').find('.map_cur').removeClass('map_cur');
					$('.mapKz').find('#city' + $(this).val()).addClass('map_cur');
					getParts($(this).val());
			});




		");
?>
