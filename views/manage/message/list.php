<?php
    use yii\bootstrap\BaseHtml;
    use app\components\MessageFunc;
?>
        <?=BaseHtml::a(
            '发送消息:'.MessageFunc::getTypeNameById(MessageFunc::SEND_TYPE_ONE),
            ['message-add','send_type'=>MessageFunc::SEND_TYPE_ONE],
            ['class'=>'btn btn-primary']
        )?>
        <?=BaseHtml::a(
            '发送消息:'.MessageFunc::getTypeNameById(MessageFunc::SEND_TYPE_POSITION),
            ['message-add','send_type'=>MessageFunc::SEND_TYPE_POSITION],
            ['class'=>'btn btn-primary']
        )?>
        <?=BaseHtml::a(
            '发送消息:'.MessageFunc::getTypeNameById(MessageFunc::SEND_TYPE_ALL),
            ['message-add','send_type'=>MessageFunc::SEND_TYPE_ALL],
            ['class'=>'btn btn-primary']
        )?>
        <p></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>标题</th>
                    <th>类型</th>
                    <th>发送对象</th>
                    <th>发送人数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->subject?></td>
                    <td><?=MessageFunc::getTypeNameById($l->send_type)?></td>
                    <td>--</td>
                    <td>--</td>
                    <td><?=BaseHtml::a('编辑',['news-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
