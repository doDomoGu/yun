<?php \app\assets\AppAsset::addCssFile($this,'css/manage_left.css');?>
<div class="list-group">
    <a class="list-group-item active" href="/manage">
        管理中心
    </a>
    <div class="submenu">
        <a class="list-group-item <?=substr(Yii::$app->controller->route,0,11)==='manage/news'?'active':''?>" href="/manage/news">
            首页新闻
        </a>
        <a class="list-group-item <?=substr(Yii::$app->controller->route,0,18)==='manage/recruitment'?'active':''?>" href="/manage/recruitment">
            招聘信息
        </a>
        <a class="list-group-item <?=substr(Yii::$app->controller->route,0,18)==='manage/recruitment3'?'active':''?>" href="/manage/recruitment">
            招聘信息2
        </a>
        <a class="list-group-item <?=substr(Yii::$app->controller->route,0,18)==='manage/recruitment4'?'active':''?>" href="/manage/recruitment">
            招聘信息3
        </a>
        <a class="list-group-item <?=substr(Yii::$app->controller->route,0,18)==='manage/recruitment5'?'active':''?>" href="/manage/recruitment">
            招聘信息4
        </a>
    </div>
</div>
