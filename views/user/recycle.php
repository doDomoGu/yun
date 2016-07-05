<?php
    use app\components\DirFunc;
    use yii\bootstrap\BaseHtml;
    app\assets\AppAsset::addCssFile($this,'css/main/user/file.css');
    app\assets\AppAsset::addJsFile($this,'js/main/user/recycle.js');
?>
<div class="panel panel-default">
    <div class="panel-heading"><h1><?=$this->title?></h1></div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>文件名</th>
            <th>是否文件夹</th>
            <th>所在目录</th>
            <th>上传时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td>
                        <span title="<?=$l->filename?>">
                            <?=\app\components\CommonFunc::mySubstr($l->filename,18)?>
                        </span>
                    </td>
                    <td><?=$l->filetype==0?'是':''?></td>
                    <td>
                        <?php $dirRoute = DirFunc::getFileFullRoute($l->dir_id,$l->p_id);?>
                        <span title="<?=$dirRoute?>">
                            <?=\app\components\CommonFunc::mySubstr($dirRoute,18)?>
                        </span>
                    </td>
                    <td>
                        <?=$l->add_time?>
                    </td>
                    <td>
                        <?php if($l->status==1 && $l->parent_status == 0):?>
                            所在文件夹被移入回收站
                        <?php else:?>
                            <?php
                            if($l->p_id>0){
                                $link = ['/dir','p_id'=>$l->p_id];
                            }else{
                                $link = ['/dir','dir_id'=>$l->dir_id];
                            }
                            ?>
                            <?=BaseHtml::a('进入目录',$link,['target'=>'_blank','class'=>'btn btn-primary btn-xs'])?>
                            <?=BaseHtml::a('还原',['/user/do-recycle','id'=>$l->id],['class'=>'recycleBtn btn btn-success btn-xs'])?>
                            <?=BaseHtml::a('删除',['/user/do-recycle-delete','id'=>$l->id],['class'=>'recycleDeleteBtn btn btn-danger btn-xs'])?>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
</div>
<div class="clearfix text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
</div>
<div class="clearfix text-center">共 <?=$pages->totalCount?> 个</div>


<div id='recycleModal' class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>