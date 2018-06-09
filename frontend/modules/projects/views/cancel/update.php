<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Cancel */

$this->title = 'Update Cancel: ' . $model->TicketID;
$this->params['breadcrumbs'][] = ['label' => 'Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TicketID, 'url' => ['view', 'id' => $model->TicketID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cancel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
