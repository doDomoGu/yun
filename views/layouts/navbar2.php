<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\BaseHtml;
use yii\helpers\ArrayHelper;

app\assets\AppAsset::addCssFile($this,'css/layouts/navbar2.css');
?>
<div class="navbar-background">
<?php
    //导航栏菜单项
    $navbarItems = [[
        'label' => '首页',
        'url' => ['site/index']
    ]];

    $navbarItems = ArrayHelper::merge($navbarItems,\app\components\DirFrontFunc::getNavbar());
?>


<?php
NavBar::begin([
    'brandLabel' => BaseHtml::img('/images/songtang-united-logo.jpg'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-default',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav pull-right'],
    'items' => $navbarItems
]);

NavBar::end();
?>
</div>