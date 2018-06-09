<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Cancel */

$this->title = 'Create Cancel';
$this->params['breadcrumbs'][] = ['label' => 'Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
