<?php
    use yii\bootstrap\BaseHtml;
    use app\components\DirFunc;
    use app\components\PositionFunc;
    use app\components\PermissionFunc;

    app\assets\AppAsset::addCssFile($this,'css/manage/dir/position-permission.css')
?>

<p style="font-size:16px;" class="bg-warning">
   当前目录：<?=DirFunc::getFileFullRoute($dir->id);?>
</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>部门/职位名称</th>
                    <th>类型</th>
                    <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('upload_common')?></th>
                    <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('download_common')?></th>
                    <!--<th>修改</th>-->
                    <!--<th width="80" class="text-center"><?/*=PermissionFunc::getPermissionTypeNameCn('delete')*/?></th>-->

                    <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('upload_person')?></th>
                    <!--<th width="80" class="text-center"><?/*=PermissionFunc::getPermissionTypeNameCn2('download_person')*/?></th>-->
                    <!--<th>修改(个人)</th>-->


                    <!--<th width="80" class="text-center"><?/*=PermissionFunc::getPermissionTypeNameCn('upload_all')*/?></th>-->
                    <th width="80" class="text-center"><?=PermissionFunc::getPermissionTypeNameCn2('download_all')?></th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <!--<td><?/*=$l->ord*/?></td>-->
                    <td><?=$l->name?> <!--<span class="badge" title="<?/*=PositionFunc::getFullRoute($l->id)*/?>">i</span>--></td>
                    <td><?=PositionFunc::getIsLeaf($l->is_leaf)?></td>
                    <?php if($l->is_leaf):?>
                        <?php $check11 = isset($pmCheck[$l->id][11]);?>
                        <td class="text-center real-checkbox <?=$check11?'checked':''?>"><?=BaseHtml::checkbox('pm['.$l->id.'][11]',$check11?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-11'])?></td>
                        <?php $check12 = isset($pmCheck[$l->id][12]);?>
                        <td class="text-center real-checkbox <?=$check12?'checked':''?>"><?=BaseHtml::checkbox('pm['.$l->id.'][12]',$check12?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-12'])?></td>
                        <?php $check21 = isset($pmCheck[$l->id][21]);?>
                        <td class="text-center real-checkbox <?=$check21?'checked':''?>"><?=BaseHtml::checkbox('pm['.$l->id.'][21]',$check21?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-21'])?></td>
                        <?php $check32 = isset($pmCheck[$l->id][32]);?>
                        <td class="text-center real-checkbox <?=$check32?'checked':''?>"><?=BaseHtml::checkbox('pm['.$l->id.'][32]',$check32?true:false,['class'=>'pm-'.$l->id,'id'=>'pm-'.$l->id.'-32'])?></td>
                    <?php else:?>
                        <td class="text-center">--</td>
                        <td class="text-center">--</td>
                        <td class="text-center">--</td>
                        <td class="text-center">--</td>
                    <?php endif;?>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
