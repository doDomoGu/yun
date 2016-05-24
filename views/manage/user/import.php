<?php
    use yii\bootstrap\BaseHtml;
    use app\components\CommonFunc;
    use app\components\PositionFunc;

    //app\assets\AppAsset::addJsFile($this,'js/main/manage/user/import.js');
?>


<?php if($post):?>
    <?php if($wrong==''):?>
        <p class="clearfix well">
            <a style="display: block;float:left;" href="/manage/user-import" class="btn btn-primary"><< 返回</a>
            <span style="display: block;width:600px;text-align:center;font-size:20px;float:left;">  导入信息预览</span>
            <button style="display: block;float:right;" href="/manage/user-import" class="btn btn-success">确认导入 >></button>
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>用户名(邮箱)</th>
                <th width="100">姓名</th>
                <th>职位</th>
                <th width="60">性别</th>
                <th width="100">生日</th>
                <th width="100">手机</th>
                <th>座机</th>
                <th width="100">入职日期</th>
                <th width="100">合同到期</th>
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
                        <td><?=$l['birthday']?></td>
                        <td><?=$l['mobile']?></td>
                        <td><?=$l['phone']?></td>
                        <td><?=$l['join_date']?></td>
                        <td><?=$l['contract_date']?></td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>

        <div class="clearfix text-center">共 <?=count($list)?> 个</div>
    <?php else:?>
        <p class="clearfix well">
            <a style="display: block;float:left;" href="/manage/user-import" class="btn btn-primary"><< 返回</a>
        </p>
        <div class="alert alert-danger">
            <?=$wrong?>
        </div>
    <?php endif;?>
<?php else:?>
    <div class="well">
        <form id="addform" action="" method="post" enctype="multipart/form-data">
            请选择要导入的CSV文件：
            <input type="file" name="file" style="display: inline;">
            <input type="submit" class="btn btn-primary" value="导入CSV" style="display: inline;" >
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        </form>
    </div>
<?php endif;?>
