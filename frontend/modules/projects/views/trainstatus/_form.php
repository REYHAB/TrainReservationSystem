<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Trainstatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainstatus-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4">
        <?php
        echo 'Train Date';
        echo DatePicker::widget([
            'model'=>$model,
            'name' => 'Train_date',
            'attribute'=>'Train_date',


            'type' => DatePicker::TYPE_INPUT,
            'value' => 'Train_date',
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
    <?= $form->field($model, 'Economy_seatnumber')->textInput() ?>
    </div>
    <div class="col-lg-4">
    <?= $form->field($model, 'First_seatnumber')->textInput() ?>
    </div>

    <div class="col-lg-4">

        <?= $form->field($model, 'Train_ID')->dropDownList(ArrayHelper::map(\frontend\modules\projects\models\Train::find()->all(),'Train_ID','Train_ID'),['prompt'=>'Select...'] )?>


    </div>

    <div class="col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
