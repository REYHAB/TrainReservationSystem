<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\TrainclassSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainclass-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Train_ID') ?>

    <?= $form->field($model, 'Economy_class') ?>
    <?= $form->field($model, 'First_class') ?>

    <?= $form->field($model, 'Economy_seats') ?>

    <?= $form->field($model, 'First_classSeats') ?>
    <?= $form->field($model, 'BookedEconomyseats') ?>
    <?= $form->field($model, 'BookedFirstseats') ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
