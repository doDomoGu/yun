<?php
    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;
    use yii\widgets\Breadcrumbs;

//    app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');
    app\assets\AppAsset::addCssFile($this,'css/main/dir/list.css');
    app\assets\AppAsset::addJsFile($this,'js/main/dir/list.js');

    if($listType=='list'){
        app\assets\AppAsset::addCssFile($this,'css/main/dir/list/_list_data.css');
        app\assets\AppAsset::addJsFile($this,'js/main/dir/list/_list_data.js');
    }elseif($listType=='grid'){
        app\assets\AppAsset::addCssFile($this,'css/main/dir/list/_grid_data.css');
        app\assets\AppAsset::addJsFile($this,'js/main/dir/list/_grid_data.js');
    }



?>
<input type="hidden" id="qiniuDomain" value="<?=yii::$app->params['qiniu-domain']?>" />
<input type="hidden" id="pickfileId" value="pickfile" />
<input type="hidden" id="fileurlId" value="fileurl" />
<input type="hidden" id="pickfileId2" value="pickfile2" />
<input type="hidden" id="fileurlId2" value="fileurl2" />
<div id="list-head">
    <div id='buttons' class="clearfix">
        <div id="left_btns">
        <?php if(PermissionFunc::isAllowUploadCommon($dir_id)):?>
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#uploadCommonModal"])?>
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹',['value'=>'','class'=> 'btn btn-default','id'=>'modalButtonDir','data-toggle'=>"modal",'data-target'=>"#createDirCommonModal"])?>
        <?php else:?>
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])?>
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹',['value'=>'','class'=> 'btn btn-default disabled','id'=>'modalButtonDir'])?>
        <?php endif;?>
        <?php /*if(PermissionFunc::isAllowUploadPerson($dir_id)):*/?><!--
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传 (个人)',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton2','data-toggle'=>"modal",'data-target'=>"#uploadPersonModal"])*/?>
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹（个人）',['value'=>'','class'=> 'btn btn-primary','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#createDirPersonModal"])*/?>
        --><?php /*else:*/?>
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传 (个人)',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])*/?>
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹（个人）',['value'=>'','class'=> 'btn btn-primary disabled','id'=>'modalButton'])*/?>
        <?php /*endif;*/?>
        </div>
        <div id="right_btns">
            <!--排序：<?/*=Html::dropDownList('order_select',$orderNum,$orderSelect,['id'=>'order_select'])*/?>
            <?php /*foreach($links as $link_key => $li):*/?>
                <input type="hidden" id="link_<?/*=$link_key*/?>" value="<?/*=$li*/?>" />
            --><?php /*endforeach;*/?>
            <!--显示：<?/*=Html::dropDownList('list_type_select',$listTypeNum,$listTypeSelect,['id'=>'list_type_select'])*/?>
            <?php /*foreach($links2 as $link_key => $li):*/?>
                <input type="hidden" id="link2_<?/*=$link_key*/?>" value="<?/*=$li*/?>" />
            --><?php /*endforeach;*/?>
            <div class="list-grid-switch <?=$listTypeNum==0?'list-switched-on':'grid-switched-on'?>">
                <a href="javascript:void(0)" class="list-switch" data-url="<?=$links2[0]?>"></a>
                <a href="javascript:void(0)" class="grid-switch" data-url="<?=$links2[1]?>"></a>
            </div>
        </div>
    </div>
    <div id="dir-nav">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <span class="total_count">
            <span class="loading_num"></span>
            共<?=$count?>个
        </span>
    </div>
    <div id="file_head" class="clearfix">
        <ul class="head_cols">
            <?php if($listType=='list'):?>
            <li class="head_col_filename <?=$orderClass[0]?>" data-url="<?=$orderLink[0]?>" >
                <span class="list-check">
                    <input type="checkbox" class="list-checkbox">
                </span>
                <span class="txt">文件名</span>
                <span class="order-icon"></span>
            </li>
            <li class="head_col_filesize <?=$orderClass[1]?>" data-url="<?=$orderLink[1]?>" >
                <span class="txt">大小</span>
                <span class="order-icon"></span>
            </li>
            <li class="head_col_uploadtime <?=$orderClass[2]?>" data-url="<?=$orderLink[2]?>" >
                <span class="txt">上传时间</span>
                <span class="order-icon"></span>
            </li>
            <?php endif;?>
        </ul>
    </div>
</div>
<div id="list-main">
<?php if(!empty($list)):?>
<?php if($listType=='list'):?>

<?php else:?>
    <?php foreach($list as $l):?>
    <?php
        $downloadCheck = PermissionFunc::checkFileDownloadPermission($this->context->user->position_id,$l);
        $filethumb = ($downloadCheck && in_array($l->filetype,$this->context->thumbTypeArr))?true:false;
        ?>
    <div class="dir-item <?=$listType=='list'?'file-item':''?>  <?=$downloadCheck?'dl_enable':'dl_disable'?> <?=$l->filetype==0?'is-dir':'is-file'?> text-center" data-is-dir="<?=$l->filetype==0?'1':'0'?>" data-id="<?=$l->id?>" download-check="<?=$downloadCheck?'enable':'disable'?>">
        <div class="icon clickarea <?=$filethumb?'filethumb_icon':''?>">
            <?php if($filethumb):?>
                <span class="filethumb" data-id="<?=$l->id?>">
                    <img class="filethumb-<?=$l->id?>" src="" style="width:100%;">
                </span>
            <?php else:?>
                <span class="fileicon">
                    <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
                </span>
            <?php endif;?>
            <input type="checkbox" name="cb[]" class="file-check" value="<?=$l->id?>" />
        </div>
        <div class="info clickarea">
            <div class="filename" title="<?=$l->filename?>" alt="<?=$l->filename?>">
                <?=\app\components\CommonFunc::mySubstr($l->filename,12);?>
            </div>

        </div>

    </div>
    <?php endforeach;?>
<?php endif;?>

<!--<div class="clearfix"></div>
<div class="clearfix text-center">
    <?/*= \yii\widgets\LinkPager::widget(['pagination' => $pages]); */?>
</div>-->


<?php /*else:*/?><!--
<div style="padding:4px;">
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        还没有任何文件！
    </div>
</div>-->
<?php endif;?>
</div>

<?=$this->render('modal/upload_common')?>
<?/*=$this->render('modal/upload_person')*/?>
<?=$this->render('modal/create_dir_common')?>
<?/*=$this->render('modal/create_dir_person')*/?>

<?=$this->render('modal/preview')?>

<input type="hidden" id="var_dir_id" value="<?=$dir_id?>">
<input type="hidden" id="var_p_id" value="<?=$p_id?>">
<input type="hidden" id="var_list_type" value="<?=$listType?>">
<input type="hidden" id="var_dir_route" value="<?=$dirRoute?>">
<input type="hidden" id="var_page" value="<?=$page?>">
<input type="hidden" id="var_page_size" value="<?=$page_size?>">
<input type="hidden" id="var_page_num" value="<?=$page_num?>">
<input type="hidden" id="var_order" value="<?=$order?>">
<input type="hidden" id="var_count" value="<?=$count?>">

<?/*=Html::a('提交',['/dir/save'],['id'=>'save-submit','data-method'=>'post'])*/?>
