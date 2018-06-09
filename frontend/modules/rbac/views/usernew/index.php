<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usernews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbgeneralparams-form">
   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        All Users List
                        </header>
                        <div class="panel-body">
                            <div >

    <p>
 
        
        <?= $this->render('usermenu') ?>
    
       
    </p>
           <table id="example1" class="table table-bordered table-striped display  dataTables-example" width="100%">
                <thead>
               
                  <th>id</th>
                  <th>username</th>
                  <th>email</th>
                  <th>FullName</th>
                  <th>STATUS</th>
                  <th>Action</th>
           
                </tr>
                </thead>
              
                  <?php foreach ($dataProvider as $service){?>
                <tr>
                <td> <?=
                   
                      $service['id'];
                      
                      
                      ?>  </td>
                <td> <?=$service['username']?></td>
                <td> <?=$service['email'] ?></td>
                <td> <?=$service['FullName']?></td>
                 <td> <?php 
                 $modeluser= new \frontend\modules\rbac\models\Usernew();
                 $status=$modeluser->getStatus($service);
                 if(is_array($status)){
                     echo $status[0];
                     
                 }
                 else{
                 echo   $status;
                 }
                 ?></td>
               
              
                 
                <td><?= Html::a('View', ['/rbac/usernew/view','id'=>$service['id']], ['class'=>'btn btn-info btn-xs']) ?> 
                  <?php if(is_array($status)){
                      
              PopoverX::begin([
                   'placement' => PopoverX::ALIGN_TOP,
                   'toggleButton' => ['label'=>'Update', 'class'=>'btn btn-warning btn-xs'],
                   'header' => '<i class="glyphicon glyphicon-lock"></i> Confirm Update ',
                   'footer'=> Html::a('Update', ['/rbac/usernew/update','id'=>$service['id']], ['class'=>'btn btn-warning btn-xs']) .' '.
                          '  <button type="button" class="close " data-dismiss="popover-x" >cancel</button>'
               ]);

               echo "Are you sure you want to edit details of  this user?";

               PopoverX::end();
                 
                    
                  } ?>
                
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

$(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

JS;
$this->registerJs($script);
?> 

