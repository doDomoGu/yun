<?php
    use yii\bootstrap\BaseHtml;
    use app\components\CommonFunc;
    use app\components\PositionFunc;

    //app\assets\AppAsset::addJsFile($this,'js/main/manage/user/import.js');
?>

<div>
    <form id="addform" action="" method="post" enctype="multipart/form-data">
    请选择要导入的CSV文件：<br/>
        <input type="file" name="file">
        <input type="submit" class="btn" value="导入CSV">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    </form>
</div>
<?php if($post):?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>用户名(邮箱)</th>
        <th>姓名</th>
        <th>职位</th>
        <th>性别</th>
        <!--<th>联系电话(手机)</th>
        <th>联系电话(座机)</th>
        <th>状态</th>
        <th>操作</th>-->
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <!--<th scope="row"><?/*=$l->id*/?></th>-->
                <td><?=$l['username']?></td>
                <td><?=$l['name']?></td>
                <td><?=PositionFunc::getFullRoute($l['position_id'])?></td>
                <td><?=CommonFunc::getGender($l['gender'])?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>

<div class="clearfix text-center">共 <?=count($list)?> 个</div>
<?php endif;?>
