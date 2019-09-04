<strong><?= $city->name;?></strong>
<ul>
    <?php foreach($city->parts as $part) { ?>
        <li>
            <a><?= $part->name;?></a>
            <span><?= $part->address;?><br/>
                <?php foreach ($part->dealersContacts as $var) { ?>
                    <?= $var->name;?> - <?= $var->email;?><br />
                <?php } ?>
                <?= Yii::t('app', 'тел');?>.: <?= $part->phone;?> <br/>
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
