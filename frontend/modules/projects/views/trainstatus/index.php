<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\projects\models\TrainstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trainstatuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trainstatus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trainstatus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Train_date',
            'Economy_seatnumber',
            'First_seatnumber',
            //'BookedDate',
            'Train_ID',
            // 'BookedAcseats',
            // 'BookedGenseats',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
