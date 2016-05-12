<?php
    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;

    app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');

    if($route=='list'){
        app\assets\AppAsset::addCssFile($this,'css/main/dir/list.css');
    }

    app\assets\AppAsset::addJsFile($this,'js/qiniu/plupload.full.min.js');
    app\assets\AppAsset::addJsFile($this,'js/qiniu/qiniu.js');
    app\assets\AppAsset::addJsFile($this,'js/main/dir/list.js');

?>
<input type="hidden" id="qiniuDomain" value="<?=yii::$app->params['qiniu-domain']?>" />
<input type="hidden" id="pickfileId" value="pickfile" />
<input type="hidden" id="fileurlId" value="fileurl" />
<input type="hidden" id="pickfileId2" value="pickfile2" />
<input type="hidden" id="fileurlId2" value="fileurl2" />
<div id='buttons' class="clearfix">
    <div id="left_btns">
    <?php if(PermissionFunc::isAllowUploadCommon($dir_id)):?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#uploadCommonModal"])?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹',['value'=>'','class'=> 'btn btn-primary','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#createDirCommonModal"])?>
    <?php else:?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹',['value'=>'','class'=> 'btn btn-primary disabled','id'=>'modalButton'])?>
    <?php endif;?>
    <?php if(PermissionFunc::isAllowUploadPerson($dir_id)):?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传 (个人)',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton2','data-toggle'=>"modal",'data-target'=>"#uploadPersonModal"])?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹（个人）',['value'=>'','class'=> 'btn btn-primary','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#createDirPersonModal"])?>
    <?php else:?>
        <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传 (个人)',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])*/?><!--
        --><?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹（个人）',['value'=>'','class'=> 'btn btn-primary disabled','id'=>'modalButton'])*/?>
    <?php endif;?>
    </div>
    <div id="right_btns">排序：<?=Html::dropDownList('order_select',$orderNum,$orderDropdown,['id'=>'order_select'])?>
        <?php foreach($links as $link_key => $li):?>
            <input type="hidden" id="link_<?=$link_key?>" value="<?=$li?>" />
        <?php endforeach;?>
        显示：<?=Html::dropDownList('list_type_select',$listTypeNum,$listTypeDropdown,['id'=>'list_type_select'])?>
        <?php foreach($links2 as $link_key => $li):?>
            <input type="hidden" id="link2_<?=$link_key?>" value="<?=$li?>" />
        <?php endforeach;?>
    </div>
</div>


<!--<p>
    <?/*=PermissionFunc::testShow($this->context->user->position_id,$dir_id)*/?>
</p>-->
<!--<ul id="file-nav" class="nav nav-tabs">
    <li role="presentation" class="<?/*=$order=='add_time desc'?'active':''*/?>"><?/*=Html::a('时间从新到旧',$links['add_time.desc'])*/?></li>
    <li role="presentation" class="<?/*=$order=='add_time asc'?'active':''*/?>"><?/*=Html::a('时间从旧到新',$links['add_time.asc'])*/?></li>
    <li role="presentation" class="<?/*=$order=='filesize desc'?'active':''*/?>"><?/*=Html::a('文件大小从大到小',$links['filesize.desc'])*/?></li>
    <li role="presentation" class="<?/*=$order=='filesize asc'?'active':''*/?>"><?/*=Html::a('文件大小从小到大',$links['filesize.asc'])*/?></li>
    <li role="presentation" class="<?/*=$order=='clicks desc'?'active':''*/?>"><?/*=Html::a('下载量从大到小',$links['clicks.desc'])*/?></li>
    <li role="presentation" class="<?/*=$order=='clicks asc'?'active':''*/?>"><?/*=Html::a('下载量从小到大',$links['clicks.asc'])*/?></li>
