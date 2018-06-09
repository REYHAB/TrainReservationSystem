<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Bookedticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookedticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Train_ID')->textInput() ?>

    <?= $form->field($model, 'BookedDate')->textInput() ?>

    <?= $form->field($model, 'Category')->dropDownList([ 'AC' => 'AC', 'General' => 'General', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
