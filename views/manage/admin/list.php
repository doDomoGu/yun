<?php
    use yii\bootstrap\BaseHtml;
    use app\components\PositionFunc;
    /*app\assets\AppAsset::addJsFile($this,'js/main/manage-admin.js');*/
?>
        <?/*=BaseHtml::a('添加目录（暂时不可用）',['dir-add-and-edit'],['class'=>'btn btn-primary disabled'])*/?><!--
        <p></p>

        板块选择：<?/*=BaseHtml::dropDownList('dir-select-1',$dirLvl_1->id,$dirList_1,['encode'=>false,'id'=>'dir-select-1','prompt'=>'===请选择==='])*/?>
        <?php /*if(!empty($dirList_2)):*/?>
        <p></p>
        目录选择：<?/*=BaseHtml::dropDownList('dir-select-2',$dirLvl_2->id,$dirList_2,['encode'=>false,'id'=>'dir-select-2','prompt'=>'===请选择==='])*/?>
        <?php /*endif;*/?>
        <p></p>-->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <form id="searchForm" method="post">
                    <th>#</th>
                    <th><input id="s_username" name="search[username]" value="<?=$search['username']?>" size="14" /></th>
                    <th><input id="s_name" name="search[name]" value="<?=$search['name']?>" size="10"  /></th>
                    <th>---</th>
                    <th>
                        <select id="s_status" name="search[status]" >
                            <option value="">----</option>
                            <option value="0" <?=$search['status']!=='' && $search['status']==0?'selected="selected"':''?>>禁用</option>
                            <option value="1" <?=$search['status']!=='' && $search['status']==1?'selected="selected"':''?>>启用</option>
                        </select>
                    </th>
                    <th>
                        <select id="s_is_admin" name="search[is_admin]" >
                            <option value="">----</option>
                            <option value="0" <?=$search['is_admin']!=='' && $search['is_admin']==0?'selected="selected"':''?>>否</option>
                            <option value="1" <?=$search['is_admin']!=='' && $search['is_admin']==1?'selected="selected"':''?>>是</option>
                        </select>
                    </th>
                    <th><button id="searchBtn">检索</button></th>
                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    </form>
                </tr>
            </thead>
            <thead>
            <tr>
                <th>#</th>
                <th>用户名(邮箱)</th>
                <th>姓名</th>
                <th>所属职位</th>
                <th>状态</th>
                <th>是否是管理员</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->username?></td>
                    <td><?=$l->name?> </td>
                    <td><?=PositionFunc::getFullRoute($l->id)?></td>
                    <td><?=$l->status?></td>
                    <td><?=$l->is_admin?></td>
                    <td><?=BaseHtml::a('编辑(暂时不可用)',['','id'=>$l->id],['class'=>'btn btn-primary btn-xs disabled'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
