<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Bookedticket */

$this->title = $model->Train_ID;
$this->params['breadcrumbs'][] = ['label' => 'Bookedtickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookedticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Train_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Train_ID], [
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
            'Train_ID',
            'BookedDate',
            'Category',
        ],
    ]) ?>

</div>
