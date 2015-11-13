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
    <?php echo $this->render('navbar'); /* 引入导航栏 */?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="row">
            <div class="col-lg-2">
                <?=$this->render('/dir/_left')?>
            </div>
            <div class="col-lg-10">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?=$this->render('footer')?>
<?php $this->endBody(); /* body结束标志位 */ ?>
</body>
</html>
<?php $this->endPage(); /* 页面结束标志位 */ ?>
