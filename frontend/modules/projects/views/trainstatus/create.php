<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Trainstatus */

$this->title = 'Create Trainstatus';
$this->params['breadcrumbs'][] = ['label' => 'Trainstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trainstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
