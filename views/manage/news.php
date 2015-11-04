<div class="row">
    <div class="col-lg-3">
        <?=$this->render('_left')?>
    </div>
    <div class="col-lg-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>标题</th>
                    <th>状态</th>
                    <th>添加时间</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->title?></td>
                    <td><?=$l->status==1?'启用':'禁用'?></td>
                    <td><?=$l->add_time?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>