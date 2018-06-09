<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Bookedticket */

$this->title = 'Create Bookedticket';
$this->params['breadcrumbs'][] = ['label' => 'Bookedtickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookedticket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
