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
        //'css/site.css',
        //'css/bootstrap.min.css',
        'css/style.min.css',
        'css/retina.min.css'
    ];
    public $js = [
        'js/jquery.noty.min.js',
        'js/jquery-migrate-1.2.1.min.js', 
        'js/core.min.js',
        'js/common.js',
        //'js/bootstrap.min.js',
        //'js/jquery-2.1.0.min.js',        
        //'js/jquery.dataTables.min.js',
        //'js/dataTables.bootstrap.min.js',               
        //'js/jquery-ui-1.10.3.custom.min.js',        
        //'js/custom.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
