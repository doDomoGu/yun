<?php
    app\assets\AppAsset::addJsFile($this,'js/jquery.SuperSlide.2.1.1.js');
    app\assets\AppAsset::addJsFile($this,'js/main/site-_left.js');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">公司新闻</h3>
    </div>

    <?php if(!empty($news_list)):?>
    <div id="slideBox-news" class="slideBox">
        <div class="hd">
            <ul>
                <?php for($i=1;$i<=count($news_list);$i++):?>
                <li><?=$i?></li>
                <?php endfor;?>
            </ul>
        </div>
        <div class="bd">
            <ul>
                <?php foreach($news_list as $l):?>
                <li><a href="http://www.SuperSlide2.com" target="_blank"><img src="<?=$l->img_url?>" /></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <a class="prev" href="javascript:void(0)"></a>
        <a class="next" href="javascript:void(0)"></a>
    </div>
    <?php endif;?>
</div>