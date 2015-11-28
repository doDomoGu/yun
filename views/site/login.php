<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
        app\assets\AppAsset::addCssFile($this,'css/site-login.css');
?>
        <div class="site-login">

            <p class="line-1 text-center">一站式地产综合服务商 http://www.songtang.net</p>
            <p class="line-2 text-center">China's Glory United</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 col-lg-offset-3 control-label'],
                ],
            ]); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-5 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group">
                <div class="col-lg-offset-5 col-lg-7">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

