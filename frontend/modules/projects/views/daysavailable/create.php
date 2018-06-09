<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Daysavailable */

$this->title = 'Create Daysavailable';
$this->params['breadcrumbs'][] = ['label' => 'Daysavailables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daysavailable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
