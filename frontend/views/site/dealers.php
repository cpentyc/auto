<?php
$this->title = 'Филиалы дилеров CBC-Parts.kz';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Грузовые запчасти для вашего авто от CBC-Parts.kz в 19 городах Казахстана. Адреса и телефоны филиалов. Станьте дилером автозапчастей!'
]);
?>
<div class="dealers_map">
    <div class="wrapper">
        <div class="m_wrap">
            <h1 class="title">Филиалы</h1>
            <div class="left_menu">
                <div class="style_select brand">
                    <div class="form-group field-newcarsearch-brand has-success">
                        <label class="control-label" for="newcarsearch-brand"></label>
                        <select class="cities">

                            <?php /** @var \common\models\DealersCity $city */
                            foreach ($cities as $city) { ?>
                                <option value="<?= $city->id?>" data-city="<?= $city->id?>" ><?= $city->name?></option>
                            <?php } ?>
                        </select>

                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="deal_info">
                    <strong><?= $firstCity->name;?></strong>
                    <ul>
                        <?php foreach($firstCity->parts as $part) { ?>
                            <li>
                                <a><?= $part->name;?></a>
                                <span><?= $part->address;?><br/>
	тел.: <?= $part->phone;?> <br/>

                                    <?php if ($part->fax != '') { echo 'факс: ' . $part->fax . '<br/>';}?></span>
                                <?php /* ?>
								<span>Направление деятельности:</span>
								<ol>
									<?php foreach ($part->specifies as $specify) { ?>
										<li><?= $specify->name;?></li>
									<?php } ?>
								</ol>
                                <?php */ ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="right_map">
                <!--<a style="    margin-left: 595px; margin-top: 180px;" class="map_point"><span>Караганда</span></a>

                <a  style="    margin-left: 475px; margin-top: 300px;" class="map_point map_cur"><span>Алматы</span></a> -->
                <?php foreach ($cities as $city) {
                    $current = '';
                    if ($city->id == $firstCity->id) {
                        $current = 'map_cur';
                    }
                    echo '<a id="city' . $city->id . '" data-city="' . $city->id .  '" style="margin-left: ' . $city->lng . 'px; margin-top: ' . $city->lat . 'px;" class="map_point ' . $current . '"><span>' . $city->name . '</span></a>';
                } ?>

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


		$('.right_map a').click(function(e) {
			$('.right_map').find('.map_cur').removeClass('map_cur');
			$(this).addClass('map_cur');
			$('.cities').val($(this).attr('data-city'));
			getParts($(this).attr('data-city'));
			});

			$('.cities').on('change', function(e) {
					$('.right_map').find('.map_cur').removeClass('map_cur');
					$('.right_map').find('#city' + $(this).val()).addClass('map_cur');
					getParts($(this).val());
			});




		");
?>
