<?php
    app\assets\AppAsset::addCssFile($this,'css/site-index.css');
?>
    <div id="news_list">
        <?=$this->render('/site/_news',['news_list'=>$news_list])?>
    </div>
    <div >
        <div id="site-index">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            <?=yii\bootstrap\Html::a('企业运营中心',['/dir','dir_id'=>1])?>
                        </h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <?php foreach($list_1 as $l):?>
                            <tr>
                                <td class="text-center">
                                    <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                                </td>
                            </tr>
                        <?php endforeach;?>

                    </table>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            <?=yii\bootstrap\Html::a('发展中心',['/dir','dir_id'=>2])?>
                        </h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <?php foreach($list_2 as $l):?>
                            <tr>
                                <td class="text-center">
                                    <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                                </td>
                            </tr>
                        <?php endforeach;?>

                    </table>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            <?=yii\bootstrap\Html::a('工具应用中心',['/dir','dir_id'=>3])?>
                        </h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <?php foreach($list_3 as $l):?>
                            <tr>
                                <td class="text-center">
                                    <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                                </td>
                            </tr>
                        <?php endforeach;?>

                    </table>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            <?=yii\bootstrap\Html::a('项目资源中心',['/dir','dir_id'=>4])?>
                        </h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <?php foreach($list_4 as $l):?>
                            <tr>
                                <td class="text-center">
                                    <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                                </td>
                            </tr>
                        <?php endforeach;?>

                    </table>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            <?=yii\bootstrap\Html::a('学习共享中心',['/dir','dir_id'=>5])?>
                        </h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <?php foreach($list_5 as $l):?>
                            <tr>
                                <td class="text-center">
                                    <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                                </td>
                            </tr>
                        <?php endforeach;?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="recruitment_list">
        <?=$this->render('/site/_right',['recruitment_list'=>$recruitment_list])?>
    </div>
