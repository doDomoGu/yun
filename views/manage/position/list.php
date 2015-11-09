<?php
use yii\bootstrap\BaseHtml;
?>
        <?=BaseHtml::a('添加职位/部门',['position-add-and-edit'],['class'=>'btn btn-primary'])?>
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
                    <td><?=$l->is_leaf?'职位':'部门'?></td>
                    <td><?=BaseHtml::a('编辑',['news-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
