<?php
    app\assets\AppAsset::addCssFile($this,'css/site-index.css');
    app\assets\AppAsset::addJsFile($this,'js/main/site-index.js');
?>
<div id="news_list">
    <?=$this->render('/site/_news',['news_list'=>$news_list])?>
</div>
<div class="clearfix"></div>
<div id="site-index">
    <?php for($i=1;$i<=count($list_dirOne);$i++):?>
    <div class="item-one <?=$i==count($list_dirOne)?'item-last':''?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">
                    <?=yii\bootstrap\Html::a($list_dirOne[$i]->name,['/dir','dir_id'=>$list_dirOne[$i]->id])?>
                </h3>
            </div>
            <table class="table table-bordered table-hover">
                <?php foreach(${'list_'.$i} as $l):?>
                    <tr class="item-count-<?=count(${'list_'.$i})?>">
                        <td class="text-center">
                            <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                        </td>
                    </tr>
                <?php endforeach;?>

            </table>
        </div>
    </div>
    <?php endfor;?>
    <div class="item-two">
        <div id="email-login" class="panel panel-default">
            <div class="panel-heading">颂唐邮箱登陆</div>
            <div class="panel-body">
                <div class="form-group">
                    <!--<label for="email_input">邮箱地址</label>-->
                    <input type="email" class="form-control" id="email_input" placeholder="输入邮箱地址">
                </div>
                <div class="form-group">
                    <!--<label for="email_pwd_input">密码</label>-->
                    <input type="password" class="form-control" id="email_pwd_input" placeholder="输入密码">
                </div>
                <div class="form-group">
                    <!--<label for="email_pwd_input">密码</label>-->
                    <button>登陆</button>
                </div>
            </div>
        </div>
    </div>
    <div class="item-two">
        <a href="http://songtang.net" target="_blank">
            <img src="/images/common/tangxun.jpg">
        </a>
    </div>
    <div class="item-two">
        <a href="http://songtang.net" target="_blank">
            <img src="/images/common/tangkan.jpg">
        </a>
    </div>
    <div class="item-two">
        <a href="http://songtang.net" target="_blank">
            <img src="/images/common/tangjian.jpg">
        </a>
    </div>
    <div class="item-two item-last">
        <div class="wx">
            <img src="/images/common/wx.png">
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div id="recruitment_list">
    <?=$this->render('/site/_right',['recruitment_list'=>$recruitment_list])?>
</div>
