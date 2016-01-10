<?php
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    app\assets\AppAsset::addCssFile($this,'css/main/site/login.css');
    app\assets\AppAsset::addJsFile($this,'js/main/site/login.js');
?>
<section id="site-login">
    <header class="text-center">
        <img class="logo" src="/images/logo.png" />
    </header>


    <!--<p class="line-1 text-center">一站式地产综合服务商 http://www.songtang.net</p>
    <p class="line-2 text-center">China's Glory United</p>-->
    <section id="login-form-section">
        <article class="text-center">
            <img src="/images/site-login/word.png" style="width:500px;"/>


        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => [/*'class' => 'form-horizontal',*/'autocomplete'=>'off'],
            //'enableAjaxValidation'=>false,
            //'enableClientValidation'=>false,
            'fieldConfig' => [
                //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
                'template' => "{input}{error}",
                'labelOptions' => ['class' => 'col-lg-2 col-lg-offset-3 control-label'],
            ],
        ]); ?>
<section id="form-input-group">
    <input style="display:none" />
        <?= $form->field($model, 'username',[
            'inputTemplate' => '{input}',
            'inputOptions'=>['placeholder' => 'Username | 用户名','autocomplete'=>'off']
        ])->textInput() ?>
    <input style="display:none">
    <input style="display:none">
    <input style="display:none">
    <input style="display:none">
        <?= $form->field($model, 'password',[
            'inputTemplate' => '{input}',
            'inputOptions'=>['placeholder' => 'Password | 密码','autocomplete'=>'off']
        ])->passwordInput() ?>

        <?/*=$model->getFirstError('username')*/?>
</section>
        <?/*= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-5 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) */?>

        <!--<div class="form-group hidden">
            <div class="col-lg-offset-5 col-lg-7">
                <?/*= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) */?>
            </div>
        </div>-->
        <input type="submit" style="display:block;overflow:hidden;width:0;height:0; position:absolute;padding:0;margin:0;border:0;" />

        <?php ActiveForm::end(); ?>
        </article>
    </section>
    <footer class="text-center">
        Since 1993
    </footer>
</section>

