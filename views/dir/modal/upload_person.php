<?php
    use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'header' => '上传文件(个人)',
    'id'=>'uploadPersonModal',
    /*'size'=>'modal-lg',*/
    'options'=>['style'=>'margin-top:120px;']
]);
?>
    <div id="uploadModalContent2">
        <div id="pickfile2_container">
            <p>
                <input type="file" id="pickfile2">
            </p>
            <p>
                <input type="hidden" id="fileurl2" name="fileurl" value="" class="col-lg-6" />
            </p>
            <div class="clearfix" id="fileurl2_upload_txt"></div>
        </div>
    </div>
<?php
Modal::end();
?>