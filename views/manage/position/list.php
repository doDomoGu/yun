<?php
    use yii\bootstrap\BaseHtml;
    use app\components\PositionFunc;
    app\assets\AppAsset::addJsFile($this,'js/manage-position.js');
?>
        <?=BaseHtml::a('添加职位/部门（暂时不可用）',['position-add-and-edit'],['class'=>'btn btn-primary disabled'])?>
        <p></p>

        业态选择：<?=BaseHtml::dropDownList('pos-select-1',$posLvl_1?$posLvl_1->id:'',$posList_1,['encode'=>false,'id'=>'pos-select-1','prompt'=>'===请选择==='])?>
        <?php if(!empty($posList_2)):?>
        <p></p>
        地方选择：<?=BaseHtml::dropDownList('pos-select-2',$posLvl_2?$posLvl_2->id:'',$posList_2,['encode'=>false,'id'=>'pos-select-2','prompt'=>'===请选择==='])?>
        <?php endif;?>
        <p></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>排序</th>
                    <th>部门/职位名称</th>
                    <th>类型</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->ord?></td>
                    <td><?=$l->name?> <span class="badge" title="<?=PositionFunc::getFullRoute($l->id)?>">i</span></td>
                    <td><?=PositionFunc::getIsLeaf($l->is_leaf)?></td>
                    <td><?=BaseHtml::a('编辑(暂时不可用)',['','id'=>$l->id],['class'=>'btn btn-primary btn-xs disabled'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
