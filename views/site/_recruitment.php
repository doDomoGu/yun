<?php
    app\assets\AppAsset::addCssFile($this,'css/main/site/_recruitment.css');
    $list = app\models\Recruitment::find()->where(['status'=>1])->orderBy('ord desc,edit_time desc')->limit(10)->all();
?>
<section id="recruitment-section" >
    <div class="recruit-heading">
        <span class="sp1">Recruitment</span>
        <span class="sp2">招聘信息</span>
    </div>
    <div class="recruit-list">
        <ul class="list-unstyled">
            <?php foreach($list as $l):?>
            <li>
                <?=$l->title?>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</section>


<!--<div id="recruitment_list" class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">招聘信息</h3>
    </div>
    <table class="table table-bordered table-hover">
        <?php /*foreach($recruitment_list as $l):*/?>
        <tr>
            <td><b><?/*=$l->title*/?></b><br/><span>(<?/*=date('Y-m-d',strtotime($l->add_time))*/?>)</span></td>
        </tr>
        <?php /*endforeach;*/?>

    </table>
</div>-->