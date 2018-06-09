<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\projects\models\BookedticketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookedtickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookedticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bookedticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Train_ID',
            'BookedDate',
            'Category',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
