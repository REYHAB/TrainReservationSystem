<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Authitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authitem-form">
 
    <div style="background: #fff; padding: 10px;">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>TRUE]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true,'readonly'=>TRUE]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>