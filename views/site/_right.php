<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">招聘信息</h3>
    </div>
    <table class="table table-bordered table-hover">
        <?php foreach($recruitment_list as $l):?>
        <tr>
            <td><b><?=$l->title?></b><br/><span>(<?=date('Y-m-d',strtotime($l->add_time))?>)</span></td>
        </tr>
        <?php endforeach;?>

    </table>
</div>