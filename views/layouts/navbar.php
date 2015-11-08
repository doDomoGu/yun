<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\BaseHtml;
?>

<?php if(Yii::$app->user->isGuest):?>

<?php else:?>
    <?/*=$this->renderPartial('//layouts/navbar')*/?>
<?php endif;?>


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
    'items' => [
        ['label' => '首页', 'url' => ['site/index']],
        /*['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],*/
        ['label' => '管理中心', 'url' => ['/manage/index']],
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
                    'url'   => ['/user/index']
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