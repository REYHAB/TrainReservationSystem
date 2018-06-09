<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\projects\models\PassengerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Passengers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passenger-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Passenger', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Ticket_ID',
            'Pname',
            'Paddress',
            'Age',
            'BookedDate',
            // 'Train_ID',
            // 'Pcategory',
            // 'Pstatus',
            // 'Pgender',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
