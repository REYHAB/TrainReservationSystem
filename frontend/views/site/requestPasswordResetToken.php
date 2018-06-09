<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<html>

<head>
    <link href="/trains/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="/trains/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/trains/inspinia/css/animate.css" rel="stylesheet">
    <link href="/trains/inspinia/css/style.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset</title>
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen   animated fadeInDown">


    <p>Please fill out your email. A link to reset password will be sent there.</p>

        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <div class="col-lg-12">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            </div>
                <div class="col-lg-12">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>

    </div>
</div>
</body>
</html>
