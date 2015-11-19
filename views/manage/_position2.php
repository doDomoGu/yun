<?php
    use yii\bootstrap\BaseHtml;

?>
<?php $i=0;?>
<?php foreach($posList as $list):?>
    <?php if(!empty($list)):?>
    <?php
        $option = [
            'encode'=>false,
            'class'=>'pos-select-group'];
        //if($i==0)
            $option['prompt'] = '===请选择===';
    ?>
    <?=BaseHtml::dropDownList(
        'pos-select',
        isset($selected[$i])?$selected[$i]:'',
        $list,
        $option
    )?>
    <?php endif;?>
<?php $i++;?>
<?php endforeach;?>