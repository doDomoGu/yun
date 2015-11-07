<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
/*
$this->params['breadcrumbs'][] = ['label'=>'个人中心','url'=>'/user'];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="row">
    <div class="col-lg-3">
        <?=$this->render('../_left')?>
    </div>
    <div class="col-lg-9">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'title') ?>

        <?= $form->field($model, 'content') ?>

        <?= $form->field($model, 'img_url') ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>