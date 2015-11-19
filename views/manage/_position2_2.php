<?php
    use yii\bootstrap\BaseHtml;

?>

<?=BaseHtml::dropDownList(
    'pos-select',
    '',
    $list,
    ['encode'=>false,'id'=>'pos-select','prompt'=>'===请选择===','class'=>'pos-select-group']
)?>
