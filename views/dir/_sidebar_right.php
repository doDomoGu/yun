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
        <td><?=$user->name?></td>
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
        <td><?=$position->zhize?></td>
    </tr>
</table>
