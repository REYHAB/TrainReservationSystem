<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Passenger */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passenger-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4">
    <?= $form->field($model, 'Ticket_ID')->textInput() ?>
     </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Pname')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Paddress')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Age')->textInput() ?>
    </div>
    <div class="col-lg-4">
        <?php
        echo 'Booked Date';
        echo DatePicker::widget([
            'model'=>$model,
            'name' => 'BookedDate',
            'attribute'=>'BookedDate',


            'type' => DatePicker::TYPE_INPUT,
            'value' => 'BookedDate',
            'convertFormat'=>true,
            'pluginOptions' => [
                'placeholder'=>'Select dat',
                'autoclose'=>true,
                'format' => 'yyyy-MM-dd'
            ]
        ]);
        ?>
    </div>

    <div class="col-lg-4">

        <?= $form->field($model, 'Train_ID')->dropDownList(ArrayHelper::map(\frontend\modules\Projects\models\Train::find()->all(),'Train_ID','Train_ID'),['prompt'=>'Select...'] )?>


    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Pcategory')->dropDownList([ 'Economy' => 'Economy', 'First class' => 'First class', ], ['prompt' => 'Category']) ?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Pstatus')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'Pgender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => '']) ?>
    </div>
    <div class="col-lg-3">
        <?= Html::submitButton($model->isNewRecord ? 'Check availability' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div class="col-lg-3">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
