<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Daysavailable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daysavailable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Train_ID')->textInput() ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model,'Available_days')-> checkbox(array('label'=>'Monday','value'=>1, 'uncheckValue'=>0)); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'Available_days')->checkbox(['label' => 'Tuesday', 'value' => 2,])?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Available_days')->checkbox(['label' => 'Wednesday', 'value' => 3,])?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Available_days')->checkbox(['label' => 'Thursday', 'value' => 4,])?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'Available_days')->checkbox(['label' => 'Friday', 'value' => 5,])?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'Available_days')->checkbox(['label' => 'Saturday', 'value' => 6,])?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'Available_days')->checkbox(['label' => 'Sunday', 'value' => 7,])?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
