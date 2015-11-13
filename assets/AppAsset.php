<?php
namespace app\assets;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //导入当前页的功能js文件，注意加载顺序，这个应该最后调用  文件路径相对@web即可
    public static function addJsFile($view, $jsfile) {
        $view->registerJsFile($jsfile, ['depends' => 'app\assets\AppAsset']);
    }

    //导入当前页的功能js代码，注意加载顺序，这个应该最后调用  文件路径相对@web即可
    public static function addJs($view, $jsString) {
        $view->registerJs($jsString, ['depends' => 'app\assets\AppAsset']);
    }

    //导入当前页的样式css文件，注意加载顺序，这个应该最后调用  文件路径相对@web即可
    public static function addCssFile($view, $cssfile) {
        $view->registerCssFile($cssfile, ['depends' => 'app\assets\AppAsset']);
    }

    //导入编辑器
    /*public static function addCkeditor($view) {
        $view->registerJsFile('/public/js/utility/ckeditor/ckeditor.js', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);
    }*/
}
