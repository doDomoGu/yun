<?php
    use yii\bootstrap\BaseHtml;
    use app\components\PositionFunc;
    app\assets\AppAsset::addJsFile($this,'js/manage-position.js');
?>
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
                    <td>
                        <?=BaseHtml::a('编辑',['position-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?>
                        <?=BaseHtml::button('查看职员',['class'=>'btn btn-success btn-xs viewUserBtn','p_id'=>$l->id])?>
                        <?php if($l->is_leaf):?>
                            <?=BaseHtml::a('目录权限',['position-dir-permission','position_id'=>$l->id],['class'=>'btn btn-warning btn-xs'])?>
                        <?php else:?>
                            <?=BaseHtml::a('添加子部门/职位',['position-add-and-edit','p_id'=>$l->id],['class'=>'btn btn-danger btn-xs'])?>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>

<form id="view-user-form" action="/manage/user" method="post" target="_blank">
    <input type="hidden"  id="form-p_id" name="search[position_id]" />
    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
</form>
