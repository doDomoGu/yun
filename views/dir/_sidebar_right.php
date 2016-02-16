<?php
    use app\components\PositionFunc;
    app\assets\AppAsset::addCssFile($this,'css/dir-right.css');
    $user = $this->context->user;
    $position = $this->context->position;
    $routeArr = PositionFunc::getRouteArr($user->position_id);
?>
<table id="right-info-table">
    <tr>
        <th colspan="2">个人信息中心</th>
    </tr>
    <tr>
        <td>姓名</td>
        <td><?=$user->name?><?=$user->name?><?=$user->name?><?=$user->name?><?=$user->name?><?=$user->name?><?=$user->name?><?=$user->name?></td>
    </tr>
    <tr>
        <td>入职时间</td>
        <td><?=$user->join_date?></td>
    </tr>
    <tr>
        <td>合同到期时间</td>
        <td><?=$user->contract_date?></td>
    </tr>
    <tr>
        <td>个人所属业务平台</td>
        <td><?=$routeArr[1]?></td>
    </tr>
    <tr>
        <td>个人所属地方公司</td>
        <td><?=$routeArr[2]?></td>
    </tr>
    <tr>
        <td>个人所属部门</td>
        <td><?=$routeArr[3]?></td>
    </tr>
    <tr>
        <td>个人职位</td>
        <td><?=$routeArr[4]?></td>
    </tr>
    <tr>
        <td>个人岗位说明</td>
        <td><?=$position->shuoming?></td>
    </tr>
    <tr>
        <td>个人岗位职权</td>
        <td><?=$position->zhiquan?></td>
    </tr>
    <tr>
        <td>个人岗位职责</td>
        <td><?=$position->zhize?>个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责个人岗位职责</td>
    </tr>
</table>
<!--<br/>

<div class="right-info">
    <div class="info-heading">
        个人信息中心
    </div>
    <div class="info-list">
        <span class="info-list-label">姓名</span>
        <span class="info-list-txt"><?/*=$user->name*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">入职时间</span>
        <span class="info-list-txt"><?/*=$user->join_date*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">合同到期时间</span>
        <span class="info-list-txt"><?/*=$user->contract_date*/?>222222222222222222222222</span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人所属业务平台</span>
        <span class="info-list-txt"><?/*=$routeArr[1]*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人所属地方公司</span>
        <span class="info-list-txt"><?/*=$routeArr[2]*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人所属部门</span>
        <span class="info-list-txt"><?/*=$routeArr[3]*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人职位</span>
        <span class="info-list-txt"><?/*=$routeArr[4]*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人岗位说明</span>
        <span class="info-list-txt"><?/*=$position->shuoming*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人岗位职权</span>
        <span class="info-list-txt"><?/*=$position->zhiquan*/?></span>
    </div>
    <div class="info-list">
        <span class="info-list-label">个人岗位职责</span>
        <span class="info-list-txt"><?/*=$position->zhize*/?></span>
    </div>
</div>-->