</ul>-->
<?php if(!empty($list)):?>
<div id="file_list">
<?php if($listType=='list'):?>
    <div class="clearfix" style="margin-bottom: 8px;color:#888;font-size:16px;">
        <div style="float:left;width:232px;margin-left: 12px;">文件名</div>
        <div style="float:left;width:80px;margin-left: 10px;">大小</div>
        <div style="float:left;width:120px;margin-left: 20px;">上传时间</div>
        <div style="float:left;width:64px;margin-left: 10px;">上传职员</div>
        <div style="float:left;width:64px;margin-left: 10px;">下载次数</div>
        <div style="float:left;width:168px;margin-left: 10px;">操作</div>
    </div>
    <?php foreach($list as $l):?>
    <?php $downloadCheck = PermissionFunc::checkFileDownloadPermission($this->context->user->position_id,$l);?>
    <div class="dir-item <?=$route=='list'?'file-item2':''?> text-center" data-is-dir="<?=$l->filetype==0?'1':'0'?>" data-id="<?=$l->id?>" download-check="<?=$downloadCheck?'enable':'disable'?>">
        <div class="icon">
            <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
        </div>
        <div class="info">
            <div class="filename" style="overflow: hidden;word-break: break-all;"><?=$l->filename?></div>
            <div class="filesize"><?=$l->filetype>0?FileFrontFunc::sizeFormat($l->filesize):'--'?></div>
            <div class="upload_time"><?=date('Y/m/d H:i',strtotime($l->add_time))?></div>
            <div class="upload_uid"><?=$l->user->name?></div>
            <div class="download_times"><?=$l->clicks?></div>
            <div class="click_btns">
                <?php if($l->filetype>0):?>
                    <?php if($downloadCheck):?>
                        <?=Html::Button('下载',['data-id'=>$l->id,'class'=> 'downloadBtn btn btn-success'])?>
                    <?php else:?>
                        <?=Html::Button('下载',['class'=> 'btn btn-success disabled'])?>
                    <?php endif;?>
                <?php else:?>
                    <?php if($downloadCheck):?>
                        <?=Html::Button('打开',['data-id'=>$l->id,'class'=> 'openBtn btn btn-success'])?>
                    <?php else:?>
                        <?=Html::Button('打开',['class'=> 'btn btn-success disabled'])?>
                    <?php endif;?>
                <?php endif;?>
                <?php if($downloadCheck && in_array($l->filetype,$this->context->previewTypeArr)):?>
                    <?=Html::Button('预览',['data-id'=>$l->id,'class'=> 'previewBtn btn btn-primary'])?>
                <?php else:?>
                    <?=Html::Button('预览',['class'=> 'btn btn-primary disabled'])?>
                <?php endif;?>
                <?php if($l->uid==yii::$app->user->id):?>
                    <?=Html::Button('删除',['link'=>'/dir/delete?id='.$l->id,'class'=> 'deleteBtn btn btn-success'])?>
                <?php else:?>
                    <?=Html::Button('删除',['class'=> 'btn btn-success disabled'])?>
                <?php endif;?>
            </div>
            <!--<div class="upload_type">上传类型：<?/*=$l->flag==1?'公共':'个人'*/?></div>
            <div class="download_times">下载次数：<span><?/*=$l->clicks*/?></span></div>-->
        </div>
    </div>
    <?php endforeach;?>
<?php else:?>
    <?php foreach($list as $l):?>
    <?php $downloadCheck = PermissionFunc::checkFileDownloadPermission($this->context->user->position_id,$l);?>
    <div class="dir-item <?=$route=='list'?'file-item':''?> text-center" data-is-dir="<?=$l->filetype==0?'1':'0'?>" data-id="<?=$l->id?>" download-check="<?=$downloadCheck?'enable':'disable'?>">
        <div class="icon clickarea">
            <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
        </div>
        <div class="info clickarea">
            <div class="filename" style="height:40px;overflow: hidden;word-break: break-all;"><?=$l->filename?></div>
            <div class="filesize">文件大小：<?=FileFrontFunc::sizeFormat($l->filesize)?></div>
            <div class="upload_time">时间：<?=$l->add_time?></div>
            <div class="upload_uid">上传用户：<?=$l->uid==yii::$app->user->id?'自己':'uid: '.$l->uid?></div>
            <div class="upload_type">上传类型：<?=$l->flag==1?'公共':'个人'?></div>
            <div class="download_times">下载次数：<span><?=$l->clicks?></span></div>
            <div class="click_btns">
                <?php if($l->filetype>0):?>
                    <?php if($downloadCheck):?>
                        <?=Html::Button('下载',['data-id'=>$l->id,'class'=> 'downloadBtn btn btn-success'])?>
                    <?php else:?>
                        <?=Html::Button('下载',['class'=> 'btn btn-success disabled'])?>
                    <?php endif;?>
                <?php else:?>
                    <?php if($downloadCheck):?>
                        <?=Html::Button('打开',['data-id'=>$l->id,'class'=> 'openBtn btn btn-success'])?>
                    <?php else:?>
                        <?=Html::Button('打开',['class'=> 'btn btn-success disabled'])?>
                    <?php endif;?>
                <?php endif;?>
                <?php if($downloadCheck && in_array($l->filetype,$this->context->previewTypeArr)):?>
                    <?=Html::Button('预览',['data-id'=>$l->id,'class'=> 'previewBtn btn btn-primary'])?>
                <?php else:?>
                    <?=Html::Button('预览',['class'=> 'btn btn-primary disabled'])?>
                <?php endif;?>
                <?php if($l->uid==yii::$app->user->id):?>
                    <?=Html::Button('删除',['link'=>'/dir/delete?id='.$l->id,'class'=> 'deleteBtn btn btn-success'])?>
                <?php else:?>
                    <?=Html::Button('删除',['class'=> 'btn btn-success disabled'])?>
                <?php endif;?>
            </div>
        </div>

    </div>
    <?php endforeach;?>
<?php endif;?>
</div>
<div class="clearfix"></div>
<div class="clearfix text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
    <!--<div style="display: inline-block;padding:6px;"><?/*=$pages->totalCount*/?> 个</div>-->
    <div style="background: #d7d7d7;padding:4px;"><?=$pages->totalCount?> 个</div>
</div>


<?php else:?>
<div style="padding:4px;">
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        没有找到任何文件！
    </div>
</div>
<?php endif;?>


<?=$this->render('modal/upload_common')?>
<?=$this->render('modal/upload_person')?>
<?=$this->render('modal/create_dir_common')?>
<?=$this->render('modal/create_dir_person')?>

<?=$this->render('modal/preview')?>

<input type="hidden" id="dir_id" value="<?=$dir_id?>">
<input type="hidden" id="p_id" value="<?=$p_id?>">
<?/*=Html::a('提交',['/dir/save'],['id'=>'save-submit','data-method'=>'post'])*/?>
