<?php
    use yii\widgets\Breadcrumbs;

    app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');

?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<div class="clearfix"></div>
<div class="dir-main">
<?php foreach($list as $l):?>
    <div class="dir-item text-center">
        <a class="alink" href="/dir?dir_id=<?=$l->id?>">
            <div class="icon">
                <img src="/images/fileicon/documents.png">
            </div>
            <div class="name">
                <?=\app\components\CommonFunc::mySubstr($l->name,14)?>
            </div>
        </a>
    </div>
<?php endforeach;?>
</div>
<div class="clearfix"></div>