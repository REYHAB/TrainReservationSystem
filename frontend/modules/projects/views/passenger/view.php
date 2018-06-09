<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Passenger */

$this->title = $model->Ticket_ID;
$this->params['breadcrumbs'][] = ['label' => 'Passengers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passenger-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Ticket_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Ticket_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Ticket_ID',
            'Pname',
            'Paddress',
            'Age',
            'BookedDate',
            'Train_ID',
            'Pcategory',
            'Pstatus',
            'Pgender',
        ],
    ]) ?>

</div>
