<?php
    use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'header' => '新建文件夹',
    'id'=>'createDirCommonModal',
    /*'size'=>'modal-lg',*/
    'options'=>['style'=>'margin-top:120px;']
]);
?>
    <div id="createDirModalContent">
        <p>
            <label>文件夹名：</label>
            <input name="dirname">
            <span class="create-dir-error"></span>
        </p>
        <p>
            <button class="btn btn-success">提交</button>
        </p>
    </div>
<?php
Modal::end();
?>