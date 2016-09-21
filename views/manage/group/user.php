<?php
    $this->title = '群组职员';
    use yii\bootstrap\BaseHtml;
    use app\components\DirFunc;
    //\app\assets\AppAsset::addJsFile($this,'js/manage-dir.js');
?>
<p>
    <h3>群组 [<b><?=$group->name?></b>] 下的职员列表</h3>
    <a href="group-user-select" class="btn btn-primary">选择职员</a>
</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <!--<th>排序</th>-->
        <th>姓名</th>
        <th>职位</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <!--<td><?/*=$l->ord*/?></td>-->
                <td><?=$l->name?></td>
                <td><?=\app\components\PositionFunc::getFullRoute($l->position_id)?></td>
                <td><?=$l->status==1?'启用':'禁用'?></td>
                <td>
                    <?/*=BaseHtml::a('编辑',['group-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])*/?><!--
                    --><?/*=BaseHtml::a('职员列表',['group-user','id'=>$l->id],['class'=>'btn btn-success btn-xs'])*/?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>
