<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Passenger */

$this->title = 'Update Passenger: ' . $model->Ticket_ID;
$this->params['breadcrumbs'][] = ['label' => 'Passengers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ticket_ID, 'url' => ['view', 'id' => $model->Ticket_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="passenger-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
