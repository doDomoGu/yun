<?php
    use yii\bootstrap\BaseHtml;

    app\assets\AppAsset::addJsFile($this,'js/main/manage-_position.js');


    //$posList = \app\components\PositionFunc::getDropDownList(0,true,false,1);

?>
<div id="pos-select-div">

</div>
<?/*=BaseHtml::dropDownList(
    'pos-select',
    '',
    $posList,
    ['encode'=>false,'id'=>'pos-select','prompt'=>'===请选择===','class'=>'pos-select-group']
)*/?>
<div id="pos_id_div" class="hidden"></div>
