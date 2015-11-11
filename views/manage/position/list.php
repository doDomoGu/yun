<?php

    use yii\bootstrap\BaseHtml;
    use app\components\PositionFunc;
?>
        <?=BaseHtml::a('添加职位/部门',['position-add-and-edit'],['class'=>'btn btn-primary'])?>
        <p></p>

        业态选择：<?=BaseHtml::dropDownList('select-1',$posLvl_1->id,$posList_1)?>
        <?php if(!empty($posList_2)):?>
        <p></p>
        地方选择：<?=BaseHtml::dropDownList('select-2',$posLvl_2->id,$posList_2,['encode'=>false])?>
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
                    <td><?=$l->name?></td>
                    <td><?=PositionFunc::getIsLeaf($l->is_leaf)?></td>
                    <td><?=BaseHtml::a('编辑',['news-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
