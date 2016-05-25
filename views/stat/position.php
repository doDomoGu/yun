<?php
use yii\bootstrap\BaseHtml;
use app\components\PositionFunc;
//app\assets\AppAsset::addJsFile($this,'js/manage-position.js');
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>部门/职位名称</th>
        <th>类型</th>
        <th>详细路径</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <td><?=$l->name?></td>
                <td><?=PositionFunc::getIsLeaf($l->is_leaf)?></td>
                <td>
                    <?=PositionFunc::getFullRoute($l->id)?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>

