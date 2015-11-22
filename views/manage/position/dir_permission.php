<?php
    use yii\bootstrap\BaseHtml;
    use app\components\PositionFunc;
    use app\components\DirFunc;
    app\assets\AppAsset::addJsFile($this,'js/main/manage-position-dir-permission.js');
?>
<h3>当前职位： 【<?=PositionFunc::getFullRoute($position->id)?>】</h3>
<input type="hidden" id="position_id" value="<?=$position->id?>" />

<br/>
板块选择：<?=BaseHtml::dropDownList('dir-select-1',$dirLvl_1?$dirLvl_1->id:'',$dirList_1,['encode'=>false,'id'=>'dir-select-1','prompt'=>'===请选择==='])?>
<?php if(!empty($dirList_2)):?>
    <p></p>
    目录选择：<?=BaseHtml::dropDownList('dir-select-2',$dirLvl_2?$dirLvl_2->id:'',$dirList_2,['encode'=>false,'id'=>'dir-select-2','prompt'=>'===请选择==='])?>
<?php endif;?>
<p></p>
<form id="pmForm" method="post">
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>目录</th>
        <th>类型</th>
        <th width="80" class="text-center">全选</th>
        <th width="80" class="text-center">上传</th>
        <th width="80" class="text-center">下载</th>
        <!--<th>修改</th>-->
        <th width="80" class="text-center">删除</th>
        <th width="80" class="text-center">下载<br/>(个人)</th>
        <!--<th>修改(个人)</th>-->
        <th width="80" class="text-center">删除<br/>(个人)</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th><?=$l->id?></th>
                <td><?=$l->name?> <span class="badge" title="<?=DirFunc::getFullRoute($l->id)?>">i</span></td>
                <td><?=DirFunc::getIsLeaf($l->is_leaf)?></td>
                <?php if($l->is_leaf):?>
                    <input type="hidden" name="pm[<?=$l->id?>][edit]" />
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][all]')?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][1]',isset($pmCheck[$l->id][1])?true:false)?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][2]',isset($pmCheck[$l->id][2])?true:false)?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][4]',isset($pmCheck[$l->id][4])?true:false)?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][5]',isset($pmCheck[$l->id][5])?true:false)?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][7]',isset($pmCheck[$l->id][7])?true:false)?></td>
                <?php else:?>
                    <td class="text-center"> -- </td>
                    <td class="text-center"> -- </td>
                    <td class="text-center"> -- </td>
                    <td class="text-center"> -- </td>
                    <td class="text-center"> -- </td>
                    <td class="text-center"> -- </td>
                <?php endif;?>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>
<div>
    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    <button class="btn btn-success">提交修改</button>
</div>
</form>
