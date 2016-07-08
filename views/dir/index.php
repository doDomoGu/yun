<?php
    use yii\widgets\Breadcrumbs;

    app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');

?>
<div id="list-head">
    <div id="dir-nav">
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
    </div>
</div>

<div id="list-main">
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