<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\BaseHtml;
use yii\helpers\ArrayHelper;
?>

<?php if(Yii::$app->user->isGuest):?>

<?php else:?>
    <?/*=$this->renderPartial('//layouts/navbar')*/?>
<?php endif;?>


<?php
    //导航栏菜单项
    $navbarItems = [[
        'label' => '首页',
        'url' => ['site/index']
    ]];

    $navbarItems = ArrayHelper::merge($navbarItems,\app\components\DirFrontFunc::getNavbar());

    $navbarItems = ArrayHelper::merge($navbarItems,[[
        'label' => '管理中心*',
        'url' => ['/manage/index'],
        'active' => strpos(Yii::$app->controller->route,'manage')===0?true:false
    ]]);
/*echo "<pre>";
var_dump($navbarItems);exit;*/
?>


<?php
NavBar::begin([
    'brandLabel' => BaseHtml::img('/images/logo.png',['style'=>'width:98px;']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $navbarItems
]);

if(Yii::$app->user->isGuest){
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
                ['label' => '登录', 'url' => ['/site/login']]
        ],
    ]);
}else{
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
                [
                    'label' => '个人中心(' . Yii::$app->user->identity->username.')',
                    'url'   => ['/user/index'],
                    'active' => strpos(Yii::$app->controller->route,'user')===0?true:false
                ],
                [
                    'label' => '退出',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
}

NavBar::end();
?>