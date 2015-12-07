<?php
    use app\components\CommonFunc;
    use app\components\PositionFunc;
?>
<div class="row">
    <div class="col-md-3 text-center">
        <img src="<?=$user->head_img!=''?CommonFunc::imgUrl($user->head_img):'/images/default-user.png'?>"
             alt="职员头像" class="img-thumbnail" style="width:250px;height:250px;">
        <br/>
        <?=\yii\bootstrap\Html::a('修改头像','/user/change-head-img',['class'=>'btn btn-primary btn-xs'])?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">个人信息</h3>
            </div>
            <table class="table table-bordered table-hover">
                <tr>
                    <td class="text-right">姓名</td>
                    <td><?=$user->name?></td>
                </tr>
                <tr>
                    <td class="text-right">邮箱</td>
                    <td>
                        <?=$user->username?>
                        &nbsp;&nbsp;
                        <a class="btn btn-xs btn-primary " href="<?=Yii::$app->urlManager->createUrl(['user/change-password']);?>">修改密码</a>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">职位</td>
                    <td><?=PositionFunc::getFullRoute($user->position_id)?></td>
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