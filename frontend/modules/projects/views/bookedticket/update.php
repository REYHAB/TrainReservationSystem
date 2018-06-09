<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Bookedticket */

$this->title = 'Update Bookedticket: ' . $model->Train_ID;
$this->params['breadcrumbs'][] = ['label' => 'Bookedtickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Train_ID, 'url' => ['view', 'id' => $model->Train_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bookedticket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
