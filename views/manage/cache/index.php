<?php
    use yii\bootstrap\BaseHtml;
?>

<section>
    <ul class="list-unstyled">
        <li style="padding:10px;">
            <?=BaseHtml::a('清除目录前台缓存',['cache-dir-front-clear'],['class'=>'btn btn-primary'])?>
        </li>
        <li style="padding:10px;">
            <?=BaseHtml::a('清除目录model获取缓存',['cache-dir-clear'],['class'=>'btn btn-primary'])?>
        </li>
    </ul>
</section>