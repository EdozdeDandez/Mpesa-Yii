<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Records\Users */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="users-form">

    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-4 col-form-label text-md-right\">{input}</div>\n<div class=\"col-sm-6\">{error}</div>",
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
            ],
        ]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['value'=>'']) ?>
        <?= $form->field($model, 'password_confirm')->passwordInput(['value'=>'']) ?>


        <div class="form-group">
            <div class="col-sm-offset-2 col-md-11">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <?php //$form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'remember_token')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

<!--    <div class="form-group">-->
        <?php //Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--    </div>-->

    <?php //ActiveForm::end(); ?>

</div>
