<?php
    app\assets\AppAsset::addJsFile($this,'js/jquery.SuperSlide.2.1.1.js');
    app\assets\AppAsset::addJsFile($this,'js/main/site-_news.js');
    app\assets\AppAsset::addCssFile($this,'css/site-_news.css');
    $news_list = app\models\News::find()->where(['status'=>1])->orderBy('ord desc')->all();
?>

<?php if(!empty($news_list)):?>
<div id="slideBox-news" class="slideBox">
    <!--<div class="hd">
        <ul>
            <?php /*for($i=1;$i<=count($news_list);$i++):*/?>
            <li><?/*=$i*/?></li>
            <?php /*endfor;*/?>
        </ul>
    </div>-->
    <div class="bd">
        <ul>
            <?php foreach($news_list as $l):?>
            <li><a href="/" target="_blank"><img src="<?=\app\components\CommonFunc::imgUrl($l->img_url)?>" /></a></li>
            <?php endforeach;?>
        </ul>
    </div>
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>
</div>
<?php endif;?>
