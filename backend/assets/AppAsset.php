<?php

namespace backend\assets;

use yii\web\AssetBundle;


/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/style.css',
    ];
    public $js = [
      //  'js/jquery-3.3.1.min.js',
        'js/plugins-jquery.js',
        "js/chart-init.js",
        "js/calendar.init.js",
        "js/sparkline.init.js",
        "js/morris.init.js",
        "js/datepicker.js",
        "js/sweetalert2.js",
        "js/toastr.js" ,
        "js/validation.js",
        "js/lobilist.js",
        "js/custom.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
