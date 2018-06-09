<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\popover\PopoverX;
/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbgeneralparams-form">
   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                         Activate User
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Activate', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
  <?php ActiveForm::end(); ?>
    <table id="example1" class="table table-bordered table-striped display" width="100%">
                <thead>
               
                  <th>id</th>
                  <th>username</th>
                  <th>email</th>
                  <th>EMPLOYEENAME</th>
                 
                  <th>Action</th>
           
                </tr>
                </thead>
              
                  <?php foreach ($model1 as $service){?>
                <tr>
                <td> <?=
                   
                      $service['id'];
                      
                      
                      ?>  </td>
                <td> <?=$service['username']?></td>
                <td> <?=$service['email'] ?></td>
                <td> <?=$service['EMPLOYEENAME']?></td>
               
              
                 
                <td>
                
                    <div class="row">
                        <div class="col-lg-3">
                                <?php
  
               PopoverX::begin([
                   'placement' => PopoverX::ALIGN_TOP,
                   'toggleButton' => ['label'=>'Activate', 'class'=>'btn btn-primary btn-xs'],
                   'header' => '<i class="glyphicon glyphicon-lock"></i> Confirm Activate ',
                   'footer'=> Html::a('Activate', ['/rbac/usernew/accountactivation','id'=>$service['id']], ['class'=>'btn btn-primary btn-xs']) .' '.
                          '  <button type="button" class="close " data-dismiss="popover-x" >cancel</button>'
               ]);

               echo "Are you sure you want to Activate this user?";

               PopoverX::end();
                 ?> 
                        </div>
                        
                             <div class="col-lg-3">
                            
             
                        </div>
                        
                  
                    </div>       
              
                </td>
                </tr>
               <?php }?>
              </table>

</div>
                        </div>
            </div>
</section>
          </div>
    </div>
</div>


 <?php
 
$script = <<< JS


  $(function () {

  
        
      $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
 
  });

JS;
$this->registerJs($script);
?> 