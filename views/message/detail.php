<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">消息通知</h3>
    </div>
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">发件人</td>
            <td>系统通知</td>
        </tr>
        <tr>
            <td class="text-right">时间</td>
            <td><?=$message->send_time?></td>
        </tr>
        <tr>
            <td class="text-right">标题</td>
            <td>
                <?=$message->subject?>
            </td>
        </tr>
        <tr>
            <td class="text-right">内容</td>
            <td><?=$message->content?></td>
        </tr>
    </table>
</div>