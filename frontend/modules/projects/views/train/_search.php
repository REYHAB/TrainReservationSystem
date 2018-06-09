<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\TrainSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\modules\projects\models\Train */
?>

<div class="train-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'Train_ID')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-4">

            <?= $form->field($model, 'Train_name')->textInput(['maxlength'=>true]) ?>


        </div>


        <div class="col-lg-4">

            <?= $form->field($model, 'Train_type')->textInput(['maxlength'=>true]) ?>


        </div>
        <div class="col-lg-4">

            <?= $form->field($model, 'Source_stn')->textInput(['maxlength'=>true]) ?>


        </div>

        <div class="col-lg-4">

            <?= $form->field($model, 'Destination_stn')->textInput(['maxlength'=>true]) ?>


        </div>





    <?php // echo $form->field($model, 'Source_ID') ?>

    <?php // echo $form->field($model, 'Destinaton_ID') ?>

    <div class="col-lg-4">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
