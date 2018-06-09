<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */

$this->title = 'Create Usernew';
$this->params['breadcrumbs'][] = ['label' => 'Usernews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usernew-create">

   <?= $this->render('_form', [
        'model' => $model,
        'dataProvider'=>$dataProvider,
    ]) ?>

</div>
