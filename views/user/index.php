<?php
    use app\components\CommonFunc;
?>
<div class="row">
    <div class="col-md-3">
        <img src="/images/default-user.png" alt="默认头像" class="img-thumbnail">
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">个人信息</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="text-right">姓名</td>
                        <td><?=$user->name?></td>
                    </tr>
                    <tr>
                        <td class="text-right">邮箱</td>
                        <td>
                            <?=$user->username?>
                            <a class="btn btn-xs btn-primary " href="<?=Yii::$app->urlManager->createUrl(['user/change-password']);?>">修改密码</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">职位</td>
                        <td><?=$user->name?>  --------</td>
                    </tr>
                    <tr>
                        <td class="text-right">性别</td>
                        <td><?=CommonFunc::getGender($user->gender)?></td>
                    </tr>
                    <tr>
                        <td class="text-right">生日</td>
                        <td><?=$user->birthday?></td>
                    </tr>
                    <tr>
                        <td class="text-right">入职日期</td>
                        <td>
                            <?php if($user->join_date>0):?>
                                <?=date('Y-m-d',strtotime($user->join_date))?>
                                <?php $joinDay = CommonFunc::getJoinDay($user->join_date);?>
                                距今已经有<?=$joinDay['day']?>天/<?=$joinDay['yearMonth']?>
                            <?php else:?>
                                --
                            <?php endif;?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>