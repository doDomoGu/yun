<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    app\assets\AppAsset::addJsFile($this,'js/main/manage/user/add_and_edit.js');
?>

        <h2>
            <?=$this->title?>
        </h2>
        <?php $form = ActiveForm::begin([
            'id' => 'user-form',
            'options' => ['class' => 'form-horizontal','autocomplete'=>'off'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}{hint}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
<input style="display:none">
        <?/*= $form->field($model, 'username') */?>
        <?= $form->field($model, 'username',['inputOptions'=>['autocomplete'=>'off']]) ?>
<input style="display:none">
        <?/*= $form->field($model, 'password')->passwordInput() */?>
        <?= $form->field($model, 'password',['inputOptions'=>['autocomplete'=>'off']])->passwordInput() ?>
<input style="display:none">
        <?/*= $form->field($model, 'password2')->passwordInput() */?>
        <?= $form->field($model, 'password2',['inputOptions'=>['autocomplete'=>'off']])->passwordInput() ?>

        <?= $form->field($model, 'name') ?>

        <?/*= $form->field($model, 'position_id') */?>
<div class="form-group field-userform-position_id">
    <label for="userform-position_id" class="col-lg-2 control-label">职位</label>
    <div class="col-lg-3">
        <input type="hidden" name="UserForm[position_id]" class="form-control" id="userform-position_id" value="<?=$model->position_id?>">
        <input type="hidden" id="s_position_id" value="<?=$model->position_id?>" />
            <?=$this->render('/manage/_position')?>
    </div>
    <div class="col-lg-5"><p class="help-block help-block-error"></p></div>
</div>

        <?= $form->field($model, 'gender')->dropDownList([0=>'N/A',1=>'男',2=>'女']) ?>
        <?= $form->field($model, 'mobile') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'join_date')->hint('格式:2010-10-10') ?>
        <?= $form->field($model, 'contract_date')->hint('格式:2010-10-10') ?>

        <?= $form->field($model, 'ord',[
            'template'=>"{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>"
        ])->dropDownList([5=>5,4=>4,3=>3,2=>2,1=>1])  ?>
        <?= $form->field($model, 'status',[
            'template'=>"{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>"
        ])->dropDownList([0=>'禁用',1=>'启用']) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?=$model->getScenario()=='update'?'<br/>*编辑职员时，如无需更改密码，密码字段留空':''?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
