<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */

$this->title = $model->TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Usernews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usernew-view">

    <div style="background: #fff; padding: 10px;">

   
  <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-info btn-xs']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-xs',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          
            'username',
           
            'email:email',
           
            'ADDEDBY',
            'EMPLOYEENAME',
           
            
          
        ],
    ]) ?>

</div>
</div>