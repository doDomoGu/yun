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
            <span style="display: block;width:700px;text-align:center;font-size:20px;float:left;">
                成功导入 <?=count($list)?> 个
            </span>
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>用户名(邮箱)</th>
                <th width="60">姓名</th>
                <th width="200">职位</th>
                <th width="50">性别</th>
                <th width="100">生日</th>
                <th width="100">手机</th>
                <th width="100">座机</th>
                <th width="100">入职日期</th>
                <th width="100">合同到期</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
                <?php foreach($list as $l):?>
                    <tr>
                        <!--<th scope="row"><?/*=$l->id*/?></th>-->
                        <td>
                                <?=$l['username']?>
                        <td>
                            <?=$l['name']?>
                        </td>
                        <td>

                                <?=PositionFunc::getFullRoute($l['position_id'])?>

                        </td>
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
    <?php else:?>
        <p class="clearfix well">
            <a style="display: block;float:left;" href="/manage/user-import" class="btn btn-primary"><< 返回</a>
        </p>
        <div class="alert alert-danger">
            没有导入任何数据
        </div>
    <?php endif;?>
<?php endif;?>
