<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<!--</head>
    --><?/*=$this->renderPartial('//layouts/head')*/?>
<!--    <script type="text/javascript" src="<?/*=Yii::app()->request->baseUrl*/?>/js/page/jquery.SuperSlide.2.1.1.js"></script>-->
</head>
<body>
<?php /*if(Yii::app()->user->isGuest):*/?><!--
    <?/*=$this->renderPartial('//layouts/navbar_guest')*/?>
<?php /*else:*/?>
    <?/*=$this->renderPartial('//layouts/navbar')*/?>
--><?php /*endif;*/?>
<div id="content" class="container-fluid">
    <?php /*if(Yii::$app->user->hasFlash('success') || Yii::$app->user->hasFlash('error')):*/?><!--
        <div class="row-fluid">
            <div class="span12">
                <?php /*if(Yii::app()->user->hasFlash('success')):*/?>
                    <div class="alert alert-success" style="margin:10px;">
                        <?/*=Yii::app()->user->getFlash('success')*/?>
                    </div>
                <?php /*elseif(Yii::app()->user->hasFlash('error')):*/?>
                    <div class="alert alert-danger" style="margin:10px;">
                        <?/*=Yii::app()->user->getFlash('error')*/?>
                    </div>
                <?php /*endif;*/?>
            </div>
        </div>
    --><?php /*endif;*/?>
    <div class="row-fluid" id="main_span">
        <!--<div class="col-md-9">-->
        <?=$content?>
        <!--</div>-->
        <!--<div class="col-md-3">
            <div id="sidebar_right">
            <?/*=$this->renderPartial('//site/user_right')*/?>
            <?/*=$this->renderPartial('//site/message_right')*/?>
            </div>
        </div>-->
    </div>
    <div class="clearfix"></div>
</div>
<?php /*echo $this->renderPartial('//layouts/footer');*/?>
</body>
</html>
