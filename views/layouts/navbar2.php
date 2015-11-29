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
        'label' => '首页<span class="active-red"></span>',
        'url' => ['site/index'],
        'encode' => false
    ]];

    $navbarItems = ArrayHelper::merge($navbarItems,\app\components\DirFrontFunc::getNavbar());
if(!yii::$app->user->isGuest)
    $navbarItems = ArrayHelper::merge($navbarItems,
        [
        [
            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>',
            'items' => [
                ['label' => '资料', 'url' => '/user'],
                '<li class="divider"></li>',
                ['label' => '退出', 'url' => '/site/logout'],
                /*'<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Level 1 - Dropdown B', 'url' => '#'],*/
            ],
            'linkOptions'=>['style'=>'margin-left:40px;'],
            'encode'=>false
        ]]
    );
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