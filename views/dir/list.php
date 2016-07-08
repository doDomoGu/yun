<?php
    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;
    use yii\widgets\Breadcrumbs;

//    app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');

    app\assets\AppAsset::addCssFile($this,'css/main/dir/list.css');


    app\assets\AppAsset::addJsFile($this,'js/main/dir/list.js');

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
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹',['value'=>'','class'=> 'btn btn-default','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#createDirCommonModal"])?>
        <?php else:?>
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])?>
            <?=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹',['value'=>'','class'=> 'btn btn-default disabled','id'=>'modalButton'])?>
        <?php endif;?>
        <?php /*if(PermissionFunc::isAllowUploadPerson($dir_id)):*/?><!--
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传 (个人)',['value'=>'','class'=> 'btn btn-success','id'=>'modalButton2','data-toggle'=>"modal",'data-target'=>"#uploadPersonModal"])*/?>
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹（个人）',['value'=>'','class'=> 'btn btn-primary','id'=>'modalButton','data-toggle'=>"modal",'data-target'=>"#createDirPersonModal"])*/?>
        --><?php /*else:*/?>
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-upload"></span> 上传 (个人)',['value'=>'','class'=> 'btn btn-success disabled','id'=>'modalButton'])*/?>
            <?/*=Html::Button('<span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> 新建文件夹（个人）',['value'=>'','class'=> 'btn btn-primary disabled','id'=>'modalButton'])*/?>
        <?php /*endif;*/?>
        </div>
        <div id="right_btns">排序：<?=Html::dropDownList('order_select',$orderNum,$orderSelect,['id'=>'order_select'])?>
            <?php foreach($links as $link_key => $li):?>
                <input type="hidden" id="link_<?=$link_key?>" value="<?=$li?>" />
            <?php endforeach;?>
            显示：<?=Html::dropDownList('list_type_select',$listTypeNum,$listTypeSelect,['id'=>'list_type_select'])?>
            <?php foreach($links2 as $link_key => $li):?>
                <input type="hidden" id="link2_<?=$link_key?>" value="<?=$li?>" />
            <?php endforeach;?>
        </div>
    </div>
    <div id="dir-nav">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <span class="total_count">
            共<?=$pages->totalCount?>个
        </span>
    </div>
    <div id="file_head" class="clearfix">
        <ul class="head_cols">
            <?php if($listType=='list'):?>
            <li class="head_col_filename <?=$orderNum==0?'desend':''?> <?=$orderNum==1?'ascend':''?>">
                <span>
                    <input type="checkbox" >
                </span>
                <span class="txt">文件名</span>
                <span class="order-icon"></span>
            </li>
            <li class="head_col_filesize <?=$orderNum==2?'desend':''?> <?=$orderNum==3?'ascend':''?>" data-key="filesize">
                <span class="txt">大小</span>
                <span class="order-icon"></span>
            </li>
            <li class="head_col_uploadtime <?=$orderNum==4?'desend':''?> <?=$orderNum==5?'ascend':''?>">
                <span class="txt">上传时间</span>
                <span class="order-icon"></span>
            </li>
            <?php endif;?>
        </ul>
    </div>
</div>
<?php if(!empty($list)):?>
<div id="list-main">
<?php if($listType=='list'):?>
    <?=$this->context->renderPartial('_list_data',['list'=>$list,'listType'=>$listType])?>

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
            <!--<div class="filesize">文件大小：<?/*=$l->filetype>0?FileFrontFunc::sizeFormat($l->filesize):'--'*/?></div>
            <div class="upload_time">时间：<?/*=$l->add_time*/?></div>
            <div class="upload_uid">上传用户：<?/*=$l->uid==yii::$app->user->id?'自己':'uid: '.$l->uid*/?></div>
            <div class="upload_type">上传类型：<?/*=$l->flag==1?'公共':'个人'*/?></div>
            <div class="download_times">下载次数：<span><?/*=$l->clicks*/?></span></div>-->
            <!--<div class="click_btns">
                <?php /*if($l->filetype>0):*/?>
                    <?php /*if($downloadCheck):*/?>
                        <?/*=Html::Button('下载',['data-id'=>$l->id,'class'=> 'downloadBtn btn btn-success'])*/?>
                    <?php /*else:*/?>
                        <?/*=Html::Button('下载',['class'=> 'btn btn-success disabled'])*/?>
                    <?php /*endif;*/?>
                <?php /*else:*/?>
                    <?php /*if($downloadCheck):*/?>
                        <?/*=Html::Button('打开',['data-id'=>$l->id,'class'=> 'openBtn btn btn-success'])*/?>
                    <?php /*else:*/?>
                        <?/*=Html::Button('打开',['class'=> 'btn btn-success disabled'])*/?>
                    <?php /*endif;*/?>
                <?php /*endif;*/?>
                <?php /*if($downloadCheck && in_array($l->filetype,$this->context->previewTypeArr)):*/?>
                    <?/*=Html::Button('预览',['data-id'=>$l->id,'class'=> 'previewBtn btn btn-primary'])*/?>
                <?php /*else:*/?>
                    <?/*=Html::Button('预览',['class'=> 'btn btn-primary disabled'])*/?>
                <?php /*endif;*/?>
                <?php /*if($l->uid==yii::$app->user->id):*/?>
                    <?/*=Html::Button('删除',['link'=>'/dir/delete?id='.$l->id,'class'=> 'deleteBtn btn btn-success'])*/?>
                <?php /*else:*/?>
                    <?/*=Html::Button('删除',['class'=> 'btn btn-success disabled'])*/?>
                <?php /*endif;*/?>
            </div>-->
        </div>

    </div>
    <?php endforeach;?>
<?php endif;?>
</div>
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


<?=$this->render('modal/upload_common')?>
<?/*=$this->render('modal/upload_person')*/?>
<?=$this->render('modal/create_dir_common')?>
<?/*=$this->render('modal/create_dir_person')*/?>

<?=$this->render('modal/preview')?>

<input type="hidden" id="dir_id" value="<?=$dir_id?>">
<input type="hidden" id="p_id" value="<?=$p_id?>">
<input type="hidden" id="dir_route" value="<?=$dirRoute?>">

<?/*=Html::a('提交',['/dir/save'],['id'=>'save-submit','data-method'=>'post'])*/?>
