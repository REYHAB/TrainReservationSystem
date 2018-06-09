<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Authitem */

$this->title = 'Update Authitem: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authitem-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
