<?php
    app\assets\AppAsset::addCssFile($this,'css/site-index.css');
    app\assets\AppAsset::addJsFile($this,'js/main/site-index.js');
?>

<div class="clearfix"></div>
<div id="site-index">
    <!--<section>
    <?php /*for($i=1;$i<=count($list_dirOne);$i++):*/?>
    <div class="item-one <?/*=$i==count($list_dirOne)?'item-last':''*/?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">
                    <?/*=yii\bootstrap\Html::a($list_dirOne[$i]->name,['/dir','dir_id'=>$list_dirOne[$i]->id])*/?>
                </h3>
            </div>
            <table class="table table-hover">
                <?php /*foreach(${'list_'.$i} as $l):*/?>
                    <tr class="item-count-<?/*=count(${'list_'.$i})*/?>">
                        <td class="text-center">
                            <?/*=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])*/?>
                        </td>
                    </tr>
                <?php /*endforeach;*/?>

            </table>
        </div>
    </div>
    <?php /*endfor;*/?>
    </section>-->
    <section id="dir-list">
        <?php for($i=1;$i<=count($list_dirOne);$i++):?>
            <article class="<?=$i==count($list_dirOne)?'last':''?>">
                <div class="item-heading">
                    <?=yii\bootstrap\Html::a($list_dirOne[$i]->name,['/dir','dir_id'=>$list_dirOne[$i]->id])?>
                </div>
                <div class="item-list">
                    <ul class="list-unstyled">
                    <?php $j=0;foreach(${'list_'.$i} as $l):?>
                        <li>
                            <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                        </li>
                    <?php $j++;endforeach;?>
                    <?php for($k=$j;$k<5;$k++):?>
                        <li>

                        </li>
                    <?php endfor;?>
                    </ul>
                </div>
            </article>
        <?php endfor;?>
    </section>
    <div class="clearfix"></div>
    <section id="email-login">
        <article>
            <span><a href="/" target="_blank">颂唐邮箱登录</a></span>
        </article>
        <aside>
            <span></span>
        </aside>
    </section>
    <div class="clearfix"></div>
    <section id="article-link">
        <article id="article-link-1">
            <span><a href="/" target="_blank">唐 讯</a></span>
        </article>
        <article id="article-link-2">
            <span><a href="/" target="_blank">唐 刊</a></span>
        </article>
        <article id="article-link-3">
            <span><a href="/" target="_blank">唐 鉴</a></span>
        </article>
    </section>
    <!--<div class="item-two">
        <div id="email-login" class="panel panel-default">
            <div class="panel-heading">颂唐邮箱登陆</div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="email" class="form-control" id="email_input" placeholder="输入邮箱地址">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="email_pwd_input" placeholder="输入密码">
                </div>
                <div class="form-group">
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
    </div>-->
</div>
<div class="clearfix"></div>
<!--<div id="recruitment_list">
    <?/*=$this->render('/site/_recruitment',['recruitment_list'=>$recruitment_list])*/?>
</div>-->
