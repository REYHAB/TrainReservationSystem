<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Trainclass */

$this->title = 'Create Trainclass';
$this->params['breadcrumbs'][] = ['label' => 'Trainclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trainclass-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
