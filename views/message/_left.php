<?php \app\assets\AppAsset::addCssFile($this,'css/message-left.css');?>
<div class="list-group">
    <a class="list-group-item active" href="/message">
        消息通知
    </a>
    <div class="submenu">
        <a class="list-group-item <?=strpos(Yii::$app->controller->route,'message/system')===0 || !isset($this->params['messageType']) ||  $this->params['messageType']=='system'?'active':''?>" href="/message/system">
            系统通知
        </a>
        <button class="disabled list-group-item <?=strpos(Yii::$app->controller->route,'manage/recruitment')===0?'active':''?>" href="/manage/recruitment">
            收件箱
        </button>
        <button class="disabled list-group-item <?=strpos(Yii::$app->controller->route,'manage/position')===0?'active':''?>" href="/manage/position">
            发件箱
        </button>
    </div>
</div>
