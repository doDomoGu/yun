<?php
    use yii\bootstrap\BaseHtml;
    use app\components\PositionFunc;
    app\assets\AppAsset::addJsFile($this,'js/main/manage-position-dir-permission.js');
?>
<h3>当前职位： 【<?=PositionFunc::getFullRoute($position->id)?>】</h3>