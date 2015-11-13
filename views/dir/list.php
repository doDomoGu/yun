<?php
    use yii\bootstrap\Modal;
    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    app\assets\AppAsset::addCssFile($this,'css/dir-index.css');
    app\assets\AppAsset::addJsFile($this,'js/qiniu/plupload.full.min.js');
    app\assets\AppAsset::addJsFile($this,'js/qiniu/qiniu.js');
    app\assets\AppAsset::addJsFile($this,'js/dir-list.js');

?>
<input type="hidden" id="qiniuDomain" value="<?=yii::$app->params['qiniu-domain']?>" />
<input type="hidden" id="pickfileId" value="pickfile" />
<input type="hidden" id="fileurlId" value="fileurl" />

<p>
    <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span>上传',['value'=>yii\helpers\Url::to('index.php?r=branches/create'),'class'=> 'btn btn-success','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#uploadModal"])?>

    <button class="btn btn-primary disabled">
        <span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span>
        新建文件夹(暂不可用)
    </button>
</p>
<hr/>
<?php if(!empty($list)):?>
<div class="row">
<?php foreach($list as $l):?>
    <div class="col-md-3 dir-item text-center">
        <div class="icon">
            <a href="/dir?dir_id=<?=$l->id?>">
                <!--<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>-->
                <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
            </a>
        </div>
        <div class="name">
            <a href="/dir?dir_id=<?=$l->id?>">
                <?=$l->filename?>
            </a>
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


<?php
    Modal::begin([
        'header' => '上传文件',
        'id'=>'uploadModal',
        'size'=>'modal-lg',
    ]);
?>
    <div id="uploadModalContent">
        <div id="pickfile_container">
            <p>
                <input type="file" id="pickfile">
            </p>
            <p>
                <input type="hidden" id="fileurl" name="fileurl" value="" class="col-lg-6" />
            </p>
            <div class="clearfix" id="fileurl_upload_txt"></div>
        </div>
    </div>
<?php
    Modal::end();
?>
<input type="hidden" id="dir_id" value="<?=$dir_id?>">
<input type="hidden" id="p_id" value="<?=$p_id?>">
<?/*=Html::a('提交',['/dir/save'],['id'=>'save-submit','data-method'=>'post'])*/?>
