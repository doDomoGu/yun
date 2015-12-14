<?php

    use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

    AppAsset::register($this);  /* 注册appAsset */

    app\assets\AppAsset::addCssFile($this,'css/layouts/dir.css');
    if($this->params['dir_id']==5){
        app\assets\AppAsset::addCssFile($this,'css/dir-study.css');
    }
?>
<?php $this->beginPage(); /* 页面开始标志位 */ ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<?php echo $this->render('head'); /* 引入头部 */ ?>
<body>
<?php $this->beginBody(); /* body开始标志位 */ ?>


<div class="wrap">
    <?php echo $this->render($this->context->navbarView); /* 引入导航栏 */?>
    <div class="container" style="padding-top:85px;">
        <div id="dir-sidebar">
            <?=$this->render('/dir/_left',['dir_id'=>$this->params['dir_id']])?>
        </div>
        <div id="dir-main" class="<?=$this->params['dir_id']==5?'dir-study':''?>">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
        <?php if($this->params['dir_id']==5):?>
        <?=$this->render('/dir/_rank_download')?>
        <?php else:?>
        <div id="dir-sidebar-right">
        <?=$this->render('/dir/_sidebar_right')?>
        </div>
        <?php endif;?>
    </div>
    <div class="clearfix"></div>
</div>
<?=$this->render('footer')?>
<?php $this->endBody(); /* body结束标志位 */ ?>
</body>
</html>
<?php $this->endPage(); /* 页面结束标志位 */ ?>
