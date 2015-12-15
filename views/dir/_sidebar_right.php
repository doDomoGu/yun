<?php
    use app\components\PositionFunc;
    app\assets\AppAsset::addCssFile($this,'css/dir-right.css');
    $user = $this->context->user;
    $routeArr = PositionFunc::getRouteArr($user->position_id);
?>

<div class="info-heading">
    个人信息中心
</div>
<div class="info-list">
    <span class="info-list-label">姓名</span>
    <span class="info-list-txt"><?=$user->name?></span>
</div>
<div class="info-list">
    <span class="info-list-label">入职时间</span>
    <span class="info-list-txt"><?=$user->join_date?></span>
</div>
<div class="info-list">
    <span class="info-list-label">合同到期时间</span>
    <span class="info-list-txt"><?=$user->contract_date?></span>
</div>
<div class="info-list">
    <span class="info-list-label">个人所属业务平台</span>
    <span class="info-list-txt"><?=$routeArr[1]?></span>
</div>
<div class="info-list">
    <span class="info-list-label">个人所属地方公司</span>
    <span class="info-list-txt"><?=$routeArr[2]?></span>
</div>
<div class="info-list">
    <span class="info-list-label">个人所属部门</span>
    <span class="info-list-txt"><?=$routeArr[3]?></span>
</div>
<div class="info-list">
    <span class="info-list-label">个人职位</span>
    <span class="info-list-txt"><?=$routeArr[4]?></span>
</div>