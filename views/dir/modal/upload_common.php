<?php
    use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'header' => '上传文件',
    'id'=>'uploadCommonModal',
    /*'size'=>'modal-lg',*/
    'options'=>['style'=>'margin-top:120px;']
]);
?>
    <div id="uploadModalContent">
        <div id="pickfile_container">
            <p>
                <input type="file" id="pickfile">
            </p>
            <p>
                <input type="hidden" id="fileurl" name="fileurl" value="" class="col-lg-6" />
            </p>
            <div class="clearfix" id="fileurl_upload_txt"></div>
        </div>
    </div>
<?php
Modal::end();
?>