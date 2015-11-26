<?php

    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;

    app\assets\AppAsset::addCssFile($this,'css/dir-index.css');
    app\assets\AppAsset::addJsFile($this,'js/qiniu/plupload.full.min.js');
    app\assets\AppAsset::addJsFile($this,'js/qiniu/qiniu.js');
    app\assets\AppAsset::addJsFile($this,'js/dir-list.js');

?>
<input type="hidden" id="qiniuDomain" value="<?=yii::$app->params['qiniu-domain']?>" />
<input type="hidden" id="pickfileId" value="pickfile" />
<input type="hidden" id="fileurlId" value="fileurl" />

<p>
    <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传',['value'=>'','class'=> 'btn btn-success'.(PermissionFunc::isAllowUploadCommon($dir_id)?'':' disabled'),'id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#uploadCommonModal"])?>

    <button class="btn btn-primary disabled">
        <span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span>
        新建文件夹(暂不可用)
    </button>
</p>
<p>
    <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传(个人)',['value'=>'','class'=> 'btn btn-success'.(PermissionFunc::isAllowUploadPerson($dir_id)?'':' disabled'),'id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#uploadPersonModal"])?>

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
    <div class="col-md-3 dir-item text-center" data-id="<?=$l->id?>">
        <div class="icon">
                <!--<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>-->
            <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
        </div>
        <div class="name">
                <?=$l->filename?>
        </div>
    </div>
<?php endforeach;?>
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
