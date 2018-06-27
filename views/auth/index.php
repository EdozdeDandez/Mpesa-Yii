<?php

use yii\helpers\Html;
use \app\widgets\MyGridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Records\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (Yii::$app->user->identity->is_admin){?>
            <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>

    </p>

    <?= MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return \Yii::$app->user->id === $model->id;
                    },
                    'delete' => function ($model) {
                        return \Yii::$app->user->identity->is_admin;
                    },
                ]],
        ],
    ]); ?>
</div>
