<?php
    use yii\bootstrap\Html;
    use app\components\FileFrontFunc;
    use app\components\PermissionFunc;
    use app\components\CommonFunc;
?>
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
                <?=CommonFunc::mySubstr($l->filename,12);?>
            </div>

        </div>

    </div>
<?php endforeach;?>