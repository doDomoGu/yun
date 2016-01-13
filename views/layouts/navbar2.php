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

    $navbarItems = [];

    $iconClass = 'glyphicon glyphicon-user';
    if(!yii::$app->user->isGuest){
        $navbarItems = [[
            'label' => '首页<span class="active-red"></span>',
            'url' => ['site/index'],
            'encode' => false
        ]];

        $navbarItems = ArrayHelper::merge($navbarItems,\app\components\DirFrontFunc::getNavbar());



        $item2 = [['label' => '职员资料', 'url' => '/user','options'=>['class'=>'user-item']]];
        //$item2 = ArrayHelper::merge($item2,[['label' => '每日签到', 'url' => '/user/sign','options'=>['class'=>'user-item']]]);
        $item2 = ArrayHelper::merge($item2,[['label' => '我的上传', 'url' => '/user/file','options'=>['class'=>'user-item']]]);
        $item2 = ArrayHelper::merge($item2,[['label' => '我的下载', 'url' => '/user/download','options'=>['class'=>'user-item']]]);
        $item2 = ArrayHelper::merge($item2,[['label' => '我的权限', 'url' => '/user/permission-list','options'=>['class'=>'user-item']]]);
        $item2 =  ArrayHelper::merge($item2,[['label' => '消息通知', 'url' => '/message/system','options'=>['class'=>'user-item']]]);
        if($this->context->checkIsAdmin())
            $item2 = ArrayHelper::merge($item2,[['label' => '管理中心*', 'url' => '/manage','options'=>['class'=>'user-item']]]);
        $item2 = ArrayHelper::merge($item2,[['label' => '退出', 'url' => '/site/logout','options'=>['class'=>'user-item']]]);
        $item2 = ArrayHelper::merge($item2,['<li class="divider"></li>']);
    }else{
        $iconClass = 'glyphicon glyphicon-menu-hamburger';

        $navbarItems = [[
            'label'=>'<span style="border:1px solid #ccc;padding:4px 10px;">登录</span><span class="active-red"></span>',
            'url'=>['/site/login'],
            'encode'=>false
        ]];

        //$item2 = [['label' => '登录', 'url' => '/site/login','options'=>['class'=>'user-item']]];
$item2 = [];
        /*$navbarItems = ArrayHelper::merge(
            $navbarItems,
            [
                [
                    'label'=>'<span style="border:1px solid #ccc;padding:4px 10px;">登录</span><span class="active-red"></span>',
                    'url'=>['/site/login'],
                    'encode'=>false
                ]
            ]
        );*/
    }


    $item2 = ArrayHelper::merge($item2,[['label' => '帮助中心', 'url' => '/help','options'=>['class'=>'user-item'],'linkOptions'=>['target'=>'_blank']]]);
    $item2 = ArrayHelper::merge($item2,[['label' => '版本功能', 'url' => '/version','options'=>['class'=>'user-item'],'linkOptions'=>['target'=>'_blank']]]);


    $route = Yii::$app->controller->route;
    $routeArr = explode('/',$route);
    $route1 = isset($routeArr[0]) && $routeArr[0] !=''?$routeArr[0]:'';
    $userActive = $route1 !='' && in_array($route1,['user','manage','message','help','version'])?true:false;
    $navbarItems = ArrayHelper::merge($navbarItems,
        [
            [
                'label' => '<span class="'.$iconClass.'" aria-hidden="true"></span><span class="active-red"></span>',
                'items' => $item2,
                'active' => $userActive,
                'linkOptions'=>['style'=>'margin-left:40px;'],
                'encode'=>false
            ]
        ]
    );

?>


<?php
    NavBar::begin([
        'brandLabel' => BaseHtml::img('/images/logo.png'),
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