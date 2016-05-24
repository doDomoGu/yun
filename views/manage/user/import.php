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
                导入信息预览&emsp;&emsp;&emsp;&emsp;
                共 <?=count($list)?> 个
                <span class="label label-danger"><?=$wrongNum?></span>个错误
                可导入<span class="label label-success"><?=count($list)-$wrongNum?></span>个
            </span>
            <button style="display: block;float:right;" onclick="$('#importForm').submit();" class="btn btn-success">确认导入 >></button>
        </p>
        <form id="importForm" method="post" action="/manage/user-import-complete">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>用户名(邮箱)<span style="color:red;">*</span></th>
                <th width="60">姓名<span style="color:red;">*</span></th>
                <th width="200">职位<span style="color:red;">*</span></th>
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
                            <?php if($l['usernameWrong']==1):?>
                                <span class="label label-danger">不能为空</span>
                            <?php elseif($l['usernameWrong']==2):?>
                                <?=$l['username']?> <span class="label label-danger">邮箱格式错误</span>
                            <?php elseif($l['usernameWrong']==3):?>
                                <?=$l['username']?> <span class="label label-danger">用户名重复(在当前导入文件中)</span>
                                <?php elseif($l['usernameWrong']==4):?>
                                <?=$l['username']?> <span class="label label-danger">用户名已存在</span>
                            <?php else:?>
                                <?=$l['username']?>
                            <?php endif;?>
                        <td>
                            <?=$l['nameWrong']==1?'<span class="label label-danger">不能为空</span>':$l['name']?>
                        </td>
                        <td>
                            <?php if($l['positionWrong']==1):?>
                                <span class="label label-danger">不能为空</span>
                            <?php elseif($l['positionWrong']==2):?>
                                <?=$l['position_id']?> <span class="label label-danger">职位ID错误</span>
                            <?php else:?>
                                <?=PositionFunc::getFullRoute($l['position_id'])?>
                            <?php endif;?>
                        </td>
                        <td><?=CommonFunc::getGender($l['gender'])?></td>
                        <td><?=$l['birthday']!=''?$l['birthday']:'<span class="label label-warning">格式错误或为空</span>'?></td>
                        <td><?=$l['mobile']?></td>
                        <td><?=$l['phone']?></td>
                        <td><?=$l['join_date']!=''?$l['join_date']:'<span class="label label-warning">格式错误或为空</span>'?></td>
                        <td><?=$l['contract_date']!=''?$l['contract_date']:'<span class="label label-warning">格式错误或为空</span>'?></td>
                        <?php if($l['usernameWrong']==false && $l['nameWrong']==false && $l['positionWrong']==false):?>
                        <input type="hidden" name="data[]" value='<?=$l['data']?>' />
                        <?php endif;?>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        </form>
        <div class="clearfix text-center">
            共 <?=count($list)?> 个
            <span class="label label-danger"><?=$wrongNum?></span>个错误
            可导入<span class="label label-success"><?=count($list)-$wrongNum?></span>个
        </div>
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
