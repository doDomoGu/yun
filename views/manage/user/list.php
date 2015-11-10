<?php
    use yii\bootstrap\BaseHtml;
    use app\components\CommonFunc;
    use app\components\PositionFunc;
?>

        <?=BaseHtml::a('新增职员',['user-add-and-edit'],['class'=>'btn btn-primary'])?>
        <p></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>用户名(邮箱)</th>
                    <th>姓名</th>
                    <th>职位</th>
                    <th>性别</th>
                    <th>联系电话(手机)</th>
                    <th>联系电话(座机)</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->username?></td>
                    <td><?=$l->name?></td>
                    <td><?=PositionFunc::getFullRoute($l->position_id)?></td>
                    <td><?=CommonFunc::getGender($l->gender)?></td>
                    <td><?=$l->mobile?></td>
                    <td><?=$l->phone?></td>
                    <td><?=$l->status==1?'正常':'禁用'?></td>
                    <td><?=BaseHtml::a('编辑',['user-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
