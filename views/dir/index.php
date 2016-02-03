<?php \app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');?>
<div class="clearfix"></div>
<?php foreach($list as $l):?>
<div class="dir-item text-center">
    <a class="alink" href="/dir?dir_id=<?=$l->id?>">
        <div class="icon">
            <img src="/images/fileicon/documents.png">
        </div>
        <div class="name">
            <?=$l->name?>
        </div>
    </a>
</div>
<?php endforeach;?>
<div class="clearfix"></div> 