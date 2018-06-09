<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;





$this->title = 'Signup';
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

    <title>INSPINIA | Register</title>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>



        </div>
        <div style="margin-top: 50%; background: #86C1E9; padding: 20px;">
            <h3 style="color: #AD171A;">Train Seat Reservation System</h3>
        <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
        <div class="form-group">
            <?= $form->field($model, 'FullName')->textInput(array('placeholder'=>'FullName')) ?>
        </div>
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(array('placeholder'=>'username')) ?>
            </div>
        <div class="form-group">
            <?= $form->field($model, 'Gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => 'Gender']) ?>

        </div>
        <div class="form-group">
            <?= $form->field($model, 'Age')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'MobileNumber')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'Nationality')->dropDownList([ 'Kenyan' => 'Kenyan', 'Ugandan' => 'Ugandan', 'Tanzanian' => 'Tanzanian' ], ['prompt' => 'Nationality']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'City')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['Placeholder'=>'enter email id'])?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['Placeholder'=>'enter password']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'ConfirmPassword')->passwordInput() ?>
        </div>




        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>


        <?php ActiveForm::end(); ?>
        <p class="m-t"> <small>TRAIN SEAT RESERVATION SYSTEM &copy; 2017</small> </p>
    </div>
</div>

<!-- Mainly scripts -->

<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>

</html>
