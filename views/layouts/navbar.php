<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>

<?php if(Yii::$app->user->isGuest):?>

<?php else:?>
    <?/*=$this->renderPartial('//layouts/navbar')*/?>
<?php endif;?>


<?php
NavBar::begin([
    'brandLabel' => 'LOGO',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        ['label' => '首页', 'url' => ['site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ]
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
                    'url'   => ['/user']
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