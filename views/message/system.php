<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>发件人</th>
        <th>标题</th>
        <th>时间</th>
        <th>状态</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <td>系统通知</td>
                <td><?=\yii\bootstrap\Html::a($l->message->subject,['/message/detail','id'=>$l->id])?></td>
                <td><?=$l->message->send_time?></td>
                <td><?=$l->read_status==1?'已读':'未读'?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>
