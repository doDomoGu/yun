<?php
    $this->title = '群组- 选择职员';
    use yii\bootstrap\BaseHtml;
    use app\components\DirFunc;
    //\app\assets\AppAsset::addJsFile($this,'js/manage-dir.js');
?>
<p>
    <h3>群组 [<b><?=$group->name?></b>] 下的职员选择</h3>
</p>
<form method="post" action="" >
<table class="table table-bordered">
    <thead>
    <tr>
        <th>--</th>
        <th>#</th>
        <!--<th>排序</th>-->
        <th>姓名</th>
        <th>职位</th>
        <th>状态</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <td scope="row"><?=\yii\helpers\Html::checkbox('uid[]',(in_array($l->id,$checked))?true:false,['value'=>$l->id])?></td>
                <th scope="row"><?=$l->id?></th>
                <!--<td><?/*=$l->ord*/?></td>-->
                <td><?=$l->name?></td>
                <td><?=\app\components\PositionFunc::getFullRoute($l->position_id)?></td>
                <td><?=$l->status==1?'启用':'<span style="color:red;">禁用</span>'?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
<button type="submit" class="btn btn-success">提交</button>
<a href="/manage/group-user?<?=$group->id?>" class="btn btn-default">返回</a>
</form>
