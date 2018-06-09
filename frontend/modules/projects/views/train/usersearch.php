<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\popover\PopoverX;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\modules\projects\models\Station;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="margin-top: 10px;" class="tbgeneralparams-form">

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">

                <div class="row">
                    <div class="col-lg-4">
                        <header class="panel-heading">
                            Activate Users List
                        </header>
                    </div>

                    <div style="margin-top: 20px;" class="col-lg-4">

                        <form method="post" action="<?= Yii::$app->urlManager->createUrl(['/Projects/train/advancedfilter'])?>">


                            <div class="col-lg-4">

                                <select name="sorc">
                                    <option> Select Station</option>
                                    <?php
                                    $station=Station::find()->all();
                                    foreach ($station as $station){

                                        ?>
                                        <option value="<?= $station['Station_name']?>"><?= $station['Station_name'] ?> </option>
                                    <?php }?>
                                </select>

                            </div>

                            <div style="margin-left: 10px;" class="col-lg-4">

                                <select name="dest">
                                    <option> Select Station</option>
                                    <?php
                                    $station=Station::find()->all();
                                    foreach ($station as $station){

                                        ?>
                                        <option value="<?= $station['Station_name']?>"><?= $station['Station_name'] ?> </option>
                                    <?php }?>
                                </select>


                            </div>
                            <input type="hidden" name="_csrf" value=" <?=Yii::$app->request->getCsrfToken() ?>" />
                     <button style="margin-left: 30px;" type="submit"> Search</button>

                        </form>
                    </div>
                </div>
                <div class="panel-body">
                    <div >

             <table id="example1" class="table table-bordered table-striped display" width="100%">
                            <thead>

                            <th>Train Name</th>
                            <th>Train Type</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>First class</th>
                            <th>Economy class</th>

                            <th>Arrival</th>
                            <th>Departure</th>
                            <th>Runs on</th>

                            <th>Action</th>






                            </tr>
                            </thead>

                            <?php foreach ($model as $service){



                                ?>
                                <tr>

                                    <td> <?=$service['Train_name']?></td>
                                    <td> <?=$service['Train_type'] ?></td>
                                    <td> <?=$service['Source_stn']?></td>
                                    <td> <?=$service['Destination_stn']?></td>
                                    <td> <?=$service['First_classfare']?></td>
                                    <td> <?=$service['Economy_classfare']?></td>
                                    <td> <?=$service['Arrival_time']?></td>
                                    <td> <?=$service['Departure_time']?></td>
                                    <td> <?=$service['Available_days']?></td>

                                    <td>
                                        <div class="form-group">
                                            <?= Html::a('Book', ['booktrain','id'=>$service['Train_ID']], ['class'=>'btn btn-info btn-xs']) ?>

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

 $(document).ready(function(){
            $('#example1').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                  
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

