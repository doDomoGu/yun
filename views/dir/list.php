<?php
    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;
    use yii\widgets\Breadcrumbs;
    use app\components\CommonFunc;
    app\assets\AppAsset::addCssFile($this,'css/main/dir/index.css');

    if($route=='list'){
        app\assets\AppAsset::addCssFile($this,'css/main/dir/list.css');
    }


    app\assets\AppAsset::addJsFile($this,'js/main/dir/list.js?v=20160701');

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
    <div id="breadcrumbs">
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
            <li class="head_col_filename">
                <span>
                    <input type="checkbox" >
                </span>
                文件名
            </li>
            <li class="head_col_filesize">大小</li>
            <li class="head_col_uploadtime">上传时间</li>
            <?php endif;?>
        </ul>
    </div>
</div>
<?php if(!empty($list)):?>
<div id="file_list">
<?php if($listType=='list'):?>

    <?php foreach($list as $l):?>
    <?php $downloadCheck = PermissionFunc::checkFileDownloadPermission($this->context->user->position_id,$l);?>
    <div class="dir-item <?=$route=='list'?'file-item2':''?> <?=$l->filetype == 0?'dirtype':'filetype'?>" data-is-dir="<?=$l->filetype==0?'1':'0'?>" data-id="<?=$l->id?>" download-check="<?=$downloadCheck?'enable':'disable'?>">
        <div class="info">
            <div class="filename" style="">
                <!--<span class="file-check">
                    <input type="checkbox" >
                </span>-->
                <span class="icon">
                    <?=Html::img('/images/fileicon/'.FileFrontFunc::getFileExt($l->filetype).'.png')?>
                </span>
                <span class="filename_txt" title="<?=$l->filename?>" alt="<?=$l->filename?>">
                <?php if($l->filetype == 0):?>
                    <?=Html::a(CommonFunc::mySubstr($l->filename,30),['/dir','p_id'=>$l->id])?>
                <?php else:?>
                    <?=CommonFunc::mySubstr($l->filename,30)?>
                <?php endif;?>
                </span>
                <?php if($l->filetype!=0):?>
                    <div class="click_btns">
                        <?php if($l->filetype>0):?>
                            <?php if($downloadCheck):?>
                                <?=Html::Button('<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>',['data-id'=>$l->id,'class'=> 'downloadBtn btn '])?>
                            <?php else:?>
                                <?=Html::Button('<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>',['class'=> 'btn disabled'])?>
                            <?php endif;?>
                        <?php else:?>
                            <?php if($downloadCheck):?>
                                <?=Html::Button('打',['data-id'=>$l->id,'class'=> 'openBtn btn btn-success'])?>
                            <?php else:?>
                                <?=Html::Button('打',['class'=> 'btn disabled'])?>
                            <?php endif;?>
                        <?php endif;?>
                        <?php if($downloadCheck && in_array($l->filetype,$this->context->previewTypeArr)):?>
                            <?=Html::Button('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>',['data-id'=>$l->id,'class'=> 'previewBtn btn'])?>
                        <?php else:?>
                            <?=Html::Button('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>',['class'=> 'btn disabled'])?>
                        <?php endif;?>
                        <?php if($l->uid==yii::$app->user->id):?>
                            <?=Html::Button('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',['link'=>'/dir/delete?id='.$l->id,'class'=> 'deleteBtn btn'])?>
                        <?php else:?>
                            <?=Html::Button('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',['class'=> 'btn disabled'])?>
                        <?php endif;?>
                    </div>
                <?php endif;?>
            </div>
            <div class="filesize"><?=$l->filetype>0?FileFrontFunc::sizeFormat($l->filesize):'--'?></div>
            <div class="upload_time"><?=date('Y-m-d H:i',strtotime($l->add_time))?></div>

            <!--<div class="upload_uid"><?/*=$l->user->name*/?></div>
            <div class="download_times"><?/*=$l->clicks*/?></div>-->
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
            <!--<div class="upload_type">上传类型：<?/*=$l->flag==1?'公共':'个人'*/?></div>
            <div class="download_times">下载次数：<span><?/*=$l->clicks*/?></span></div>-->
        </div>
    </div>
    <?php endforeach;?>
<?php else:?>
    <?php foreach($list as $l):?>
    <?php
        $downloadCheck = PermissionFunc::checkFileDownloadPermission($this->context->user->position_id,$l);
        $filethumb = ($downloadCheck && in_array($l->filetype,$this->context->thumbTypeArr))?true:false;
        ?>
    <div class="dir-item <?=$route=='list'?'file-item':''?>  <?=$downloadCheck?'dl_enable':'dl_disable'?> <?=$l->filetype==0?'is-dir':'is-file'?> text-center" data-is-dir="<?=$l->filetype==0?'1':'0'?>" data-id="<?=$l->id?>" download-check="<?=$downloadCheck?'enable':'disable'?>">
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
<div class="clearfix"></div>
<div class="clearfix text-center">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
    <!--<div style="display: inline-block;padding:6px;"><?/*=$pages->totalCount*/?> 个</div>-->
    <!--<div id="total_count"> 个</div>-->
</div>


<?php else:?>
<div style="padding:4px;">
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        还没有任何文件！
    </div>
</div>
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
