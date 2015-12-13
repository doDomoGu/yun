<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\BaseHtml;
use yii\helpers\ArrayHelper;

/*app\assets\AppAsset::addCssFile($this,'css/layouts/navbar2.css');*/
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
if(!yii::$app->user->isGuest){
    $item2 = [['label' => '职员资料', 'url' => '/user','options'=>['class'=>'user-item']]];
    $item2 =  ArrayHelper::merge($item2,[['label' => '消息通知', 'url' => '/message/system','options'=>['class'=>'user-item']]]);
    if($this->context->checkIsAdmin())
        $item2 = ArrayHelper::merge($item2,[['label' => '管理中心*', 'url' => '/manage','options'=>['class'=>'user-item']]]);
    $item2 = ArrayHelper::merge($item2,['<li class="divider"></li>']);
    $item2 = ArrayHelper::merge($item2,[['label' => '帮助', 'url' => '/help','options'=>['class'=>'user-item']]]);
    $item2 = ArrayHelper::merge($item2,[['label' => '退出', 'url' => '/site/logout','options'=>['class'=>'user-item']]]);
        /*'<li class="dropdown-header">Dropdown Header</li>',
        ['label' => 'Level 1 - Dropdown B', 'url' => '#'],*/

    $navbarItems = ArrayHelper::merge($navbarItems,
        [
            [
                'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>',
                'items' => $item2,
                'linkOptions'=>['style'=>'margin-left:40px;'],
                'encode'=>false
            ]]
    );
}

?>


<?php
NavBar::begin([
    'brandLabel' => BaseHtml::img('/images/songtang-united-logo.png'),
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