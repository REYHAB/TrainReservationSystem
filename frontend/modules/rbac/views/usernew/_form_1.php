<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbgeneralparams-form">
   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                         Update User
                        </header>
                        <div class="panel-body">
                            <div >

    <?php $form = ActiveForm::begin(); ?>

                                <div class="row">
                                    <div class="col-lg-6">
                  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    
                                    <div class="col-lg-6">
               <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>  
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                     <?= $form->field($model, 'EMPLOYEENAME')->textInput(['maxlength' => true]) ?> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                        <?= $form->field($model, 'IMAGEPATH')->fileInput(['maxlength' => true])->label('Profile Picture') ?>
        
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                   
                                    </div>
                                    
                                    <div class="col-lg-6">
                   
                                    </div>
                                </div>
  



    

   

   



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                                
                                   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            'EMPLOYEENAME',
      

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
                        </div>
            </div>
</section>
          </div>
    </div>
</div>