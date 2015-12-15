<?php
    use app\components\DirFrontFunc;

    /*app\assets\AppAsset::addCssFile($this,'css/nestable.css');
    app\assets\AppAsset::addJsFile($this,'js/jquery.nestable.js');*/

    app\assets\AppAsset::addCssFile($this,'css/ztree/zTreeStyle/zTreeStyle.css');
    app\assets\AppAsset::addJsFile($this,'js/jquery.ztree.core-3.5.min.js');

    app\assets\AppAsset::addCssFile($this,'css/dir-left.css');
    app\assets\AppAsset::addJsFile($this,'js/main/dir-_left.js');
$start = microtime(true);

$treeData = DirFrontFunc::getTreeData($dir_id);

/*$end = microtime(true);
$s = $end-$start;
Yii::info($flag.' | time : '.$s,'youhua');*/
?>
<span id="treeData" class="hidden"><?=$treeData?></span>
<div id="tree-div">
    <h3>快速访问<?/*=var_dump($cache['aa'])*/?></h3>
    <ul id="treeDemo" class="ztree"></ul>
</div>