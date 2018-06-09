<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\projects\models\CancelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cancels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cancel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TicketID',
            'Dateofbooked',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
