<?php

namespace app\controllers;

use app\models\LoginForm;


class LoginController extends \yii\web\Controller
{
    public function actionEmail()
    {
        return $this->render('email');
    }

    public function actionIndex()
    {
        $model = new LoginForm();
        return $this->render('index', ['model'=>$model]);
    }

    public function actionPassword()
    {
        return $this->render('password');
    }

}
