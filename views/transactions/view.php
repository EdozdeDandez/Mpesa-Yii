<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Records\Transactions */

$this->title = $model->reference;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer.fullName',
            'amount',
            'destination',
            'service.name',
            'reference',
            'message:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
