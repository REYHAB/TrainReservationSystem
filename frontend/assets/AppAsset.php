<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'inspinia/css/bootstrap.min.css',
        'inspinia/font-awesome/css/font-awesome.css',
        'inspinia/css/plugins/toastr/toastr.min.css',
        'inspinia/js/plugins/gritter/jquery.gritter.css',
        'inspinia/css/plugins/morris/morris-0.4.3.min.css',
        'inspinia/css/animate.css',
        'inspinia/css/style.css',
        "inspinia/css/plugins/dataTables/datatables.min.css",



    ];
    public $js = [

        // "inspinia/js/jquery-2.1.1.js",
        "inspinia/js/bootstrap.min.js",
        "inspinia/js/plugins/metisMenu/jquery.metisMenu.js",
        "inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js",
        "inspinia/js/plugins/flot/jquery.flot.js",
        "inspinia/js/plugins/flot/jquery.flot.tooltip.min.js",
        "inspinia/js/plugins/flot/jquery.flot.spline.js",
        "inspinia/js/plugins/dataTables/datatables.min.js",
        "inspinia/js/plugins/flot/jquery.flot.resize.js",
        "inspinia/js/plugins/flot/jquery.flot.pie.js",
        "inspinia/js/plugins/peity/jquery.peity.min.js",
        "inspinia/js/demo/peity-demo.js",
        "inspinia/js/inspinia.js",
        "inspinia/js/plugins/pace/pace.min.js",
        "inspinia/js/plugins/jquery-ui/jquery-ui.min.js",
        "inspinia/js/plugins/gritter/jquery.gritter.min.js",
        "inspinia/js/plugins/sparkline/jquery.sparkline.min.js",
        "inspinia/js/demo/sparkline-demo.js",
        "inspinia/js/plugins/chartJs/Chart.min.js",
        "inspinia/js/plugins/toastr/toastr.min.js",
        "inspinia/js/plugins/flot/jquery.flot.symbol.js",
        "inspinia/js/plugins/flot/curvedLines.js",
        "inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js",
        "inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js",






    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
