<?php

    use yii\bootstrap\Html;
    app\assets\AppAsset::addCssFile($this,'css/manage-help.css');
?>
    <ul class="nav nav-tabs">
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==1?'active':''?>"><?=Html::a('首页新闻',['/manage/help'])?></li>
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==2?'active':''?>"><?=Html::a('消息通知',['/manage/help?index=2'])?></li>
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==3?'active':''?>"><?=Html::a('部门/职位',['/manage/help?index=3'])?></li>
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==4?'active':''?>"><?=Html::a('板块目录',['/manage/help?index=4'])?></li>
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==5?'active':''?>"><?=Html::a('公司职员',['/manage/help?index=5'])?></li>
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==6?'active':''?>"><?=Html::a('管理员授权',['/manage/help?index=6'])?></li>
        <li role="presentation" class="<?=yii::$app->request->get('index',1)==7?'active':''?>"><?=Html::a('消息通知',['/manage/help?index=7'])?></li>
    </ul>