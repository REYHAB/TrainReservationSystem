<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Cancel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cancel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TicketID')->textInput() ?>

    <?= $form->field($model, 'Dateofbooked')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
