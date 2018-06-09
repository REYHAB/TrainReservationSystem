<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\projects\models\TrainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel frontend\modules\projects\models\TrainclassSearch */
$this->title = 'Trains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Train', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'Train_ID',
            'Train_name',
            'Train_type',
            'Source_stn',
            'Destination_stn',
            // 'Source_ID',
            // 'Destinaton_ID',
            [

                'label' => 'Economy seats',
                'value' => 'trainstatuses.Economy_seatnumber',
            ],
            [

                'label' => 'First class seats',
                'value' => 'trainstatuses.First_seatnumber',
            ],

            [

                'label' => 'Daysavailable',
                'value' => 'trainstatuses.Available_days',
            ],



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
