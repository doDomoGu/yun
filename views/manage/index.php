<?php
    use yii\bootstrap\BaseHtml;
?>

<table class="table table-bordered">
    <tbody>
    <tr>
        <td>
            <h3>首页新闻 <?=BaseHtml::a($newsCount,['manage/news'])?> 条</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h3>招聘信息 <?=BaseHtml::a($recruitmentCount,['manage/recruitment'])?> 条</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h3>部门/职位 <?=BaseHtml::a($positionCount,['manage/position'])?> 个</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h3>职员 <?=BaseHtml::a($userCount,['manage/user'])?> 位 ( 共 <?=$userCountAll?> 位， <?=$userCountDisable?> 位禁用 )</h3>
        </td>
    </tr>
    </tbody>
</table>
