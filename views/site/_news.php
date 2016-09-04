<?php
    app\assets\AppAsset::addJsFile($this,'js/jquery.SuperSlide.2.1.1.js');
    app\assets\AppAsset::addJsFile($this,'js/main/site/_news.js');
    app\assets\AppAsset::addCssFile($this,'css/main/site/_news.css');
    $news_list = app\models\News::find()->where(['status'=>1])->orderBy('ord desc, edit_time desc')->all();
?>
<div id="news-section">
    <?php if(!empty($news_list)):?>
    <section id="slideBox-news" class="fullSlide">

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
                <li style="background:url('<?=\app\components\CommonFunc::imgUrl($l->img_url)?>') #eee center 0 no-repeat;">
                    <div class="siteWidth"><a href="/" target="_blank"></a></div></li>
                <?php endforeach;?>
            </ul>
        </div>
        <a class="prev" href="javascript:void(0)"></a>
        <a class="next" href="javascript:void(0)"></a>
    </section>
    <?php endif;?>
    <!--<section id="slideCover">
        <img src="/images/site-index/1933.jpg" />
    </section>-->
</div>
