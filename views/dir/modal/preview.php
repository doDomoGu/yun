<?php
    use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'header' => '文件预览',
    'id'=>'previewModal',
    /*'size'=>'modal-lg',*/
    'options'=>['style'=>'margin-top:120px;']
]);
?>
    <div id="previewContent">
        ddd
    </div>

<?php
Modal::end();
?>