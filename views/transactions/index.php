<?php

use yii\helpers\Html;
use \app\widgets\MyGridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Records\TransactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
        <?php //Html::a('Create Transactions', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer.fullName',
            'amount',
            'destination',
            'service.name',
            'reference',
//            'message:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
