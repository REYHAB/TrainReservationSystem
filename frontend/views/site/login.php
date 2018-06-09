<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\url;



?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SGR | Login</title>
    <link href="/trains/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="/train/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/trains/inspinia/css/animate.css" rel="stylesheet">
    <link href="/trains/inspinia/css/style.css" rel="stylesheet">



</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>


        </div>
        <div style="margin-top: 50%; background: #86C1E9; padding: 20px;">
            <h3 style="color: #AD171A;">Train Reservation System</h3>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
        </div>
            <div class="form-group">
                <p class="text-muted text-center"><small>Forgot Password?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?= Yii::$app->urlManager->createUrl(['/site/request-password-reset'])?>">Reset Password</a>
            </div>
        <div class="form-group">
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="<?= Yii::$app->urlManager->createUrl(['/site/signup'])?>">Create an account</a>
        </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<script src="/trains/inspinia/js/jquery-2.1.1.js"></script>
<script src="/trains/inspinia/js/bootstrap.min.js"></script>

</body>

</html>
