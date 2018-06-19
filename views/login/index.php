<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>

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
                	<?= $form->field($model, 'password')->passwordInput() ?>
                	<?= $form->field($model, 'rememberMe')->checkbox([
                		'template' => "<div class=\"col-sm-offset-2 col-md-3\">{input} {label}</div>\n<div class=\"col-sm-6\">{error}</div>",
                	]) ?>
                	<div class="form-group">
                		<div class="col-sm-offset-2 col-md-11">
                			<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
						</div>
					</div>
					<?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
