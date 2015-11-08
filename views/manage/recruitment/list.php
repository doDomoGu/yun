<?php
use yii\bootstrap\BaseHtml;
?>
<div class="row">
    <div class="col-lg-3">
        <?=$this->render('../_left')?>
    </div>
    <div class="col-lg-9">
        <?=BaseHtml::a('添加招聘信息',['recruitment-add-and-edit'],['class'=>'btn btn-primary'])?>
        <p></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>标题</th>
                    <th>状态</th>
                    <th>排序</th>
                    <th>添加时间</th>
                    <th>修改时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->title?></td>
                    <td><?=$l->status==1?'启用':'禁用'?></td>
                    <td><?=$l->ord?></td>
                    <td><?=$l->add_time?></td>
                    <td><?=$l->edit_time?></td>
                    <td><?=BaseHtml::a('编辑',['recruitment-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>