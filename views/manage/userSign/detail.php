<?php
use yii\bootstrap\BaseHtml;
use app\components\CommonFunc;
use app\components\PositionFunc;

/*app\assets\AppAsset::addJsFile($this,'js/main/manage/user/index.js');*/
?>

<?/*=BaseHtml::a('新增职员',['user-add-and-edit'],['class'=>'btn btn-primary'])*/?>
<div class="clearfix" style="margin:20px auto;width:500px;">
    <span class="prev-btn" style="display: block;float:left;width:100px;"><?=BaseHtml::a('< 上一日',$prevLink,['class'=>'btn btn-primary btn-xs'])?></span>
    <span class="ym" style="display: block;float:left;width:300px;text-align: center;font-size:20px;"><?=$y?> 年 <?=$m?> 月 <?=$d?> 日</span>
    <span class="next-btn" style="display: block;float:left;width:100px;"> <?=BaseHtml::a('下一日 >',$nextLink,['class'=>'btn btn-primary btn-xs'])?></span>
</div>
<table class="table table-bordered">
    <!--<thead>
    <tr>
        <form id="searchForm" method="post">
            <th>#</th>
            <th><input id="s_username" name="search[username]" value="<?/*=$search['username']*/?>" size="14" /></th>
            <th><input id="s_name" name="search[name]" value="<?/*=$search['name']*/?>" size="10"  /></th>
            <th>
                <?/*=$this->render('/manage/_position')*/?>
                <input type="hidden" id="s_position_id" name="search[position_id]" value="<?/*=$search['position_id']*/?>" />
            </th>
            <th>
                <select id="s_gender" name="search[gender]" >
                    <option value="">----</option>
                    <option value="0" <?/*=$search['gender']!=='' && $search['gender']==0?'selected="selected"':''*/?>>N/A</option>
                    <option value="1" <?/*=$search['gender']!=='' && $search['gender']==1?'selected="selected"':''*/?>>男</option>
                    <option value="2" <?/*=$search['gender']!=='' && $search['gender']==2?'selected="selected"':''*/?>>女</option>
                </select>
            </th>
            <th>
                <input id="s_mobile" name="search[mobile]" value="<?/*=$search['mobile']*/?>" size="10"  />
            </th>
            <th>
                <input id="s_phone" name="search[phone]" value="<?/*=$search['phone']*/?>" size="10"  />
            </th>
            <th>
                <select id="s_status" name="search[status]" >
                    <option value="">全部</option>
                    <option value="0" <?/*=$search['status']!=='' && $search['status']==0?'selected="selected"':''*/?>>禁用</option>
                    <option value="1" <?/*=$search['status']!=='' && $search['status']==1?'selected="selected"':''*/?>>启用</option>
                </select>
            </th>
            <th><button type="button" id="searchBtn" >检索</button></th>
            <input name="_csrf" type="hidden" id="_csrf" value="<?/*= Yii::$app->request->csrfToken */?>">
        </form>
    </tr>
    </thead>-->
    <thead>
    <tr>
        <th>#</th>
        <th width="80">用户ID</th>
        <th width="80">姓名</th>
        <th>用户名(邮箱)</th>
        <th>职位</th>
        <th width="160">签到时间</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):$i=0;?>
        <?php foreach($list as $l):$i++;?>
            <tr>
                <th scope="row"><?=$pages->getPage()*$pages->getPageSize()+$i?></th>
                <td><?=$l->uid?></td>
                <td><?=$l->user->name?></td>
                <td><?=$l->user->username?></td>
                <td><?=PositionFunc::getFullRoute($l->user->position_id)?></td>
                <td><?=$l->sign_time?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>

<div class="clearfix col-md-12 text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
</div>
<div class="clearfix text-center">共 <?=$pages->totalCount?> 个</div>
