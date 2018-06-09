<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */

$this->title = 'Update Usernew: ' . $model->TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Usernews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TITLE, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usernew-update">


    <?= $this->render('_form_1', [
        'model' => $model,
        'dataProvider'=>$dataProvider
    ]) ?>

</div>
