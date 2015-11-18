<?php
    use yii\bootstrap\BaseHtml;

    app\assets\AppAsset::addJsFile($this,'js/main/manage-_position.js');

    $posList = \app\components\PositionFunc::getDropDownList(0,true,false,1);

?>

<?=BaseHtml::dropDownList(
    'pos-select',
    '',
    $posList,
    ['encode'=>false,'id'=>'pos-select','prompt'=>'===请选择===']
)?>