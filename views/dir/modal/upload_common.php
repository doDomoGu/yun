<?php
    use yii\bootstrap\Modal;
    use yii\bootstrap\Progress;
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
            <div class="alert alert-danger" role="alert">
                *上传文件较大时，进度条完成前，请勿操作当前页面
            </div>
            <div class="clearfix" id="fileurl_upload_txt"></div>
<?php            echo Progress::widget([
            'percent' => 0,
            'label' => '上传中',
            'id'=>'upload-progress-1',
            'options'=>['class' => 'progress-striped active','style'=>'display:none;']
            ]);
?>
        </div>
    </div>

<?php
Modal::end();
?>