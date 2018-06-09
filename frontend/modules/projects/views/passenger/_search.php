<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\PassengerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passenger-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Ticket_ID') ?>

    <?= $form->field($model, 'Pname') ?>

    <?= $form->field($model, 'Paddress') ?>

    <?= $form->field($model, 'Age') ?>

    <?= $form->field($model, 'BookedDate') ?>

    <?php // echo $form->field($model, 'Train_id') ?>

    <?php // echo $form->field($model, 'Pcategory') ?>

    <?php // echo $form->field($model, 'Pstatus') ?>

    <?php // echo $form->field($model, 'Pgender') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
