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
</div>
<div class="clearfix"></div>
<div id="recruitment_list">
    <?=$this->render('/site/_right',['recruitment_list'=>$recruitment_list])?>
</div>
