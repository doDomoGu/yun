<?php

use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);  /* 注册appAsset */
?>
<?php $this->beginPage(); /* 页面开始标志位 */ ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<?php echo $this->render('head'); /* 引入头部 */ ?>
<body>
<?php $this->beginBody(); /* body开始标志位 */ ?>

<div class="wrap">
    <?=$this->render($this->context->navbarView)/* 引入导航栏 */?>
    <?php if(yii::$app->controller->route == 'site/index'):?>
    <div id="news_list">
        <?=$this->render('/site/_news')?>
    </div>
    <?php endif;?>
    <?php if(yii::$app->controller->route == 'site/index'):?>
    <div class="container" style="padding-top:10px;">
    <?php else:?>
    <div class="container">
    <?php endif;?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?=$this->render('footer')?>
<?php $this->endBody(); /* body结束标志位 */ ?>
</body>
</html>
<?php $this->endPage(); /* 页面结束标志位 */ ?>
