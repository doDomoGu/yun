<?php
    use app\components\FileFrontFunc;
    use app\components\DirFunc;

    $dir_ids = [5,101,102];


    $list = FileFrontFunc::getDownloadList($dir_ids);


?>
<div id="dir-sidebar-study-download">
    <h3>排行榜</h3>
    <ul class="list-unstyled">
        <?php foreach($list as $l):?>
        <li>
            <?=\yii\bootstrap\Html::a($l->filename,['/dir/download','id'=>$l->id])?>
        </li>
        <?php endforeach;?>
    </ul>
</div>