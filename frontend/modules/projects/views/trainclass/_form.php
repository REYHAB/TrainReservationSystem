<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Trainclass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainclass-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Train_ID')->textInput() ?>

    <?= $form->field($model, 'Economy_class')->textInput() ?>
    <?= $form->field($model, 'First_class')->textInput() ?>

    <?= $form->field($model, 'Economy_seats')->textInput() ?>

    <?= $form->field($model, 'First_classSeats')->textInput() ?>
    <?= $form->field($model, 'BookedEconomyseats')->textInput() ?>
    <?= $form->field($model, 'BookedFirstseats')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
