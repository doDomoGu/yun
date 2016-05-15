<?php \app\assets\AppAsset::addCssFile($this,'css/manage-left.css');?>
<div class="list-group">
    <a class="list-group-item active" href="/manage">
        管理中心
    </a>
    <div class="submenu">
        <?php $route = Yii::$app->controller->route;?>
        <?php if($this->context->checkIsSuperAdmin()):?>
            <a class="list-group-item <?=strpos($route,'manage/news')===0?'active':''?>" href="/manage/news">
                首页新闻
            </a>
            <a class="list-group-item <?=strpos($route,'manage/recruitment')===0?'active':''?>" href="/manage/recruitment">
                招聘信息
            </a>
            <a class="list-group-item <?=strpos($route,'manage/position')===0?'active':''?>" href="/manage/position">
                部门/职位
            </a>
            <a class="list-group-item <?=strpos($route,'manage/dir')===0?'active':''?>" href="/manage/dir">
                板块目录
            </a>
            <a class="list-group-item <?=strpos($route,'manage/file')===0?'active':''?>" href="/manage/file">
                文件列表
            </a>
            <a class="list-group-item <?=strpos($route,'manage/user')===0 && strpos($route,'manage/user-sign')!==0?'active':''?>" href="/manage/user">
                公司职员
            </a>
            <a class="list-group-item <?=strpos($route,'manage/admin')===0?'active':''?>" href="/manage/admin">
                管理员授权
            </a>
            <a class="list-group-item <?=strpos($route,'manage/message')===0?'active':''?>" href="/manage/message">
                消息通知
            </a>
            <a class="list-group-item <?=strpos($route,'manage/user-sign')===0?'active':''?>" href="/manage/user-sign">
                职员签到
            </a>
        <?php elseif($this->context->checkIsUserAdmin()):?>
            <button class="list-group-item disabled">首页新闻</button>
            <button class="list-group-item disabled">招聘信息</button>
            <button class="list-group-item disabled">部门/职位</button>
            <button class="list-group-item disabled">板块目录</button>
            <button class="list-group-item disabled">文件列表</button>
            <a class="list-group-item <?=strpos($route,'manage/user')===0?'active':''?>" href="/manage/user">
                公司职员
            </a>
            <button class="list-group-item disabled">管理员授权</button>
            <button class="list-group-item disabled">消息通知</button>
            <button class="list-group-item disabled">职员签到</button>
        <?php endif;?>

    </div>
</div>

<div class="text-center">
    <a href="/manage/help" >帮助|help?</a>
</div>
