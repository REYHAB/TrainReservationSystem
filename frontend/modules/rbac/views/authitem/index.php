<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-index">
<?= Html::a('Back TO Roles', ['/rbac/route'], ['class'=>'btn btn-primary btn-xs']) ?> 
                 
    <div style="background: #fff; padding: 10px;">

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            
            [
                                        'attribute' => 'type',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            if ($model->type == '2') {
                                                return 'Permission';
                                            }
                                        },
                                    ],
            'description',
           // 'rule_name',
            //'data',
            // 'created_at',
            // 'updated_at',
            // 'APPROVED',
            // 'CREATEDBY',
            // 'DELETED',
            // 'DELETEDBY',
            // 'APPROVEDELETE',
            // 'MENU',
            // 'ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>