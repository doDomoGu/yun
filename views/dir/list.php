<?php

    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;


    app\assets\AppAsset::addCssFile($this,'css/dir-index.css');

    if($route=='list'){
        app\assets\AppAsset::addCssFile($this,'css/dir-list.css');
    }


    app\assets\AppAsset::addJsFile($this,'js/qiniu/plupload.full.min.js');
    app\assets\AppAsset::addJsFile($this,'js/qiniu/qiniu.js');
    app\assets\AppAsset::addJsFile($this,'js/dir-list.js');

?>
<input type="hidden" id="qiniuDomain" value="<?=yii::$app->params['qiniu-domain']?>" />
<input type="hidden" id="pickfileId" value="pickfile" />
<input type="hidden" id="fileurlId" value="fileurl" />
<input type="hidden" id="pickfileId2" value="pickfile2" />
<input type="hidden" id="fileurlId2" value="fileurl2" />
<p>
    <?php if(PermissionFunc::isAllowUploadCommon($dir_id)):?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#uploadCommonModal"])?>
    <?php else:?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])?>
    <?php endif;?>

    <button class="btn btn-primary disabled">
        <span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span>
        新建文件夹(暂不可用)
    </button>
</p>
<p>
    <?php if(PermissionFunc::isAllowUploadPerson($dir_id)):?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传(个人)',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton2','data-toggle'=>"modal",'data-target'=>"#uploadPersonModal"])?>
    <?php else:?>
        <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传(个人)',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])?>
    <?php endif;?>

    <!--<button class="btn btn-primary disabled">
        <span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span>
        新建文件夹(暂不可用)
    </button>-->
</p>
<p>
    <?=PermissionFunc::testShow($this->context->user->position_id,$dir_id)?>
</p>
<hr/>
<?php if(!empty($list)):?>
<div>
<?php foreach($list as $l):?>
    <?php $downloadCheck = PermissionFunc::checkFileDownloadPermission($this->context->user->position_id,$l);?>
    <div class="col-md-3 dir-item <?=$route=='list'?'file-item':''?> text-center" data-id="<?=$l->id?>" download-check="<?=$downloadCheck?'enable':'disable'?>">
        <div class="icon">
                <!--<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>-->
            <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
        </div>
        <div class="info">
            <div class="filename" style="height:40px;overflow: hidden;word-break: break-all;"><?=$l->filename?></div>
            <div class="filesize">文件大小：<?=FileFrontFunc::sizeFormat($l->filesize)?></div>
            <div class="upload_time">时间：<?=$l->add_time?></div>
            <div class="upload_uid">上传用户：<?=$l->uid==yii::$app->user->id?'自己':'uid: '.$l->uid?></div>
            <div class="upload_type">上传类型：<?=$l->flag==1?'公共':'个人'?></div>
            <div class="download_times">下载次数：<span><?=$l->clicks?></span></div>
        </div>
    </div>
<?php endforeach;?>
    <div class="clearfix col-md-12 text-center">
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
    </div>
</div>
<?php else:?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        还没有任何文件！
    </div>
<?php endif;?>


<?=$this->render('modal/upload_common')?>
<?=$this->render('modal/upload_person')?>

<input type="hidden" id="dir_id" value="<?=$dir_id?>">
<input type="hidden" id="p_id" value="<?=$p_id?>">
<?/*=Html::a('提交',['/dir/save'],['id'=>'save-submit','data-method'=>'post'])*/?>
