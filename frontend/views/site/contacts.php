<?php
/* @var $service common\models\DealersPart */
$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="containerContact">

    <h1 id="contactH1"><?= $service->name; ?></h1>
    <span>
        <?= $service->address; ?>
    </span><br />
    <span>
        <?= Yii::t('app', 'Тел.: ').  $service->phone; ?>
    </span><br /><br /><br />
    <input type="hidden" id="lat" value="<?= $city->lat;?>">
    <input type="hidden" id="lng" value="<?= $city->lng ;?>">
    <select class="cities-select" id="citySelect">
        <?php foreach ($cities as $c) { ?>
            <option <?= ($city->id == $c->id) ? 'selected' : '';?> value="<?= $c->id;?>"><?= $c->name;?></option>
        <?php } ?>
    </select>
</div>
        <div  class="map" id="map"></div>

<script>
    function initMap() {
        lat = parseFloat(document.getElementById("lat").value);
        lng = parseFloat(document.getElementById("lng").value);
        var centr_lng = (lng-0.009);

        var center = {lat: lat, lng: centr_lng};
        var marker_loc = {lat: lat, lng: lng};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: center
        });
        var marker = new google.maps.Marker({
            position: marker_loc,
            map: map
        });
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAblHdTeXnZLcxqqb50mYDGHiqxSk4F4Ck&callback=initMap">
</script>


<?php

$script = <<< JS
    $('.cities-select').on('change', function(){
        console.log(2131321);
        url = '/contacts/';
        city = $('.cities-select').val();
        url = url + city;
        window.location = url;
    });
JS;
$this->registerJs($script);
?>

