<?php
    use yii\bootstrap\BaseHtml;
    use app\components\CommonFunc;
    use app\models\SystemLog;

    app\assets\AppAsset::addJsFile($this,'js/main/manage/systemlog/index.js');
?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <form id="searchForm" method="post">
                    <th>#</th>
                    <th>
                        <select id="s_type" name="search[type]" >
                            <option value="">=请选择=</option>
                            <option value="1" <?=$search['type']==1?'selected="selected"':''?>>系统信息</option>
                            <option value="2" <?=$search['type']==2?'selected="selected"':''?>>用户记录</option>
                        </select>
                        <!--<input id="s_username" name="search[type]" value="<?/*=$search['type']*/?>" size="14" />-->
                    </th>
                    <th>
                        <select id="s_level" name="search[level]" >
                            <option value="">=请选择=</option>
                            <option value="1" <?=$search['level']==1?'selected="selected"':''?>>TRACE</option>
                            <option value="2" <?=$search['level']==2?'selected="selected"':''?>>DEBUG</option>
                            <option value="3" <?=$search['level']==3?'selected="selected"':''?>>INFO</option>
                            <option value="4" <?=$search['level']==4?'selected="selected"':''?>>NOTICE</option>
                            <option value="5" <?=$search['level']==5?'selected="selected"':''?>>WARN</option>
                            <option value="6" <?=$search['level']==6?'selected="selected"':''?>>ERROR</option>
                            <option value="7" <?=$search['level']==7?'selected="selected"':''?>>FATAL</option>
                        </select>

                        <!--<input id="s_name" name="search[level]" value="<?/*=$search['level']*/?>" size="10"  />-->
                    </th>
                    <th>
                        <input id="s_username" name="search[name]" value="<?=$search['name']?>" />
                    </th>
                    <th>
                        <input id="s_category" name="search[category]" value="<?=$search['category']?>" size="10"  />
                    </th>
                    <th></th>
                    <th><button type="button" id="searchBtn" >检索</button></th>
                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                </form>
            </tr>
            </thead>
            <thead>
                <tr>
                    <th>#</th>
                    <th>类型</th>
                    <th>级别</th>
                    <th>职员</th>
                    <th>分类</th>
                    <th>内容</th>
                    <th>时间</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=SystemLog::getType($l->type)?></td>
                    <td><?=SystemLog::getLevel($l->level)?></td>
                    <td>
                        <?php if($l->type==SystemLog::TYPE_SYSTEM):?>
                            ---
                        <?php else:?>
                            <?=isset($l->user)?$l->user->name:$l->uid?>
                        <?php endif;?>
                    </td>
                    <td><?=$l->category?></td>
                    <td><?=$l->message?></td>
                    <td><?=$l->log_time?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>

<div class="clearfix col-md-12 text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
</div>
<div class="clearfix text-center">共 <?=$pages->totalCount?> 个</div>
