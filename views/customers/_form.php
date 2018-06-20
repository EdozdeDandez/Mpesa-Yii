<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use borales\extensions\phoneInput\PhoneInput;


/* @var $this yii\web\View */
/* @var $model app\models\Records\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(PhoneInput::className(),[
        'jsOptions' => [
            'preferredCountries' => ['ke', 'ug', 'tz'],
            'nationalMode' => false,
            'allowExtensions' => true,
        ]
    ]) ?>

    <?= $form->field($model, 'date_of_birth')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'yy-mm-dd']]) ?>

    <?= $form->field($model, 'national_id')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'agent_id')->dropDownList($agents,['prompt'=>'Select Agent']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
