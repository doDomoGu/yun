<?php
    use yii\helpers\Html;
    app\assets\AppAsset::addJsFile($this,'js/main/manage/dir/deploy-cache.js');
    app\assets\AppAsset::addCssFile($this,'css/manage/dir/deploy-cache.css');
?>
        <h2>
            <?=$this->title?>
        </h2>
<span id='dir-ids' class="hidden"><?=$dirIdsJson?></span>
<input id="dir-ids-count" type="hidden" value="<?=count($dirIds)?>" />
<section id="deploy-show">

</section>