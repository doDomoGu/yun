<?php
    app\assets\AppAsset::addCssFile($this,'css/main/version/index.css');
?>
<!-- ●▪· -->
<section class="version-item">
    <?=$this->render('0.6.0.php')?>
    <?=$this->render('0.5.0.php')?>
    <?=$this->render('0.4.0.php')?>
    <?=$this->render('0.3.0.php')?>
    <?=$this->render('0.2.0.php')?>
    <?=$this->render('0.1.0.php')?>
</section>
