<?php
    app\assets\AppAsset::addCssFile($this,'css/dir-right.css');
    $user = $this->context->user;
?>

<div class="info-heading">
    个人信息中心
</div>
<div class="info-list">
    姓名:<?=$user->name?>
</div>
<div class="info-list">
    入职时间：<?=$user->join_date?>
</div>
<div class="info-list">
    合同到期时间：<?=$user->contract_date?>
</div>
<div class="info-list">
    入职时间：<?=$this->context->user->name?>
</div>