<?php
namespace frontend\modules\rbac\assets;

class UsersAsset extends \yii\web\AssetBundle
{
    // the alias to your assets folder in your file system
    //public $sourcePath =  '@users-assets';
    // finally your files.. 
    public $css = [
      "css/tabs.css",
      "js/datatable/css/demo_page.css",
      "js/datatable/css/demo_table.css",
      "js/data-tables/DT_bootstrap.css"
    ];
    public $js = [
      //"js/datatable/js/jquery.dataTables.js",
      "js/data-tables/DT_bootstrap.js",
      "js/dynamic_table_init.js",
      'js/multifilter/multifilter.js',
      'http://www.appelsiini.net/download/jquery.jeditable.mini.js'
    		
    ];
    // that are the dependecies, for makeing your Asset bundle work with Yii2 framework
    public $depends = [
      "yii\web\YiiAsset",
      "yii\bootstrap\BootstrapAsset",
    ];
    public function init()
    {
    	parent::init();
    	$this->sourcePath = __DIR__ ;
    }
}