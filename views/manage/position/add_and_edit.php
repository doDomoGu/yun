<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
?>
        <h2>
            <?=$this->title?>
        </h2>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'describe')->textarea() ?>

        <?= $form->field($model, 'ord',[
            'template'=>"{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>"
        ]) ?>

        <?= $form->field($model, 'status',[
            'template'=>"{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>"
        ])->dropDownList([0=>'禁用',1=>'启用']) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
