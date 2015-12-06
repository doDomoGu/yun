<?php

use app\assets\AppAsset;
use yii\bootstrap\Html;

AppAsset::register($this);  /* 注册appAsset */


app\assets\AppAsset::addCssFile($this,'css/help-index.css');

?>
<?php $this->beginPage(); /* 页面开始标志位 */ ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<?php echo $this->render('head'); /* 引入头部 */ ?>
<body>
<?php $this->beginBody(); /* body开始标志位 */ ?>


<div class="wrap">
    <?php echo $this->render($this->context->navbarView); /* 引入导航栏 */?>
    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?=yii::$app->request->get('index',1)==1?'active':''?>"><?=Html::a('登录',['/help'])?></li>
            <li role="presentation" class="<?=yii::$app->request->get('index',1)==2?'active':''?>"><?=Html::a('头部导航',['/help?index=2'])?></li>
            <li role="presentation" class="<?=yii::$app->request->get('index',1)==3?'active':''?>"><?=Html::a('首页',['/help?index=3'])?></li>
            <li role="presentation" class="<?=yii::$app->request->get('index',1)==4?'active':''?>"><?=Html::a('板块目录',['/help?index=4'])?></li>
        </ul>
        <?= $content ?>
    </div>
</div>
<?=$this->render('footer')?>
<?php $this->endBody(); /* body结束标志位 */ ?>
</body>
</html>
<?php $this->endPage(); /* 页面结束标志位 */ ?>
