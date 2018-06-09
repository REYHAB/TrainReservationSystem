<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\TrainstatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainstatus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Train_date') ?>

    <?= $form->field($model, 'Ac_seatnumber') ?>

    <?= $form->field($model, 'Gen_seatnumber') ?>

    <?= $form->field($model, 'BookedDate') ?>

    <?= $form->field($model, 'Train_num') ?>

    <?php // echo $form->field($model, 'BookedAcseats') ?>

    <?php // echo $form->field($model, 'BookedGenseats') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
