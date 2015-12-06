<?php

use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Html;

AppAsset::register($this);  /* 注册appAsset */
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
            <li role="presentation" class="<?=yii::$app->controller->action->id=='index'?'active':''?>"><?=Html::a('登录',['/help'])?></li>
            <li role="presentation" class="<?=yii::$app->controller->action->id=='index2'?'active':''?>"><?=Html::a('首页结构',['/help/index2'])?></li>
        </ul>
        <?= $content ?>
    </div>
</div>
<?=$this->render('footer')?>
<?php $this->endBody(); /* body结束标志位 */ ?>
</body>
</html>
<?php $this->endPage(); /* 页面结束标志位 */ ?>
