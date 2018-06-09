<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\projects\models\DaysavailableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daysavailables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daysavailable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Daysavailable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Train_ID',
            'Available_days',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
