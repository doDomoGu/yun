<?php
use app\components\PositionFunc;

/*app\assets\AppAsset::addCssFile($this,'css/nestable.css');
app\assets\AppAsset::addJsFile($this,'js/jquery.nestable.js');*/

app\assets\AppAsset::addCssFile($this,'css/ztree/zTreeStyle/zTreeStyle.css');
app\assets\AppAsset::addJsFile($this,'js/jquery.ztree.core-3.5.min.js');

/*app\assets\AppAsset::addCssFile($this,'css/dir-left.css');*/
app\assets\AppAsset::addJsFile($this,'js/main/dir-_left.js');
//$start = microtime(true);

/*$treeData = PositionFunc::getTreeData();*/
/*$end = microtime(true);
$s = $end-$start;
Yii::info($flag.' | time : '.$s,'youhua');*/
?>
<style>
    #tree-div {
        /*background: #f5f5f5;*/
        overflow: hidden;
        overflow-x: scroll;
        min-height: 400px;

    }
    #tree-div h3 {
        padding:10px 0 0 20px;
        margin:0;
    }


    .ztree {
        padding:5px 0;
    }

    .ztree li span.button.ico_docu {
        background-position: -110px 0;
    }
</style>
<h1>职位设置</h1>
<div><a href="/test/position?clear=1" >刷新缓存</a></div>
<span id="treeData" class="hidden"><?=$treeData?></span>
<div id="tree-div">
    <ul id="treeDemo" class="ztree"></ul>
</div>