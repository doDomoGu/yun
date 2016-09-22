<?php
    use yii\bootstrap\BaseHtml;
    use app\components\CommonFunc;
    use app\components\PositionFunc;
    use app\components\DirFunc;
    use app\components\PermissionFunc;
    app\assets\AppAsset::addJsFile($this,'js/main/manage-group-dir-permission.js');
    app\assets\AppAsset::addCssFile($this,'css/manage-group-dir-permission.css');
?>
<h3>当前群组： 【<?=$group->name?>】</h3>
<input type="hidden" id="group_id" value="<?=$group->id?>" />

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

        <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('upload_common')?></th>
        <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('download_common')?></th>
        <!--<th>修改</th>-->
        <!--<th width="80" class="text-center"><?/*=PermissionFunc::getPermissionTypeNameCn('delete')*/?></th>-->

        <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('upload_person')?></th>
        <!--<th width="80" class="text-center"><?/*=PermissionFunc::getPermissionTypeNameCn2('download_person')*/?></th>-->
        <!--<th>修改(个人)</th>-->


        <!--<th width="80" class="text-center"><?/*=PermissionFunc::getPermissionTypeNameCn('upload_all')*/?></th>-->
        <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('download_all')?></th>


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
                    <td class="text-center"><?=BaseHtml::checkbox('pm['.$l->id.'][all]',isset($pmCheck[$l->id]) && count($pmCheck[$l->id])==4?true:false,['data-pid'=>$l->id,'class'=>'row-check'])?></td>
                    <td class="text-center real-checkbox"><?=BaseHtml::checkbox('pm['.$l->id.'][11]',isset($pmCheck[$l->id][11])?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-11'])?></td>
                    <td class="text-center real-checkbox"><?=BaseHtml::checkbox('pm['.$l->id.'][12]',isset($pmCheck[$l->id][12])?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-12'])?></td>
                    <td class="text-center real-checkbox"><?=BaseHtml::checkbox('pm['.$l->id.'][21]',isset($pmCheck[$l->id][21])?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-21'])?></td>
                    <!--<td class="text-center"><?/*=BaseHtml::checkbox('pm['.$l->id.'][22]',isset($pmCheck[$l->id][22])?true:false)*/?></td>-->
                    <!--<td class="text-center"><?/*=BaseHtml::checkbox('pm['.$l->id.'][31]',isset($pmCheck[$l->id][31])?true:false)*/?></td>-->
                    <td class="text-center real-checkbox"><?=BaseHtml::checkbox('pm['.$l->id.'][32]',isset($pmCheck[$l->id][32])?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-32'])?></td>
                <?php else:?>
                    <input type="hidden" id="p-<?=$l->id?>-childs"  value="<?=CommonFunc::array2string($l->childrenIds)?>" />
                    <td class="text-center"> -- </td>
                    <td class="text-center"><?=BaseHtml::checkbox('pmCheck['.$l->id.']','',['class'=>'column-check','id'=>'pm-'.$l->id.'-11','data-permission'=>11,'data-pid'=>$l->id])?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pmCheck['.$l->id.']','',['class'=>'column-check','id'=>'pm-'.$l->id.'-12','data-permission'=>12,'data-pid'=>$l->id])?></td>
                    <td class="text-center"><?=BaseHtml::checkbox('pmCheck['.$l->id.']','',['class'=>'column-check','id'=>'pm-'.$l->id.'-21','data-permission'=>21,'data-pid'=>$l->id])?></td>
                    <!--<td class="text-center"> -- </td>-->
                    <!--<td class="text-center"> -- </td>-->
                    <td class="text-center"><?=BaseHtml::checkbox('pmCheck['.$l->id.']','',['class'=>'column-check','id'=>'pm-'.$l->id.'-32','data-permission'=>32,'data-pid'=>$l->id])?></td>
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
