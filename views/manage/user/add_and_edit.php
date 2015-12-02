<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
/*
$this->params['breadcrumbs'][] = ['label'=>'个人中心','url'=>'/user'];
$this->params['breadcrumbs'][] = $this->title;*/
?>

        <h2>
            <?=$this->title?>
        </h2>
        <?php $form = ActiveForm::begin([
            'id' => 'user-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password2')->passwordInput() ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'position_id') ?>
        <?= $form->field($model, 'gender')->dropDownList([0=>'N/A',1=>'男',2=>'女']) ?>
        <?= $form->field($model, 'mobile') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'describe')->textarea() ?>
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
