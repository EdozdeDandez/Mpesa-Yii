<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>

