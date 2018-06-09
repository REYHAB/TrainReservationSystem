<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Trainstatus */

$this->title = 'Update Trainstatus: ' . $model->Train_ID;
$this->params['breadcrumbs'][] = ['label' => 'Trainstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Train_ID, 'url' => ['view', 'id' => $model->Train_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trainstatus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
