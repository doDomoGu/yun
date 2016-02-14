<?php
    use yii\bootstrap\BaseHtml;
    use app\components\DirFunc;
    use app\components\CommonFunc;
    use app\components\PositionFunc;

    //app\assets\AppAsset::addJsFile($this,'js/main/manage/user/index.js');
?>

        <p></p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <form id="searchForm" >
                    <th>--</th>
                    <th><input id="s_username" name="filename" value="<?=$search['filename']?>" size="14" /></th>
                    <!--<th><input id="s_name" name="search[name]" value="<?/*=$search['name']*/?>" size="10"  /></th>
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
                    <th><button type="button" id="searchBtn" >检索</button></th>-->
                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                </form>
            </tr>
            </thead>
            <thead>
                <tr>
                    <th>#</th>
                    <th>文件名</th>
                    <th>文件大小</th>
                    <th>文件夹路径</th>
                    <th>上传职员</th>
                    <th>上传时间</th>
                    <th>下载次数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->filename?> <?=$l->filetype==0?'<span class="label label-primary">文件夹</span>':''?></td>
                    <td><?=$l->filetype==0?'--':\app\components\FileFrontFunc::sizeFormat($l->filesize)?></td>
                    <td width="160">
                        <?=DirFunc::getFileFullRoute($l->dir_id,$l->p_id,' > <br/>')?>
                        <?php if($l->p_id>0):?>
                            <?=BaseHtml::a('进入',['/dir','p_id'=>$l->p_id],['class'=>'btn btn-success btn-xs'])?>
                        <?php else:?>
                            <?=BaseHtml::a('进入',['/dir','dir_id'=>$l->dir_id],['class'=>'btn btn-success btn-xs'])?>
                        <?php endif;?>
                    </td>
                    <td><?=$l->user->name?> (uid:<?=$l->uid?>)</td>
                    <td><?=$l->add_time?></td>
                    <td><?=$l->filetype==0?'--':$l->clicks?></td>
                    <td>
                        <?php if($l->filetype==0):?>
                            <?=BaseHtml::a('进入',['/dir','p_id'=>$l->id],['class'=>'btn btn-success btn-xs'])?>
                        <?php else:?>
                            <?=BaseHtml::a('下载',['/dir/download','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?>
                        <?php endif;?>


                    </td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>

<div class="clearfix col-md-12 text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
</div>
<div class="clearfix text-center">共 <?=$pages->totalCount?> 个</div>
