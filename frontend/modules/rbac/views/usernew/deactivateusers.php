<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deactivate Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbgeneralparams-form">
   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Activate Users List
                        </header>
                        <div class="panel-body">
                            <div >

    <p>
   
          <?= $this->render('usermenu') ?>
    
       
    </p>
           <table id="example1" class="table table-bordered table-striped display" width="100%">
                <thead>
               
                  <th>Id</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Employee Name</th>
                  <th>Action</th>
           
                </tr>
                </thead>
              
                  <?php foreach ($model as $service){?>
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
                   'toggleButton' => ['label'=>'Deactivate', 'class'=>'btn btn-danger btn-xs'],
                   'header' => '<i class="glyphicon glyphicon-lock"></i> Confirm Deactivate ',
                   'footer'=> Html::a('Deactivate', ['/rbac/usernew/deactivate','id'=>$service['id']], ['class'=>'btn btn-danger btn-xs']) .' '.
                          '  <button type="button" class="close " data-dismiss="popover-x" >cancel</button>'
               ]);

               echo "Are you sure you want to Deactivate this account?";

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
   
    <?php //GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'username',
//            'email',
//            'EMPLOYEENAME',
//      
//
//            ['class' => 'yii\grid\ActionColumn',
//              'template' => '{view} {update} {delete} {approve} {reset} {UnLock} {Lock}',
//              'buttons' => [
//                  
//                  
//                  
//                  
//                        'approve' => function ($url, $model, $key) {
//                                if($model->APPROVED ==0 ){
//                            return Html::a('||approve', ['/rbac/usernew/userapprove', 'id'=>$model->id]);
//                                }
//                        },
//                        'reset' => function ($url, $model, $key) {
//                              
//                            return Html::a('||Reset password', ['/rbac/usernew/resetpassword', 'id'=>$model->id]);
//                                
//                        },
//                                
//                                  'UnLock' => function ($url, $model, $key) {
//                            
//                            if($model->LOCKED ==1 ){
//                              
//                            return Html::a('||UnLock Account', ['/rbac/usernew/unlockaccount', 'id'=>$model->id]);
//                            }     
//                        },
//                                
//                                  'Lock' => function ($url, $model, $key) {
//                              
//                           // return Html::a('||Lock Account', ['/rbac/usernew/lockaccount', 'id'=>$model->id]);
//                             
//                                          return Html::a('Lock Account', ['update', 'id' => $model->id], ['class' => 'button btn btn-primary btn-xs']);
//                        },
//                    ]
//                ],
//            
// 
//        ],
//    ]); ?>
</div>
                        </div>
            </div>
</section>
                
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

