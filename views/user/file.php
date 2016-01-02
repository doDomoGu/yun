<?php
    use app\components\CommonFunc;
    use app\components\PositionFunc;
    use app\components\DirFunc;
    use yii\bootstrap\BaseHtml;
    app\assets\AppAsset::addCssFile($this,'css/main/user/file.css');
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>文件名</th>
        <th>所在目录</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <td><?=$l->filename?></td>
                <td>
                    <?php
                        if($l->p_id>0){
                            $link = ['/dir','p_id'=>$l->p_id];
                        }else{
                            $link = ['/dir','dir_id'=>$l->dir_id];
                        }
                    ?>
                    <?=BaseHtml::a(DirFunc::getFileFullRoute($l->dir_id,$l->p_id),$link,['target'=>'_blank'])?>
                </td>
                <td></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>