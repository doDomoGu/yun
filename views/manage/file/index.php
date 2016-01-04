<?php
use yii\bootstrap\BaseHtml;
//use app\components\CommonFunc;
//use app\components\PositionFunc;
use app\components\DirFunc;
//app\assets\AppAsset::addJsFile($this,'js/main/manage-user.js');
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <form id="searchForm" method="post">
            <th>#</th>
            <th><input id="s_filename" name="search[filename]" value="<?=$search['filename']?>" size="14" /></th>
            <th>--</th>
            <th>--</th>
            <th>--</th>
            <th><button type="button" id="searchBtn" >检索</button></th>
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        </form>
    </tr>
    </thead>
    <thead>
    <tr>
        <th>#</th>
        <th>文件名</th>
        <th>类型</th>
        <th>上传职员</th>
        <th>目录路径</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <td><?=$l->filename?></td>
                <td><?=$l->filetype>0?'<span class="label label-info">文件</span>':'<span class="label label-default">文件夹</span>'?></td>
                <td><?=$l->uid?></td>
                <td><?=DirFunc::getFileFullRoute($l->dir_id,$l->p_id)?></td>
                <td><?=BaseHtml::a('编辑',['user-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>

<div class="clearfix col-md-12 text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
</div>
