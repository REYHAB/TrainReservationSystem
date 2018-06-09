<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Route */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4">
    <?= $form->field($model, 'Train_ID')->textInput() ?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Station_ID')->textInput() ?>
    </div>
    <div class="col-lg-6">
    <?php
    echo '<label>Arrival time</label>';
    echo \kartik\datetime\DateTimePicker::widget([
        'model'=>$model,
        'name' => 'Arrival_time',
        'attribute'=>'Arrival_time',
        'options' =>['placeholder'=>'Select operating time...'],
        'convertFormat'=>true,
        'pluginOptions'=>[
            'format'=>'d-M-yyyy hh:ii',
            'startDate'=>'01-Jan-2016 12:00 AM',
            'todayHighlight'=>true
        ]

    ]);?>
    </div>
    <div class="col-lg-6">
    <?php
    echo '<label>Departure time</label>';
    echo \kartik\datetime\DateTimePicker::widget([
        'model'=>$model,
        'name' => 'Departure_time',
        'attribute'=>'Departure_time',
        'options' =>['placeholder'=>'Select operating time...'],
        'convertFormat'=>true,
        'pluginOptions'=>[
            'format'=>'d-M-yyyy hh:ii',
            'startDate'=>'01-Jan-2016 12:00 AM',
            'todayHighlight'=>true
        ]

    ]);?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Source_distance')->textInput() ?>
    </div>


    <div class="col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
