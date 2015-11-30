<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>发件人</th>
        <th>标题</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <td><?=$l->send_from_id?></td>
                <td><?=$l->message->subject?></td>
                <td><?=$l->message->send_time?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>
