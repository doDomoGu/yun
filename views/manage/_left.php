<?php \app\assets\AppAsset::addCssFile($this,'css/manage_left.css');?>
<div class="list-group">
    <a class="list-group-item active" href="/manage">
        管理中心
    </a>
    <div class="submenu">
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/news')===0?'active':''?>" href="/manage/news">
            首页新闻
        </a>
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/recruitment')===0?'active':''?>" href="/manage/recruitment">
            招聘信息
        </a>
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/position')===0?'active':''?>" href="/manage/position">
            部门/职位
        </a>
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/directory')===0?'active':''?>" href="/manage/directory">
            板块目录
        </a>
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/user')===0?'active':''?>" href="/manage/user">
            公司职员
        </a>
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/manager')===0?'active':''?>" href="/manage/manager">
            管理员设置
        </a>
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'manage/message')===0?'active':''?>" href="/manage/message">
            消息通知
        </a>
    </div>
</div>
